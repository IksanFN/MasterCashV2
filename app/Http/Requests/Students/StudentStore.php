<?php

namespace App\Http\Requests\Students;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StudentStore extends FormRequest
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
            'avatar' => ['nullable', 'image', 'mimes:png,jpg,jpeg', 'mimetypes:image/jpeg,image/png'],
            'classroom' => ['required', 'not_in:default'],
            'major' => ['required', 'not_in:default'],
            'nisn' => ['required', 'numeric', 'unique:users'],
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:6'],
            'phone' => ['nullable', 'min:8', 'numeric'],
            'gender' => ['required', 'in:Male,Female'],
            'address' => ['nullable', 'string'],
        ];
    }
}
