<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SiswaRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }
    
    public function rules()
    {
        return [
            'email' => [
                'required',
                Rule::unique('students')->where(function ($query) {
                    return $query->where('school_id', auth()->id());
                }),
            ],
            'password' => 'required|min:8',
            'name' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Email wajib diisi',
            'email.unique' => 'Email ini sudah digunakan students lain',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 8 karakter',
            'name.required' => 'Nama wajib diisi',
        ];
    }
}
