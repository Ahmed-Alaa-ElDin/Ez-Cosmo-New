<?php

namespace App\Http\Livewire\Admin;

use App\Models\Country;
use Livewire\Component;
use Livewire\WithPagination;

class CountryDataTable extends Component
{
    use WithPagination;
    
    protected $paginationTheme = 'bootstrap';
    
    public $sortBy = 'name';
    
    public $sortDirection = 'ASC';
    
    public $perPage = 10;
    
    public $search = "";
    
    public $country_id, $country_name;


    public function render()
    {
        $countries = $this->query();

        return view('livewire.admin.countries.country-data-table', compact('countries'));
    }

    public function query()
    {
        return Country::where('countries.name', 'like', '%' . $this->search . '%')
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage);
    }

    public function sortBy($field)
    {

        if ($this->sortDirection == 'ASC') {
            $this->sortDirection = 'DESC';
        } else {
            $this->sortDirection = 'ASC';
        }

        return $this->sortBy = $field;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function load($country_id, $country_name)
    {
        $this->country_id = $country_id;
        $this->country_name = $country_name; 
    }

    public function deleteCountry($country_id)
    {
        Country::findOrFail($country_id)->delete();

        $this->emit('success', ['type' => 'success', 'message' => "$this->country_name has been Deleted Successfully."]);
    }

}
