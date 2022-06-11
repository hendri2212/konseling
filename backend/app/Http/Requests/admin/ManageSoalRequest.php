<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class ManageSoalRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'soal' => 'required',
            'rumusan_kebutuhan' => 'required',
            'materi' => 'required',
            'tujuan_layanan' => 'required',
            'komponen_layanan' => 'required',
            'strategi_layanan' => 'required',
            'bidang_id' => 'required|exists:bidang,id',
            'kompetensi_id' => 'required|exists:kompetensi,id'
        ];
    }

    public function messages()
    {
        return [
            'soal.required' => 'Soal wajib diisi',
            'rumusan_kebutuhan.required' => 'Rumusan Kebutuhan wajib diisi',
            'materi.required' => 'Materi wajib diisi',
            'tujuan_layanan.required' => 'Tujuan Layanan wajib diisi',
            'komponen_layanan.required' => 'Komponen Layanan wajib diisi',
            'strategi_layanan.required' => 'Strategi Layanan wajib diisi',
            'bidang_id.required' => 'Bidang wajib diisi',
            'bidang_id.exists' => 'Bidang tidak ditemukan',
            'kompetensi_id.required' => 'Kompetensi wajib diisi',
            'kompetensi_id.exists' => 'Kompetensi tidak ditemukan',
        ];
    }
}
