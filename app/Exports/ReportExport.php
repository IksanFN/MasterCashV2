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

class ReportExport implements FromQuery, WithMapping, WithHeadings, ShouldAutoSize, WithStyles
{
    use Exportable;

    public $classroom;
    public $status;
    public $year;
    public $month;
    public $week;
    public $startDate;
    public $endDate;

    public function headings(): array
    {
        return [
            'Bill Code',
            'Transaction Code',
            'NISN',
            'Name',
            'Classroom',
            'Billing',
            'Amount',
            'Status',
            'Payment Date'
        ];
    }

    public function forYear($year)
    {
        $this->year = $year;

        return $this;
    }

    public function forMonth($month)
    {
        $this->month = $month;

        return $this;
    }

    public function forWeek($week)
    {
        $this->week = $week;

        return $this;
    }

    public function forClassroom($classroom)
    {
        $this->classroom = $classroom;

        return $this;
    }

    public function forStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    public function forDate($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;

        return $this;
    }

    public function query()
    {
        return Transaction::query()
                            ->when($this->classroom, function($classroom) {
                                $classroom->whereHas('user', function($classroom) {
                                    $classroom->where('classroom_id', '=', $this->classroom);
                                });
                            })
                            ->when($this->status, function($status) {
                                $status->where('payment_status', '=', $this->status);
                            })
                            ->when($this->year, function($year) {
                                $year->where('year_id', '=', $this->year);
                            })
                            ->when($this->month, function($month) {
                                $month->where('month_id', '=', $this->month);
                            })
                            ->when($this->week, function($week) {
                                $week->where('week_id', '=', $this->week);
                            })
                            ->when($this->startDate, function($startDate) {
                                $startDate->where('payment_date', '>=', $this->startDate)
                                            ->where('payment_date', '<=', $this->endDate);
                            })
                            ->latest();
    }

    public function map($reports): array
    {
        return [
            $reports->bill_code,
            $reports->transaction_code,
            $reports->user->nisn,
            $reports->user->name,
            $reports->user->classroom->title,
            $reports->week->title.', '.$reports->month->title.' '.$reports->year->title,
            $reports->bill,
            $reports->payment_status,
            $reports->payment_date
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]]
        ];
    }
}
