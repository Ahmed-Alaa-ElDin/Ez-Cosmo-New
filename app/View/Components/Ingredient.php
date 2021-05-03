<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Ingredient extends Component
{
    public $ingredients;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($ingredients)
    {
        $this->ingredients=$ingredients;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.ingredient');
    }
}
