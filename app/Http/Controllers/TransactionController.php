<?php

namespace App\Http\Controllers;

use Midtrans\Config;
use App\Models\Transaction;
use PDF;
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

    public function storeConfirm(Transaction $transaction)
    {
        $transaction->update([
            'transaction_code' => 'TRX-'.substr($transaction->user->nisn, -3).Str::upper(Str::random(7)),
            'payment_status' => 'Paid',
            'is_verified' => true,
            'payment_verified' => true,
            'verified_date' => Carbon::now(),
        ]);

        Alert::success('Success', 'Transaction Verified Successfully');
        return to_route('transactions.paid');
    }

    public function invoice($uuid)
    {
        $invoice = Transaction::query()->with(['user', 'year', 'month', 'week', 'paymentAccount'])->where('uuid', $uuid)->first();
        return view('transactions.invoice', compact('invoice'));
    }

    public function exportPdf($uuid)
    {
        $transaction = Transaction::whereUuid($uuid)->first();
        $data = [
            'billing' => $transaction->week->title.', '.$transaction->month->title.' '.$transaction->year->title,
            'student' => $transaction->user->name,
            'transaction_code' => $transaction->transaction_code,
            'classroom' => $transaction->user->classroom->title,
            'payment_status' => $transaction->payment_status,
            'payment_date' => $transaction->payment_date,
            'email' => $transaction->user->email,
            'phone' => $transaction->user->phone,
            'major' => $transaction->user->major->title,
            'amount' => $transaction->bill,
            'payment_method' => $transaction->paymentAccount->account_title
        ];

        $pdf = PDF::loadView('transactions.invoice-pdf', $data);
        return $pdf->download($transaction->transaction_code.'.pdf');
    }
}
