<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class UserList extends Component
{
    use WithPagination;

    #[Url()]
    public $query = '';

    public $classroom = '';

    public $limit = 10;

    public function updated($property): void
    {
        if ($property === 'query') {
            $this->resetPage();
        }
    }

    public function render()
    {
        $users = User::query()->where('is_student', false)->where('is_active', true)
                        ->when($this->query, function($query) {
                            $query->where('name', 'like', '%'.$this->query.'%')
                                    ->where('email', 'like', '%'.$this->query.'%');
                        })
                        ->latest()->paginate();
        return view('livewire.users.user-list', compact('users'));
    }
}
