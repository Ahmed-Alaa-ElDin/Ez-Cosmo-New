<?php

namespace App\Http\Livewire\Admin;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Form;
use App\Models\Indication;
use App\Models\Ingredient;
use App\Models\Line;
use App\Models\Product;
use FontLib\TrueType\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class NewProductReview extends Component
{
    use WithFileUploads;

    public $oldProduct, $product_id, $forms, $brands, $lines, $categories, $indications, $ingredients;
    public $brand_id, $line_id, $category_id, $name, $form_id, $volume, $units, $price, $code, $selectedIngredients, $selectedIndications, $old_product_photo, $product_photo, $directions_of_use, $notes, $advantages, $disadvantages;
    public $ingredient_name;

    protected $listeners = ['getIngredients'];

    // Starting function
    public function mount()
    {
        // Data from superuser
        $this->oldProduct = Product::findOrFail($this->product_id);
        $this->brand_id = $this->oldProduct->brand_id;
        $this->line_id = $this->oldProduct->line_id;
        $this->category_id = $this->oldProduct->category_id;
        $this->name = $this->oldProduct->name;
        $this->form_id = $this->oldProduct->form_id;
        $this->volume = $this->oldProduct->volume;
        $this->units = $this->oldProduct->units;
        $this->price = $this->oldProduct->price;
        $this->code = $this->oldProduct->code;
        $this->selectedIngredients = $this->oldProduct->ingredients->map(function ($item, $key) {
            return ['name' => $item['id'], 'concentration' => $item['pivot']['concentration'], 'role' => $item['pivot']['role']];
        });
        $this->selectedIndications = $this->oldProduct->indications->pluck('id')->toarray();
        $this->old_product_photo = json_decode($this->oldProduct->product_photo);
        $this->directions_of_use = $this->oldProduct->directions_of_use;
        $this->notes = $this->oldProduct->notes;
        $this->advantages = $this->oldProduct->advantages;
        $this->disadvantages = $this->oldProduct->disadvantages;

        $this->forms = Form::get();
        $this->brands = Brand::get();
        $this->lines = Line::where('brand_id', $this->brand_id)->get();
        $this->categories = Category::get();
        $this->indications = Indication::get();
        $this->emit('initializeSelect');
    }

    // Rendering Function 
    public function render()
    {
        // print_r($this->selectedIndications);
        // dd($this->oldProduct->indications);
        // return 0;
        $this->ingredients = Ingredient::get();

        // Initialize Select 2 with rerender
        $this->emit('initializeSelect');

        return view('livewire.admin.products.new-product-review');
    }

    // Get lines for selected brand
    public function updatedBrandId()
    {
        $this->lines = Line::where('brand_id', $this->brand_id)->get();
        $this->emit('updateLines', $this->lines);
    }

    // Get selected ingredients from child component
    public function getIngredients($ingredients)
    {
        $this->selectedIngredients = $ingredients;
    }

    // Delete one off admin added images
    public function deleteImgNew($id)
    {
        unset($this->product_photo[$id]);
    }

    // Delete one off super user added images
    public function deleteImgOld($id)
    {
        unset($this->old_product_photo[$id]);
    }

    // Delete all images
    public function resetImages()
    {
        $this->product_photo = [];
        $this->old_product_photo = [];
    }

    // real time validation of new ingredient input
    public function updatedIngredientName()
    {
        $this->validate([
            'ingredient_name' => 'required|unique:ingredients,name|max:50',
        ]);
    }

    // Add new ingredients
    public function submitNewIngredient()
    {
        Ingredient::create([
            'name' => $this->ingredient_name
        ]);

        $this->ingredient_name = null;

        $this->emit('rerenderIngredient');

        $this->emit('successIngredientAdd');
    }

    // Add new Product
    public function submitNewProduct()
    {
        // Validate Product's Data
        $this->validate([
            'name' => 'required|unique:products,name,' . $this->product_id . '|max:50',
            'brand_id' => 'required',
            'category_id' => 'required',
            'form_id' => 'required',
            'volume' => 'required|numeric|min:0',
            'units' => 'required|numeric|min:1',
            'price' => 'required|numeric|min:0',
            'product_photo.*' => 'image',
            'ingredient_name.concentration' => 'max:50',
            'ingredient_name.role' => 'max:255',
        ], [
            'product_photo.*' => 'Images should have jpg, jpeg or png extension'
        ]);

        // Save Image
        if ($this->product_photo || $this->old_product_photo) {
            $images = [];
            if ($this->product_photo) {
                foreach ($this->product_photo as $image) {
                    $req_image = $image;
                    $image_name = 'product-' . rand() . '.' . $req_image->getClientOriginalExtension();
                    $req_image->storeAs('images', $image_name);
                    array_push($images, $image_name);
                }
            }
            if ($this->old_product_photo) {
                foreach ($this->old_product_photo as $image) {
                    array_push($images, $image);
                }
            }
            $serialized_images = json_encode($images);
        } else {
            $serialized_images = '["default_product.png"]';
        }

        // Save Product
        $product = Product::findOrFail($this->product_id);
        
        $product->update([
            'name' =>  $this->name,
            'volume' =>  $this->volume,
            'units' =>  $this->units,
            'approved' =>  1,
            'price' =>  $this->price,
            'advantages' =>  $this->advantages,
            'disadvantages' =>  $this->disadvantages,
            'notes' =>  $this->notes,
            'directions_of_use' =>  $this->directions_of_use,
            'code' =>  $this->code,
            'brand_id' =>  $this->brand_id,
            'form_id' =>  $this->form_id,
            'line_id' =>  $this->line_id,
            'category_id' =>  $this->category_id,
            'product_photo' => $serialized_images,
            'approved_by' => Auth::id(),
        ]);

        // Attach Ingredients
        if (isset($this->selectedIngredients) && !empty($this->selectedIngredients)) {
            $product->ingredients()->detach();
            foreach ($this->selectedIngredients as $ingredient) {
                if ($ingredient['name'] != Null) {
                    $ing = Ingredient::findOrFail($ingredient['name']);
                    $product->ingredients()->attach($ing, ['concentration' => $ingredient['concentration'], 'role' => $ingredient['role']]);
                }
            }
        }

        // Attach Indications
        if (isset($this->selectedIndications)) {
            $product->indications()->detach();
            foreach ($this->selectedIndications as $indication) {
                $ind = Indication::findOrFail($indication);
                $product->indications()->attach($ind);
            }
        }

        session()->flash('success', "'$this->name' Inserted Successfully");
        return redirect(route('home'));
    }
}
