<?php

namespace App\Http\Controllers;

use Midtrans\Snap;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use RealRashid\SweetAlert\Facades\Alert;

class CheckoutController extends Controller
{

    public function __construct()
    {
        Config::$serverKey = env('MIDTRANS_SERVERKEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION');
        Config::$isSanitized = env('MIDTRANS_IS_SANITIZED');
        Config::$is3ds = env('MIDTRASN_IS_3DS');
    }

    public function index(Transaction $transaction)
    {
        return view('checkouts.index', compact('transaction'));
    }

    public function storeCheckout(Request $request, Transaction $transaction)
    {
        // return $transaction;
        $data = $request->except('_token');
        $data['user_payment'] = Auth::user()->name;

        // $this->getToken($checkout);

        $orderId = $transaction->id.'-'.Str::random(7);
        $transaction->midtrans_booking_code = $orderId;
        $name = $transaction->week->title.", ".$transaction->month->title." ".$transaction->year->title;

        $item_details[] = [
            'id' => $orderId,
            'price' => $transaction->bill,
            'name' => "Payment for {$name} Bill",
        ];

        $studentData = [
            'first_name' => $transaction->user->name,
            'last_name' => '',
            'address' => $transaction->user->address,
            'city' => '',
            'postal_code' => '',
            'phone' => $transaction->phone,
            'country_code' => 'IDN',
        ];

        $transaction_details = [
            'order_id' => $orderId,
            'gross_amount' => $transaction->bill,
        ];

        $customer_details = [
            'first_name' => $transaction->user->name,
            'last_name' => '',
            'email' => $transaction->user->email,
            'phone' => $transaction->user->phone,
            'billing_address' => $studentData,
            'shipping_address' => $studentData,
        ];

        $midtrans_params = [
            'transaction_details' => $transaction_details,
            'customer_details' => $customer_details,
            'items_details' => $item_details,
        ];

        try {
            // $paymentUrl = Snap::createTransaction($midtrans_params);
            // $snapToken = Snap::getSnapToken($midtrans_params);
            $checkout = Transaction::query()->where('uuid', $transaction->uuid)->update([
                'user_payment' => $data['user_payment'],
                'payment_url' => Snap::createTransaction($midtrans_params),
                'payment_token' => Snap::getSnapToken($midtrans_params),
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }

        Alert::success('Success', 'Payment Success');
        return to_route('bills.index');
    }

    public function getToken($checkout)
    {
        return $checkout;
        
    }
}
