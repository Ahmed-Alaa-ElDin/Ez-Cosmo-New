<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class CountriesUserDataTable extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $sortBy = 'first_name';

    public $sortDirection = 'ASC';

    public $perPage = 10;

    public $search = "";

    public $countryID, $countryName;

    public $user_id, $name, $country, $mail, $phone, $gender, $visit_num, $verified_mail, $last_visit, $created_at, $updated_at, $image = '';

    public function render()
    {
        $users = $this->query();

        return view('livewire.admin.countries.countries-user-data-table', compact('users'));
    }

    public function query()
    {
        return User::select('users.*', 'roles.name')
            ->leftjoin('model_has_roles', 'model_id', '=', 'users.id')
            ->leftjoin('roles', 'role_id', '=', 'roles.id')
            ->where('country_id', $this->countryID)
            ->where(function ($q) {
                $q->where('users.first_name', 'like', '%' . $this->search . '%')
                    ->orWhere('users.last_name', 'like', '%' . $this->search . '%')
                    ->orWhere('users.email', 'like', '%' . $this->search . '%')
                    ->orWhere('users.phone', 'like', '%' . $this->search . '%')
                    ->orWhere('users.visit_num', 'like', '%' . $this->search . '%')
                    ->orWhere('roles.name', 'like', '%' . $this->search . '%');
            })
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

    public function load($id)
    {
        $user = User::with('country')->findOrFail($id);

        $this->user_id = $id;
        $this->name = $user->first_name . ' ' . $user->last_name;
        $this->country = $user->country->name ?? 'N/A';
        $this->mail = $user->email;
        $this->phone = $user->phone ?: "N/A";
        $this->gender = $user->gender == 1 ? "Male" : "Female";
        $this->visit_num = $user->visit_num;
        $this->verified_mail = $user->email_verified_at ? "Yes" : "No";
        $this->last_visit = $user->last_visit ?: "N/A";
        $this->created_at = $user->created_at;
        $this->updated_at = $user->updated_at;
        $this->image = $user->profile_photo;
    }

    public function deleteUser($user_id)
    {
        User::findOrFail($user_id)->delete();

        $this->emit('success', ['type' => 'success', 'message' => "$this->name has been Deleted Successfully."]);
    }
}
