<?php

namespace App\Livewire\Reports;

use App\Exports\ReportExport;
use App\Models\Classroom;
use App\Models\Month;
use App\Models\PaymentAccount;
use App\Models\Transaction;
use App\Models\Week;
use App\Models\Year;
use Livewire\Attributes\Url;
use Livewire\Component;

class ReportList extends Component
{
    // #[Url()]
    public $classroom = '';

    // #[Url()]
    public $status = '';

    // #[Url()]
    public $year = '';
    
    // #[Url()]
    public $month = '';

    // #[Url()]
    public $week = '';

    // #[Url()]
    public $startDate = '';

    public $endDate = '';

    public $paymentMethod = '';

    public function render()
    {
        $classrooms = Classroom::all();
        $years = Year::all();
        $months = Month::all();
        $weeks = Week::all();
        $paymentAccount = PaymentAccount::all();
        return view('livewire.reports.report-list', compact('classrooms', 'years', 'months', 'weeks', 'paymentAccount'));
    }

    public function export()
    {
        return (new ReportExport)->forClassroom($this->classroom)->forStatus($this->status)->forYear($this->year)->forMonth($this->month)->forWeek($this->week)->forPaymentMethod($this->paymentMethod)->download('Report.xlsx');
    }
}
