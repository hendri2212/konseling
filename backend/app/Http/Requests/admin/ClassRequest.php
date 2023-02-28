<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClassRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    
    public function rules()
    {
        return [
            'name' => [
                'required',
                Rule::unique('classes', 'name')->where(function ($query) {
                    return $query->where('school_id', auth()->id());
                }),
            ],
            'teacher_id' => 'sometimes|required|exists:teachers,id'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama kelas wajib diisi',
            'name.unique' => 'Nama kelas sudah digunakan',
            'teacher_id.exists' => 'Guru tidak ditemukan'
        ];
    }
}
