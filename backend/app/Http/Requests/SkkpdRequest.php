<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SkkpdRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nama' => 'required|string',
            'pengenalan' => 'required|string',
            'akomodasi' => 'required|string',
            'tindakan' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'nama.required' => 'Skkpd wajib diisi',
            'nama.string' => 'Skkpd harus dalam bentuk string',
            'pengenalan.required' => 'Pengenalan wajib diisi',
            'pengenalan.string' => 'Pengenalan harus dalam bentuk string',
            'akomodasi.required' => 'Akomodasi wajib diisi',
            'akomodasi.string' => 'Akomodasi harus dalam bentuk string',
            'tindakan.required' => 'Tindakan wajib diisi',
            'tindakan.string' => 'Tindakan harus dalam bentuk string',
        ];
    }
}
