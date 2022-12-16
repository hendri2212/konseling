<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RumusanKebutuhanRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nama' => 'required|string',
            'tujuan_layanan' => 'required|string',
            'materi_id' => 'sometimes|required|exists:materi,id',
        ];
    }

    public function messages()
    {
        return [
            'nama.required' => 'Rumusan kebutuhan wajib diisi',
            'nama.string' => 'Rumusan kebutuhan harus dalam bentuk string',
            'tujuan_layanan.required' => 'Tujuan layanan wajib diisi',
            'tujuan_layanan.string' => 'Tujuan layanan harus dalam bentuk string',
            'materi_id.required' => 'Materi wajib dipilih',
            'materi_id.exists' => 'Materi tidak ditemukan',
        ];
    }
}
