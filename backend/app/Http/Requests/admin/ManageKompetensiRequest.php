<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class ManageKompetensiRequest extends FormRequest
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
            'skkpd' => 'required',
            'pengenalan' => 'required',
            'akomodasi' => 'required',
            'tindakan' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'skkpd.required' => 'SKKPD wajib diisi',
            'pengenalan.required' => 'Pengenalan wajib diisi',
            'akomodasi.required' => 'Akomodasi wajib diisi',
            'tindakan.required' => 'Tindakan wajib diisi',
        ];
    }
}
