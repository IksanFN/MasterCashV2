<?php

namespace App\Livewire\Roles;

use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class RoleList extends Component
{
    use WithPagination;

    #[Url()]
    public $query = '';

    public $limit = 10;

    public function render()
    {
        $roles = Role::query()
                        ->when($this->query, function($query) {
                            $query->where('name', 'like', '%'.$this->query.'%');
                        })
                        ->latest()
                        ->paginate($this->limit);
        return view('livewire.roles.role-list', compact('roles'));
    }
}
