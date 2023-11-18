<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $now = Carbon::today()->toDateString();
        $announcement = Announcement::query()->latest()->first();
        $recentlyTransactions = Transaction::take(5)->orderBy('payment_date', 'desc')->get();

        // Get Data
        $transaction = new Transaction();
        $totalIncome = $transaction->getTotalIncome();
        $bill = $transaction->getBill();
        $confirm = $transaction->getTransactionConfirm();
        $paid = $transaction->getTransactionPaid();
        $cancel = $transaction->getTransactionCancel();

        return view('dashboard', compact('announcement', 'now', 'recentlyTransactions', 'totalIncome', 'bill', 'paid', 'cancel', 'confirm'));
    }
}
