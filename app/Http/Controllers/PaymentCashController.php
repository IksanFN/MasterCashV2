<?php

namespace App\Http\Controllers;

use App\Models\PaymentAccount;
use Carbon\Carbon;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class PaymentCashController extends Controller
{
    public function checkoutCash($uuid)
    {
        $checkout = Transaction::query()->where('uuid', $uuid)->first();
        $paymentAccount = PaymentAccount::query()->where('account_type', 'Treasurer Wallet')->get();
        return view('checkouts.checkout-cash', compact('checkout', 'paymentAccount'));
    }

    public function paymentCash(Request $request, $uuid)
    {
        $payment = Transaction::query()->with('user')->where('uuid', $uuid)->first(); 
        $payment->update([
            'transaction_code' => 'TRX-'.substr($payment->user->nisn, -3).Str::upper(Str::random(7)),
            'is_paid' => true,
            'payment_status' => 'Paid',
            'payment_date' => Carbon::now(),
            'is_verified' => true,
            'payment_verified' => true,
            'payment_account' => $request->payment_account,
            'user_payment' => Auth::user()->name,
        ]);

        if ($payment) {
            Alert::success('Success', 'Payment Successfully');
        } else {
            Alert::error('Failed', 'Failed to Payment');
        }

        return to_route('bills.index');
    }
}
