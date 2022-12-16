<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MateriRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nama' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'nama.required' => 'Materi wajib diisi',
            'nama.string' => 'Materi harus dalam bentuk string',
        ];
    }
}
