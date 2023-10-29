<?php

namespace App\Http\Controllers;

use Midtrans\Config;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Midtrans\Snap;
use RealRashid\SweetAlert\Facades\Alert;

class TransactionController extends Controller
{
    public function paid()
    {
        $transactions = Transaction::query()->where('is_paid', true)->where('payment_status', 'Paid')->latest()->paginate();
        return view('transactions.paid', compact('transactions'));
    }

    public function waitingConfirm()
    {
        $transactions = Transaction::query()->where('is_paid', true)->where('payment_status', 'Waiting')->latest()->paginate();
        return view('transactions.waiting', compact('transactions'));
    }

    public function cancel()
    {
        $transactions = Transaction::query()->where('is_cancel', true)->where('payment_status', 'Cancel')->latest()->paginate();
        return view('transactions.cancel', compact('transactions'));
    }

    public function storeCancel(Transaction $transaction)
    {
         $transaction->update([
            'is_cancel' => true,
            'payment_status' => 'Cancel',
            'cancel_date' => Carbon::now(),
            'user_cancel' => Auth::user()->name,
         ]);

         Alert::success('Success', 'Payment Canceled Successfully');
         return to_route('transactions.cancel');
    }

    public function invoice($uuid)
    {
        $invoice = Transaction::query()->with(['user', 'year', 'month', 'week'])->where('uuid', $uuid)->first();
        return view('transactions.invoice', compact('invoice'));
    }
}
