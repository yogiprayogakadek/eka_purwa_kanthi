<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KegiatanRequest extends FormRequest
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
        $rules =  [
            'nama_kegiatan' => 'required',
            'tempat_kegiatan' => 'required',
            'tanggal_kegiatan' => 'required|date',
            'keterangan' => 'required',
        ];
        return $rules;
    }

    public function messages()
    {
        return [
            'required' => ':attribute tidak boleh kosong',
            'date' => ':attribute harus berupa tanggal',
        ];
    }

    public function attributes()
    {
        return [
            'nama_kegiatan' => 'nama',
            'tempat_kegiatan' => 'Tempat kegiatan',
            'tanggal_kegiatan' => 'Tanggal kegiatan',
            'keterangan' => 'Keterangan',
        ];
    }
}
