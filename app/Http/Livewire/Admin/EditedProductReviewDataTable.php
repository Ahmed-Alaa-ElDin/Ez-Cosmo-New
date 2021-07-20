<?php

namespace App\Http\Livewire\Admin;

use App\Models\EditedProduct;
use App\Models\Ingredient;
use App\Models\Product;
use Livewire\Component;

class EditedProductReviewDataTable extends Component
{
    public $product_id, $compar, $editedProduct, $oldProduct;
    public $name, $volume, $price, $advantages, $units, $disadvantages, $notes, $product_photo, $directions_of_use, $code, $form_id, $line_id, $brand_id, $category_id, $indications, $ingredients;
    public $selectedIndications, $selectedIngredients, $selectedPhotos, $differentIngredients;

    public function mount()
    {
        $this->editedProduct = EditedProduct::findOrFail($this->product_id);
        $this->oldProduct = Product::withTrashed()->findOrFail($this->editedProduct->product_id);

        $this->name                 =   $this->oldProduct->name ?? Null;
        $this->volume               =   $this->oldProduct->volume ?? Null;
        $this->units                =   $this->oldProduct->units ?? Null;
        $this->price                =   $this->oldProduct->price ?? Null;
        $this->advantages           =   $this->oldProduct->advantages ?? Null;
        $this->disadvantages        =   $this->oldProduct->disadvantages ?? Null;
        $this->notes                =   $this->oldProduct->notes ?? Null;
        $this->product_photo        =   $this->oldProduct->product_photo ?? Null;
        $this->directions_of_use    =   $this->oldProduct->directions_of_use ?? Null;
        $this->code                 =   $this->oldProduct->code ?? Null;
        $this->form_id              =   $this->oldProduct->form_id ?? Null;
        $this->line_id              =   $this->oldProduct->line_id ?? Null;
        $this->brand_id             =   $this->oldProduct->brand_id ?? Null;
        $this->category_id          =   $this->oldProduct->category_id ?? Null;
        $this->indications          =   $this->oldProduct->indications ?? [];
        $this->selectedIndications  =   $this->oldProduct->indications->pluck('id')->map(function ($id) {
            return strval($id);
        })->toArray() ?? [];
        $this->ingredients          =   $this->oldProduct->ingredients ?? [];
        $this->selectedIngredients  =   $this->oldProduct->ingredients->map(function ($ingredient) {
            return strval($ingredient['id'] . ' | ' . $ingredient['name'] . ' | ' . $ingredient['pivot']['concentration'] . ' | ' . $ingredient['pivot']['role']);
        })->toArray() ?? [];
        $this->selectedPhotos = json_decode($this->oldProduct->product_photo) ?? [];
        $this->differentIngredients = $this->editedProduct->ingredients->map(function ($item, $key) {
            return [$item['id'], $item['pivot']['concentration'], $item['pivot']['role']];
        })->toArray() == $this->ingredients->map(function ($item, $key) {
            return [$item['id'], $item['pivot']['concentration'], $item['pivot']['role']];
        })->toArray();
    }

    public function render()
    {
        return view('livewire.admin.products.edited-product-review-data-table');
    }

    public function updated()
    {
        $this->emit('updated');
    }

    public function removeEdit()
    {
        $this->editedProduct->update([
            'approved' => 2
        ]);

        session()->flash('success', $this->name . " Edits Removed Successfully");

        return redirect()->to(route('admin.edited_products.index'));
    }

    public function saveEdit()
    {

        // Update the product
        $this->oldProduct->update([
            'name' => $this->name,
            'volume' =>  $this->volume,
            'units' =>  $this->units,
            'price' =>  $this->price,
            'advantages' =>  $this->advantages,
            'disadvantages' =>  $this->disadvantages,
            'notes' =>  $this->notes,
            'directions_of_use' =>  $this->directions_of_use,
            'code' =>  $this->code,
            'line_id' =>  $this->line_id ?? Null,
            'brand_id' =>  $this->brand_id,
            'form_id' =>  $this->form_id,
            'category_id' =>  $this->category_id,
            'product_photo' => !empty($this->selectedPhotos) ? json_encode($this->selectedPhotos) : '["default_product.png"]'
        ]);

        // Synconization of Indications
        if (!empty($this->selectedIndications)) {
            $this->oldProduct->indications()->sync($this->selectedIndications);
        } else {
            $this->oldProduct->indications()->detach();
        }
        
        
        // Synconization of Ingredients
        if (!empty($this->selectedIngredients)) {
            $this->oldProduct->ingredients()->detach();
            foreach ($this->selectedIngredients as $selectedIngredient) {
                $ingredient = explode(' | ', $selectedIngredient);
                $findIngredient = Ingredient::findOrFail($ingredient[0]); 
                $this->oldProduct->ingredients()->attach($findIngredient, ['concentration' => $ingredient[2], 'role' => $ingredient[3]]);
            }
        } else {
            $this->oldProduct->ingredients()->detach();
        }

        // change the status of Edited product to be approved and disappearing it
        $this->editedProduct->update([
            'approved' => 1
        ]);

        // redirect back with success message
        session()->flash('success', $this->name . " Edited Successfully");

        return redirect()->to(route('admin.edited_products.index'));
    }
}
