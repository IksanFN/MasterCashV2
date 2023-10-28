<?php

namespace App\Http\Controllers;

use Midtrans\Config;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Midtrans\Snap;
use RealRashid\SweetAlert\Facades\Alert;

class TransactionController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = env('MIDTRANS_SERVERKEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION');
        Config::$isSanitized = env('MIDTRANS_IS_SANITIZED');
        Config::$is3ds = env('MIDTRASN_IS_3DS');
    }

    public function checkout(Transaction $transaction)
    {
        // return $transaction;
        return view('checkouts.index', compact('transaction'));
    }

    public function integratePaymentGateway(Transaction $checkout)
    {
        $orderId = $checkout->id.'-'.Str::random(7);
        $checkout->midtrans_booking_code = $orderId;
        $name = $checkout->week->title.", ".$checkout->month->title." ".$checkout->year->title;

        $item_details[] = [
            'id' => $orderId,
            'price' => $checkout->bill,
            'name' => "Payment for {$name} Bill",
        ];

        $studentData = [
            'first_name' => $checkout->user->name,
            'last_name' => '',
            'address' => $checkout->user->address,
            'city' => '',
            'postal_code' => '',
            'phone' => $checkout->phone,
            'country_code' => 'IDN',
        ];

        $transaction_details = [
            'order_id' => $orderId,
            'gross_amount' => $checkout->bill,
        ];

        $customer_details = [
            'first_name' => $checkout->user->name,
            'last_name' => '',
            'email' => $checkout->user->email,
            'phone' => $checkout->user->phone,
            'billing_address' => $studentData,
            'shipping_address' => $studentData,
        ];

        $midtrans_params = [
            'transaction_details' => $transaction_details,
            'customer_details' => $customer_details,
            'items_details' => $item_details,
        ];

        try {
            $paymentUrl = Snap::createTransaction($midtrans_params);
            $snapToken = Snap::getSnapToken($midtrans_params);
            $checkout->payment_url = $paymentUrl;
            $checkout->token = $snapToken;
            $checkout->save();
        } catch (\Throwable $th) {
            return false;
        }
    }

    
}
