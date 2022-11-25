<?php

namespace App\Http\Requests\sekolah;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditSiswaRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'username' => [
                'required',
                Rule::unique('siswa')->where(function ($query) {
                    return $query->where('sekolah_id', auth()->id())->where('username', '!=', $this->username);
                }),
            ],
            'password' => 'required|min:8',
            'nama' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'Username wajib diisi',
            'username.unique' => 'Username ini sudah digunakan siswa lain',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 8 karakter',
            'nama.required' => 'Nama wajib diisi',
        ];
    }
}
