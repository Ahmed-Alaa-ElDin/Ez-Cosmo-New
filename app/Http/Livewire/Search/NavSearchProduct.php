<?php

namespace App\Http\Livewire\Search;

use Livewire\Component;

class NavSearchProduct extends Component
{
    public $search;
    public $ahmed;

    public function render()
    {
        return view('livewire.search.nav-search-product');
    }

    public function updatedSearch()
    {
        if ($this->search != "") {
            $this->emit('searchActive', $this->search ,true);
        } else {
            $this->emit('searchActive', $this->search ,false);
        }
    }
}
