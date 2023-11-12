<?php

namespace App\Livewire\PaymentAccounts;

use App\Models\PaymentAccount;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class PaymentAccountList extends Component
{
    use WithPagination;

    #[Url()]
    public $query = '';

    public $limit = 10;

    public function render()
    {
        $paymentAccounts = PaymentAccount::query()
                        ->when($this->query, function($query) {
                            $query->where('account_name', 'like', '%'.$this->query.'%')
                                    ->orWhere('account_title', 'like', '%'.$this->query.'%')
                                    ->orWhere('account_number', 'like', '%'.$this->query.'%');
                        })
                        ->latest()
                        ->paginate($this->limit);
        return view('livewire.payment-accounts.payment-account-list', compact('paymentAccounts'));
    }
}
