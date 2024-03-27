<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserStore extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        return [
            'avatar' => ['nullable', 'image', 'mimes:png,jpg,jpeg', 'mimetypes:image/jpeg,image/png'],
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:6'],
            'phone' => ['nullable', 'min:8', 'numeric'],
            'roles' => ['required', 'not_in:defaul'],
        ];
    }
}
