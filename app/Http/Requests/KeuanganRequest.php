<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KeuanganRequest extends FormRequest
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
            'jenis' => 'required',
            'tanggal' => 'required|date',
            'jumlah' => 'required',
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
            'jenis' => 'Jenis',
            'tanggal' => 'Tanggal',
            'jumlah' => 'Jumlah',
            'keterangan' => 'Keterangan',
        ];
    }
}
