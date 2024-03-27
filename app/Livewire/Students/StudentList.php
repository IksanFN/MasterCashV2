<?php

namespace App\Livewire\Students;

use App\Exports\StudentExport;
use App\Models\Classroom;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class StudentList extends Component
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
        
        $for_classroom = Auth::user()->for_classroom;
        if ($for_classroom != 0) {
            $classrooms = Classroom::where('id', $for_classroom)->get();
            $students = User::query()->where('is_student', true)->where('classroom_id', $for_classroom)
                                ->when($this->query, function($query) {
                                    $query->where(function($query) {
                                        $query->where('nisn', 'like', '%'.$this->query.'%')
                                                ->orWhere('name', 'like', '%'.$this->query.'%');
                                    });
                                })
                                ->when($this->classroom, function($classroom) {
                                    $classroom->where(function($classroom) {
                                        $classroom->where('classroom_id', '=', $this->classroom);
                                    });
                                })
                                ->latest()
                                ->paginate($this->limit);
            return view('livewire.students.student-list', compact('students', 'classrooms'));
        } else {
            $classrooms = Classroom::all();
            $students = User::query()->where('is_student', true)
                                ->when($this->query, function($query) {
                                    $query->where(function($query) {
                                        $query->where('nisn', 'like', '%'.$this->query.'%')
                                                ->orWhere('name', 'like', '%'.$this->query.'%');
                                    });
                                })
                                ->when($this->classroom, function($classroom) {
                                    $classroom->where(function($classroom) {
                                        $classroom->where('classroom_id', '=', $this->classroom);
                                    });
                                })
                                ->latest()
                                ->paginate($this->limit);
            return view('livewire.students.student-list', compact('students', 'classrooms'));
        }
        
        
    }

    // Export Excel
    public function export()
    {
        return (new StudentExport)->forSearch($this->query)->forClassroom($this->classroom)->download('List-Student.xlsx');
    }
}
