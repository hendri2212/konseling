<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'username' => 'required',
            'password' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'Email wajib diisi',
            'password.required' => 'Password wajib diisi',
        ];
    }
}
