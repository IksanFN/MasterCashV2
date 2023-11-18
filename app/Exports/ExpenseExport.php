<?php

namespace App\Exports;

use App\Models\Expense;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ExpenseExport implements FromQuery, WithMapping, WithHeadings, ShouldAutoSize, WithStyles
{
    use Exportable;

    public $query;
    public $startDate;
    public $endDate;

    public function forSearch($query)
    {
        $this->query = $query;

        return $this;
    }

    public function forDate($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;

        return $this;
    }

    public function headings(): array
    {
        return [
            'Title',
            'Amount',
            'Description',
            'Expense Date'
        ];
    }

    public function query()
    {
        return Expense::query()
                        ->when($this->query, function($query) {
                            $query->where('title', 'like', '%'.$this->query.'%')
                                    ->orWhere('amount', 'like', '%'.$this->query.'%');
                        })
                        ->when($this->startDate, function($startDate) {
                            $startDate->whereBetween('expense_date', [$this->startDate, $this->endDate]);
                        })
                        ->latest();
    }

    public function map($expenses): array
    {
        return [
            $expenses->title,
            $expenses->amount,
            $expenses->description,
            $expenses->expense_date,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
