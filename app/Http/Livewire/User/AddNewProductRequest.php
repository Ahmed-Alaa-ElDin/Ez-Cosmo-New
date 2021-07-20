<?php

namespace App\Http\Livewire\User;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Form;
use App\Models\Indication;
use App\Models\Ingredient;
use App\Models\Line;
use App\Models\Product;
use App\Models\User;
use App\Notifications\NewRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddNewProductRequest extends Component
{
    use WithFileUploads;

    public $forms, $brands, $lines, $categories, $indications, $ingredients;
    public $brand_id, $line_id, $category_id, $name, $form_id, $volume, $units, $price, $code, $selectedIngredients, $selectedIndications, $product_photo, $directions_of_use, $notes, $advantages, $disadvantages;
    public $ingredient_name;

    protected $listeners = ['getIngredients'];

    // Starting function
    public function mount()
    {
        $this->forms = Form::get();
        $this->brands = Brand::get();
        $this->lines = new Collection();
        $this->categories = Category::get();
        $this->indications = Indication::get();
        $this->emit('initializeSelect');
    }

    // Rendering Function 
    public function render()
    {
        $this->ingredients = Ingredient::get();
        // Initialize Select 2 with rerender
        $this->emit('initializeSelect');

        return view('livewire.user.add-new-product-request');
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

    // Delete Selected Images
    public function resetImages()
    {
        $this->product_photo = [];
    }

    // Add new Product
    public function submitNewProduct()
    {
        // Validate Product's Data
        $this->validate([
            'name' => 'required|unique:products,name|max:50',
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
        if ($this->product_photo) {
            $images = [];
            foreach ($this->product_photo as $image) {
                $req_image = $image;
                $image_name = 'product-' . rand() . '.' . $req_image->getClientOriginalExtension();
                $req_image->storeAs('images',$image_name);
                array_push($images, $image_name);
            }
            $serialized_images = json_encode($images);
        } else {
            $serialized_images = '["default_product.png"]';
        }

        // Save Product
        $product = Product::create([
            'name' =>  $this->name,
            'volume' =>  $this->volume,
            'units' =>  $this->units,
            'approved' =>  0,
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
            'created_by' => Auth::id(),
        ]);

        // Attach Ingredients
        if (isset($this->selectedIngredients) && !empty($this->selectedIngredients)) {
            foreach ($this->selectedIngredients as $ingredient) {
                if ($ingredient['name'] != Null) {
                    $ing = Ingredient::findOrFail($ingredient['name']);
                    $product->ingredients()->attach($ing, ['concentration' => $ingredient['concentration'], 'role' => $ingredient['role']]);
                }
            }
        }

        // Attach Indications
        if (isset($this->selectedIndications)) {
            foreach ($this->selectedIndications as $indication) {
                $ind = Indication::findOrFail($indication);
                $product->indications()->attach($ind);
            }
        }

        $users = User::permission('product-approve')->get();

        $data = [
            'user_name' => Auth::user()->first_name . ' ' . Auth::user()->last_name,
            'user_img' => Auth::user()->profile_photo,
            'message' => $this->name . ' Edit Request',
            'product_id' => $product->id,
            'link' => 'admin.edited_products.edit',
            'request_type' => 1,
        ];

        Notification::send($users, new NewRequest($data));

        session()->flash('success', "'$this->name' Inserted Successfully");
        return redirect(route('home'));

    }
    
}