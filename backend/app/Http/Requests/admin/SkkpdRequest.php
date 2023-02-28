<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class SkkpdRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string',
            'introduction' => 'required|string',
            'accommodation' => 'required|string',
            'action' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Skkpd wajib diisi',
            'name.string' => 'Skkpd harus dalam bentuk string',
            'introduction.required' => 'introduction wajib diisi',
            'introduction.string' => 'introduction harus dalam bentuk string',
            'accommodation.required' => 'accommodation wajib diisi',
            'accommodation.string' => 'accommodation harus dalam bentuk string',
            'action.required' => 'action wajib diisi',
            'action.string' => 'action harus dalam bentuk string',
        ];
    }
}
