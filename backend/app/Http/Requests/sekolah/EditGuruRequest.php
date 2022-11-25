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
            'username' => [
                'required',
                Rule::unique('guru', 'username')->where(function ($query) {
                    return $query->where('username', '!=', $this->username);
                }),
            ],
            'password' => 'sometimes|required|min:8'
        ];
    }

    public function messages()
    {
        return [
            'nama.required' => 'Nama wajib diisi',
            'username.required' => 'Username wajib diisi',
            'username.unique' => 'Username ini sudah digunakan guru lain',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 8 karakter',
        ];
    }
}
