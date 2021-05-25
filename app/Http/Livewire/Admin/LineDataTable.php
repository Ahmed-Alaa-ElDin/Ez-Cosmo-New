<?php

namespace App\Http\Livewire\Admin;

use App\Models\Line;
use Livewire\Component;
use Livewire\WithPagination;

class LineDataTable extends Component
{
    use WithPagination;
    
    protected $paginationTheme = 'bootstrap';
    
    public $sortBy = 'name';
    
    public $sortDirection = 'ASC';
    
    public $perPage = 10;
    
    public $search = "";
    
    public $line_id, $line_name;


    public function render()
    {
        $lines = $this->query();

        return view('livewire.admin.line-data-table', compact('lines'));
    }

    public function query()
    {
        return Line::select('lines.*', 'brands.name As brand_name')
            ->leftjoin('brands', 'brands.id', '=', 'lines.brand_id')
            ->where('lines.name', 'like', '%' . $this->search . '%')
            ->orWhere('brands.name', 'like', '%' . $this->search . '%')
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

    public function load($line_id, $line_name)
    {
        $this->line_id = $line_id;
        $this->line_name = $line_name; 
    }

    public function deleteLine($line_id)
    {
        Line::find($line_id)->delete();

        $this->emit('success', ['type' => 'success', 'message' => "$this->line_name has been Deleted Successfully."]);
    }

}
