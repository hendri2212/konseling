<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ButirAngketKonselingRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'soal' => 'required|string',
            'rumusan_kebutuhan_id' => 'sometimes|required|exists:rumusan_kebutuhan,id',
        ];
    }

    public function messages()
    {
        return [
            'soal.required' => 'Soal wajib diisi',
            'soal.string' => 'Soal harus dalam bentuk string',
            'rumusan_kebutuhan.required' => 'Rumusan kebutuhan wajib dipilih',
            'rumusan_kebutuhan.exists' => 'Rumusan kebutuhan tidak ditemukan',
        ];
    }
}
