<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PaymentAccount;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\Payments\PaymentTransfer;

class PaymentTransferController extends Controller
{
    public function checkoutTransfer($uuid)
    {
        $paymentAccounts = PaymentAccount::query()->whereNot('account_type', 'Treasurer Wallet')->get();
        $checkout = Transaction::query()->where('uuid', $uuid)->first();
        return view('transactions.checkout-transfer', compact('checkout', 'paymentAccounts'));
    }

    public function paymentTransfer(PaymentTransfer $request, $uuid)
    {
        // return dd($request);
        $payment = Transaction::query()->with('user')->where('uuid', $uuid)->first();

        if ($request->hasFile('payment_receipt')) {
            
            $receipt = $request->file('payment_receipt');
            $receipt->storeAs('public/receipt', $receipt->hashName());

            $payment->update([
                'transaction_code' => 'TRX-'.substr($payment->user->nisn, -3).Str::upper(Str::random(7)),
                'is_paid' => true,
                'payment_receipt' => $receipt->hashName(),
                'payment_status' => 'Waiting',
                'is_verifired' => true,
                'payment_date' => Carbon::now(),
                'payment_account_id' => $request->payment_account,
                'payment_description' => $request->payment_description,
            ]);

        } else {
            $payment->update([
                'transaction_code' => 'TRX-'.substr($payment->user->nisn, -3).Str::upper(Str::random(7)),
                'is_paid' => true,
                'payment_status' => 'Waiting',
                'is_verifired' => true,
                'payment_date' => Carbon::now(),
                'payment_account_id' => $request->payment_account,
                'payment_description' => $request->payment_description,
            ]);
        }

        if ($payment) {
            Alert::success('Success', 'Payment is Process');
            return to_route('transactions.waiting');
        } else {
            Alert::error('Error', 'Something Wrong! Try Again Later');
            return to_route('transactions.waiting');
        }

    }
}
