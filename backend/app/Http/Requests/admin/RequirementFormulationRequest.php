<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class RequirementFormulationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string',
            'service_objective' => 'required|string',
            'topic_id' => 'sometimes|required|exists:topics,id',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Rumusan kebutuhan wajib diisi',
            'name.string' => 'Rumusan kebutuhan harus dalam bentuk string',
            'service_objective.required' => 'Tujuan layanan wajib diisi',
            'service_objective.string' => 'Tujuan layanan harus dalam bentuk string',
            'topic_id.required' => 'Topic wajib dipilih',
            'topic_id.exists' => 'Topic tidak ditemukan',
        ];
    }
}
