<?php

namespace App\Http\Requests\admin;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
            'role' => [
                'required',
                Rule::unique('roles')->ignore($this->role, 'role'),
            ],
            'description' => 'required',
            'permission' => 'array',
            'permission.*' => 'exists:permissions,id'
        ];
    }

    public function messages()
    {
        return [
            'role.required' => 'Nama role wajib diisi',
            'role.unique' => 'Nama role sudah digunakan',
            'description.required' => 'Deskripsi wajib diisi',
            'permission.array' => 'Permission harus berupa array',
            'permission.*.unique' => 'Permission tidak ditemukan'
        ];
    }
}
