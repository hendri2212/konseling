<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class KomponenLayananRequest extends FormRequest
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
            'nama.required' => 'Komponen layanan wajib diisi',
            'nama.string' => 'Komponen layanan haru dalam bentuk string',
        ];
    }
}
