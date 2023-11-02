<?php

namespace App\Livewire\Transactions;

use App\Models\Classroom;
use App\Models\Transaction;
use Livewire\Component;
use Livewire\WithPagination;

class TransactionCancelList extends Component
{
    use WithPagination;

    public $query = '';

    public $classroom = '';

    public $limit = 10;

    public function render()
    {
        $classrooms = Classroom::all();
        $transactions = Transaction::query()->where('is_cancel', true)->where('payment_status', 'Cancel')
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
        return view('livewire.transactions.transaction-cancel-list', compact('transactions', 'classrooms'));
    }
}
