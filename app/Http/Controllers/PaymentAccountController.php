<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentAccounts\Store;
use App\Models\PaymentAccount;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PaymentAccountController extends Controller
{
    public function index()
    {
        return view('payment-accounts.index');
    }

    public function create()
    {
        return view('payment-accounts.create');
    }

    public function store(Store $request)
    {
        // Store Data
        $paymentAccount = PaymentAccount::create([
            'account_name' => $request->account_name,
            'account_title' => $request->account_title,
            'account_number' => $request->account_number,
            'account_type' => $request->account_type
        ]);

        Alert::success('Success', 'Payment Account Created Successfully');
        return to_route('payment_accounts.index');
    }

    public function show(PaymentAccount $paymentAccount)
    {
        //
    }

    public function edit(PaymentAccount $paymentAccount)
    {
        return view('payment-accounts.edit', compact('paymentAccount'));
    }

    public function update(Request $request, PaymentAccount $paymentAccount)
    {
        // Update Data
        $paymentAccount->update([
            'account_name' => $request->account_name,
            'account_title' => $request->account_title,
            'account_number' => $request->account_number,
            'account_type' => $request->account_type,
        ]);
        
        Alert::success('Success', 'Updated Payment Account Successfully');

        return to_route('payment_accounts.index');
    }

    public function destroy(PaymentAccount $paymentAccount)
    {
        $paymentAccount->delete();

        Alert::success('Success', 'Deleted Payment Account Successfully');
        return back();
    }
}
