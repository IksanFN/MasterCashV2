<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Expense;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke()
    {
        // Get Data Student
        $student = User::where('is_student', true)->count();

        // Get Announcement
        $now = Carbon::today()->toDateString();
        $announcement = Announcement::query()->latest()->first();

        // Get Data Expense
        $expense = new Expense();
        $totalExpense = $expense->getTotalExpense();
        
        // Get Data Transaction
        $transaction = new Transaction();
        $totalIncome = $transaction->getTotalIncome();
        $bill = $transaction->getBill();
        $confirm = $transaction->getTransactionConfirm();
        $paid = $transaction->getTransactionPaid();
        $cancel = $transaction->getTransactionCancel();
        $recentlyTransactions = Transaction::take(5)->orderBy('payment_date', 'desc')->get();
        $totalTransaction = $transaction->getTotalTransaction();

        return view('dashboard', compact('announcement', 'now', 'recentlyTransactions', 'totalIncome', 'bill', 'paid', 'cancel', 'confirm', 'student', 'totalTransaction', 'totalExpense'));
    }
}
