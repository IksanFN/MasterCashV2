<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserUpdate extends FormRequest
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
            'avatar' => ['nullable', 'image', 'mimes:png,jpg,jpeg'],
            'classroom' => ['required', 'not_in:default'],
            'major' => ['required', 'not_in:default'],
            'nisn' => ['required', 'numeric', Rule::unique('users', 'nisn')->ignore($this->user->uuid, 'uuid')],
            'name' => ['required', 'string'],
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($this->user->uuid, 'uuid')],
            'password' => ['required', 'min:6', 'numeric'],
            'phone' => ['nullable', 'min:8'],
            'gender' => ['required', 'in:Male,Female'],
            'address' => ['nullable', 'string'],
            'roles' => ['required'],
        ];
    }
}
