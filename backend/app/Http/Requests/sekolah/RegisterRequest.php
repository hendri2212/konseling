<?php

namespace App\Http\Requests\sekolah;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'nama' => 'required',
            'email' => 'email|required|unique:sekolah',
            'password' => 'required|min:8|confirmed'
        ];
        // 'email|required|unique:users',
        //     'password' => 'required|confirmed'
    }

    public function messages()
    {
        return [
            'nama.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 8 character',
            'password.confirmed' => 'Konfirmasi Password tidak sesuai'
        ];
    }
}
