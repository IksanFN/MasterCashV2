<?php

namespace App\Livewire\Expenses;

use App\Exports\ExpenseExport;
use App\Models\Expense;
use Livewire\Component;
use Livewire\WithPagination;

class ExpenseList extends Component
{
    use WithPagination;

    public $query = '';

    public $startDate = '';

    public $endDate = '';

    public function updated($property): void
    {
        if ($property === 'query') {
            $this->resetPage();
        }
    }

    public function render()
    {
        $expenses = Expense::query()
                            ->when($this->query, function($query) {
                                $query->where('title', 'like', '%'.$this->query.'%')
                                        ->orWhere('amount', 'like', '%'.$this->query.'%');
                            })
                            ->when($this->startDate, function($startDate) {
                                $startDate->whereBetween('expense_date', [$this->startDate, $this->endDate]);
                            })
                            ->latest()
                            ->paginate();
        return view('livewire.expenses.expense-list', compact('expenses'));
    }

    public function export()
    {
        return (new ExpenseExport)->forSearch($this->query)->forDate($this->startDate, $this->endDate)->download('Expense-List.xlsx');
    }
}
