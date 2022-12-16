<?php

namespace App\Http\Requests\sekolah;

use Illuminate\Foundation\Http\FormRequest;

class AssignSiswaRequest extends FormRequest
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

    public function rules()
    {
        return [
            'siswa_id' => 'required|array',
        ];
    }

    public function messages()
    {
        return [
            'siswa_id.required' => 'ID siswa wajib diisi',
            'siswa_id.array' => 'ID siswa harus dalam bentuk array',
        ];
    }
}
