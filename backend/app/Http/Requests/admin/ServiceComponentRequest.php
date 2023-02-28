<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class ServiceComponentRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Komponen layanan wajib diisi',
            'name.string' => 'Komponen layanan haru dalam bentuk string',
        ];
    }
}
