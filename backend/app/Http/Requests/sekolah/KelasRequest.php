<?php

namespace App\Http\Requests\sekolah;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class KelasRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    
    public function rules()
    {
        return [
            'nama' => [
                'required',
                Rule::unique('kelas', 'nama')->where(function ($query) {
                    return $query->where('sekolah_id', auth()->id());
                }),
            ],
            'guru_id' => 'sometimes|required|exists:guru,id'
        ];
    }

    public function messages()
    {
        return [
            'nama.required' => 'Nama kelas wajib diisi',
            'nama.unique' => 'Nama kelas sudah digunakan',
            'guru_id.exists' => 'Guru tidak ditemukan'
        ];
    }
}
