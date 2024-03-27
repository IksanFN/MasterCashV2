<?php

namespace App\Livewire\Bills;

use App\Exports\BillExport;
use App\Models\Classroom;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use PhpParser\Builder\Class_;

class BillList extends Component
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
            $bills = Transaction::query()->where('is_paid', false)->where('payment_status', 'Unpaid')
                                ->whereHas('user', function($q) {
                                    $q->where('classroom_id', '=', Auth::user()->for_classroom);
                                })
                                ->when($this->query, function($query) {
                                    $query->where('bill_code', 'like', '%'.$this->query.'%')
                                        ->orWhereHas('user', function($query) {
                                            $query->where('nisn', 'like', '%'.$this->query.'%')
                                                ->orWhere('name', 'like', '%'.$this->query.'%');
                                    });
                                })
                                ->when($this->classroom, function($classroom) {
                                    $classroom->whereHas('user', function($classroom) {
                                        $classroom->where('classroom_id', '=', $this->classroom);
                                    });
                                })
                                ->latest()
                                ->paginate($this->limit);
        return view('livewire.bills.bill-list', compact('classrooms', 'bills'));
        } else {
            $classrooms = Classroom::all();
            $bills = Transaction::query()->where('is_paid', false)->where('payment_status', 'Unpaid')
                                ->when($this->query, function($query) {
                                    $query->where('bill_code', 'like', '%'.$this->query.'%')
                                        ->orWhereHas('user', function($query) {
                                            $query->where('nisn', 'like', '%'.$this->query.'%')
                                                ->orWhere('name', 'like', '%'.$this->query.'%');
                                    });
                                })
                                ->when($this->classroom, function($classroom) {
                                    $classroom->whereHas('user', function($classroom) {
                                        $classroom->where('classroom_id', '=', $this->classroom);
                                    });
                                })
                                ->latest()
                                ->paginate($this->limit);
        return view('livewire.bills.bill-list', compact('classrooms', 'bills'));
        }
    }

    public function export()
    {
        return (new BillExport)->forSearch($this->query)->forClassroom($this->classroom)->download('List-Bills.xlsx');
    }
}
