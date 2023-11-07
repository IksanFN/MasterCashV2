<?php

namespace App\Livewire\Classrooms;

use App\Models\Classroom;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class ClassroomList extends Component
{
    use WithPagination;

    #[Url()]
    public $query = '';

    public $limit = 10;

    public function render()
    {
        $classrooms = Classroom::query()
                        ->when($this->query, function($query) {
                            $query->where('title', 'like', '%'.$this->query.'%');
                        })
                        ->latest()
                        ->paginate($this->limit);
        return view('livewire.classrooms.classroom-list', compact('classrooms'));
    }
}
