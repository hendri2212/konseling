<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class SurveyItemRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'question' => 'required|string',
            'requirement_formulation_id' => 'sometimes|required|exists:requirements_formulation,id',
        ];
    }

    public function messages()
    {
        return [
            'question.required' => 'Soal wajib diisi',
            'question.string' => 'Soal harus dalam bentuk string',
            'requirement_formulation.required' => 'Rumusan kebutuhan wajib dipilih',
            'requirement_formulation.exists' => 'Rumusan kebutuhan tidak ditemukan',
        ];
    }
}
