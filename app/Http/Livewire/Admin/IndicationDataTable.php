<?php

namespace App\Http\Livewire\Admin;

use App\Models\Indication;
use Livewire\Component;
use Livewire\WithPagination;

class IndicationDataTable extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $sortBy = 'name';

    public $sortDirection = 'ASC';

    public $perPage = 10;

    public $search = "";

    public $indication_id, $indication_name;


    public function render()
    {
        $indications = $this->query();

        return view('livewire.admin.indications.indication-data-table', compact('indications'));
    }

    public function query()
    {
        return Indication::where('indications.name', 'like', '%' . $this->search . '%')
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

    public function load($indication_id, $indication_name)
    {
        $this->indication_id = $indication_id;
        $this->indication_name = $indication_name;
    }

    public function deleteIndication($indication_id)
    {
        Indication::findOrFail($indication_id)->delete();

        $this->emit('success', ['type' => 'success', 'message' => "$this->indication_name has been Deleted Successfully."]);
    }
}
