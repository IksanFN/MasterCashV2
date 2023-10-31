<?php

namespace App\Livewire\Bills;

use App\Models\Classroom;
use App\Models\Transaction;
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
