<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserStore extends FormRequest
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
            'nisn' => ['required', 'numeric', 'unique:users'],
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:6'],
            'phone' => ['nullable', 'min:8', 'numeric'],
            'gender' => ['required', 'in:Male,Female'],
            'address' => ['nullable', 'string'],
            'roles' => ['required'],
        ];
    }
}
