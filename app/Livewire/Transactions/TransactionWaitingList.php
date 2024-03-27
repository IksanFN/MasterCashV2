<?php

namespace App\Livewire\Transactions;

use App\Models\Classroom;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class TransactionWaitingList extends Component
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
        if (Auth::user()->for_classroom != 0) {
            $classrooms = Classroom::where('id', Auth::user()->for_classroom)->get();
            $transactions = Transaction::query()->where('is_paid', true)->where('payment_status', 'Waiting')
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
            return view('livewire.transactions.transaction-waiting-list', compact('transactions', 'classrooms'));
        } else {
            $classrooms = Classroom::all();
            $transactions = Transaction::query()->where('is_paid', true)->where('payment_status', 'Waiting')
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
            return view('livewire.transactions.transaction-waiting-list', compact('transactions', 'classrooms'));
        }
    }
}
