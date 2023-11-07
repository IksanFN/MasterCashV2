<?php

namespace App\Livewire\Permissions;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;

class PermissionList extends Component
{
    use WithPagination;

    public $query = '';

    public $limit = 10;

    public function updated($property): void
    {
        if ($property === 'query') {
            $this->resetPage();
        }
    }

    public function render()
    {
        $permissions = Permission::query()
                        ->when($this->query, function($query) {
                            $query->where('name', 'like', '%'.$this->query.'%');
                        })
                        ->latest()
                        ->paginate();
        return view('livewire.permissions.permission-list', compact('permissions'));
    }
}
