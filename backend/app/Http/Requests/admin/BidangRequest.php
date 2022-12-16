<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class BidangRequest extends FormRequest
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
            'nama.required' => 'Nama bidang wajib diisi',
            'nama.string' => 'Nama bidang harus dalam bentuk string',
        ];
    }
}
