<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'service' => 'required|unique:services'
        ];
    }

    public function messages() {
        return [
            'service.required' => 'Nama service wajib diisi',
            'service.unique' => 'Nama service sudah digunakan, coba nama lain'
        ];
    }
}