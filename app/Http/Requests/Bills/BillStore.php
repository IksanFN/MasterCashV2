<?php

namespace App\Http\Requests\Bills;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class BillStore extends FormRequest
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
            'classroom' => ['required', 'not_in:default'],
            'year' => ['required', 'not_in:default'],
            'month' => ['required', 'not_in:default'],
            'week' => ['required', 'not_in:default'],
            'bill' => ['required', 'numeric'],
        ];
    }
}
