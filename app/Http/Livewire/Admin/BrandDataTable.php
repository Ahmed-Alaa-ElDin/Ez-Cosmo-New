<?php

namespace App\Http\Livewire\Admin;

use App\Models\Brand;
use Livewire\Component;
use Livewire\WithPagination;

class BrandDataTable extends Component
{
    use WithPagination;
    
    protected $paginationTheme = 'bootstrap';
    
    public $sortBy = 'name';
    
    public $sortDirection = 'ASC';
    
    public $perPage = 10;
    
    public $search = "";
    
    public $brand_id, $brand_name;


    public function render()
    {

        $brands = $this->query();

        return view('livewire.admin.brands.brand-data-table', compact('brands'));
    }

    public function query()
    {
        return Brand::select('brands.*', 'countries.name As country_name')
            ->leftjoin('countries', 'countries.id', '=', 'brands.country_id')
            ->where('brands.name', 'like', '%' . $this->search . '%')
            ->orWhere('countries.name', 'like', '%' . $this->search . '%')
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

    public function load($brand_id, $brand_name)
    {
        $this->brand_id = $brand_id;
        $this->brand_name = $brand_name; 
    }

    public function deleteBrand($brand_id)
    {
        Brand::findOrFail($brand_id)->delete();

        $this->emit('success', ['type' => 'success', 'message' => "$this->brand_name has been Deleted Successfully."]);
    }
}
