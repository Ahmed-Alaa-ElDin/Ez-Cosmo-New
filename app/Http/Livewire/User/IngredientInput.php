<?php

namespace App\Http\Livewire\User;

use App\Models\Ingredient;
use Livewire\Component;

class IngredientInput extends Component
{
    public $ingredients, $selectedIngredients;

    protected $listeners = ['rerenderIngredient' => '$refresh'];

    public function mount()
    {
        $this->selectedIngredients = [
            [
                'name' => '0',
                'concentration' => '',
                'role' => '',
            ]
        ];
    }
    public function render()
    {
        $this->ingredients = Ingredient::all();

        $this->emit('initializeSelect');

        return view('livewire.user.ingredient-input');
    }

    public function updatedSelectedIngredients()
    {
        $this->emitUp('getIngredients', $this->selectedIngredients);
    }

    public function addIngredient()
    {
        $this->selectedIngredients[] =
            [
                'name' => '0',
                'concentration' => '',
                'role' => '',
            ];
    }

    public function deleteIngredient($index)
    {
        unset($this->selectedIngredients[$index]);
        array_values($this->selectedIngredients);
    }
}
