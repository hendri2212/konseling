<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class PermissionRequest extends FormRequest
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

    protected function prepareForValidation()
    {
        $this->merge([
            'service_id' => $this->service_id,
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'service_id' => 'required|exists:services,id',
            'permission' => "required"
        ];
    }

    public function messages() {
        return [
            'service_id.required' => 'ID service wajib diisi',
            'service_id.exists' => 'Service tidak ditemukan',
            'permission.required' => 'Nama permission wajib diisi'
        ];
    }
}
