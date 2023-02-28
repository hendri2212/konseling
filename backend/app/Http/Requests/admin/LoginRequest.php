<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required',
            'password' => 'required',
            'type' => 'required|in:teachers,schools,admin'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Email wajib diisi',
            'password.required' => 'Password wajib diisi',
            'type.required' => 'Jenis login wajib diisi',
            'type.in' => 'Jenis login tidak tidak diketahui'
        ];
    }
}
