<?php

namespace App\Exports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class BillExport implements FromQuery, WithMapping, WithHeadings, ShouldAutoSize, WithStyles
{
    use Exportable;

    public $query;
    public $classroom;

    public function headings(): array
    {
        return [
            'Bill Code',
            'NISN',
            'Name',
            'Classroom',
            'Amonth',
            'Bill',
            'Status',
        ];
    }

    public function forSearch($query)
    {
        $this->query = $query;
        return $this;
    }

    public function forClassroom($classroom)
    {
        $this->classroom = $classroom;
        return $this;
    }

    public function query()
    {
        return Transaction::query()->where('is_paid', false)->where('payment_status', 'Unpaid')
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
                                ->latest();
    }

    public function map($transactions): array
    {   
        return [
            $transactions->bill_code,
            $transactions->user->nisn,
            $transactions->user->name,
            $transactions->user->classroom->title,
            $transactions->bill,
            $transactions->week->title.", ".$transactions->month->title." ".$transactions->year->title,
            'Unpaid',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
