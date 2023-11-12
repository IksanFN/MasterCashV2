<?php

namespace App\Http\Requests\PaymentAccounts;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class Store extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'account_name' => ['required', 'string'],
            'account_title' => ['nullable', 'string'],
            'account_number' => ['required', 'numeric', 'unique:payment_accounts'],
            'account_type' => ['required', 'in:Bank,E-Wallet,Treasurer Wallet', 'not_in:default']
        ];
    }
}
