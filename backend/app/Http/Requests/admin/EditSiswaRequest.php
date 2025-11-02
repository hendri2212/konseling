<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditSiswaRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation()
    {
        // Treat empty password as null so it won't be validated or updated
        if ($this->has('password') && trim((string)$this->password) === '') {
            $this->merge(['password' => null]);
        }
    }

    public function rules()
    {
        return [
            'email' => [
                'required',
                Rule::unique('students')->where(function ($query) {
                    return $query->where('school_id', auth()->id())->where('email', '!=', $this->email);
                }),
            ],
            // Only validate password if present; allow null (no change)
            'password' => 'sometimes|nullable|string|min:8',
            'name' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Email wajib diisi',
            'email.unique' => 'Email ini sudah digunakan siswa lain',
            'password.min' => 'Password minimal 8 karakter',
            'name.required' => 'Nama wajib diisi',
        ];
    }
}
