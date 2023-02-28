<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditClassRequest extends FormRequest
{

    public function authorize()
    {
        return [
            'name' => [
                'required',
                Rule::unique('class', 'name')->where(function ($query) {
                    return $query->where('school_id', auth()->id())->where('name', '!=', $this->name);
                }),
            ],
            'teacher_id' => 'sometimes|required|exists:teachers,id'
        ];
    }

    public function rules()
    {
        return [
            'name.required' => 'Nama kelas wajib diisi',
            'name.unique' => 'Nama kelas sudah digunakan',
            'teacher_id.exists' => 'Guru tidak ditemukan'
        ];
    }
}
