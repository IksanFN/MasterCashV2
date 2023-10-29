<?php

namespace Database\Seeders;

use App\Models\PaymentAccount;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $payment_accounts = [
            [
                'account_name' => 'Jia Nuraya',
                'account_title' => 'Gopay',
                'account_number' => '083822658032',
                'account_type' => 'E-Wallet',
            ],
            [
                'account_name' => 'Riska Yulianti',
                'account_title' => 'Treasurer Wallet',
                'account_type' => 'Treasurer Wallet',
            ],
        ];

        foreach ($payment_accounts as $payment_account) {
            PaymentAccount::create($payment_account);
        }
    }
}
