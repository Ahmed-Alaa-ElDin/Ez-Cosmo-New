<?php

namespace App\Http\Livewire\Admin;

use App\Models\Form;
use Livewire\Component;
use Livewire\WithPagination;

class FormDataTable extends Component
{
    use WithPagination;
    
    protected $paginationTheme = 'bootstrap';
    
    public $sortBy = 'name';
    
    public $sortDirection = 'ASC';
    
    public $perPage = 10;
    
    public $search = "";
    
    public $form_id, $form_name;


    public function render()
    {

        $forms = $this->query();

        return view('livewire.admin.forms.form-data-table', compact('forms'));
    }

    public function query()
    {
        return Form::where('forms.name', 'like', '%' . $this->search . '%')
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

    public function load($form_id, $form_name)
    {
        $this->form_id = $form_id;
        $this->form_name = $form_name; 
    }

    public function deleteForm($form_id)
    {
        Form::findOrFail($form_id)->delete();

        $this->emit('success', ['type' => 'success', 'message' => "$this->form_name has been Deleted Successfully."]);
    }
}
