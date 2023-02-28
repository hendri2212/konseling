<?php

namespace App\Http\Requests\admin;

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
            'student_id' => 'required|array',
        ];
    }

    public function messages()
    {
        return [
            'student_id.required' => 'ID students wajib diisi',
            'student_id.array' => 'ID students harus dalam bentuk array',
        ];
    }
}
