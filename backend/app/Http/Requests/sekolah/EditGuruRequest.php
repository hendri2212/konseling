<?php

namespace App\Http\Requests\sekolah;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditGuruRequest extends FormRequest
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
            'nip' => [
                'required',
                Rule::unique('guru', 'nip')->where(function ($query) {
                    return $query->where('sekolah_id', auth()->id())->where('nip', '!=', $this->nip);
                }),
            ],
            'password' => 'sometimes|required|min:8'
        ];
    }

    public function messages()
    {
        return [
            'nama.required' => 'Nama wajib diisi',
            'nip.required' => 'NIP wajib diisi',
            'nip.unique' => 'NIP ini sudah digunakan guru lain',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 8 karakter',
        ];
    }
}
