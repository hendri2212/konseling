<?php

namespace App\Http\Requests\sekolah;

use Illuminate\Foundation\Http\FormRequest;

class KelasRequest extends FormRequest
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
            'nama' => 'required',
            'guru_id' => 'required|exists:guru,id'
        ];
    }

    public function messages()
    {
        return [
            'nama.required' => 'Nama kelas wajib diisi',
            'guru_id.required' => 'ID guru wajib diisi',
            'guru_id.exists' => 'Guru tidak ditemukan'
        ];
    }
}
