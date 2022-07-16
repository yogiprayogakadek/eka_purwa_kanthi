<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RapatRequest extends FormRequest
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
            'perihal_rapat' => 'required',
            'tanggal_rapat' => 'required|date',
            'tempat_rapat' => 'required',
            'pimpinan_rapat' => 'required',
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
            'perihal_rapat' => 'Perihal rapat',
            'tanggal_rapat' => 'Tanggal rapat',
            'tempat_rapat' => 'Tempat rapat',
            'pimpinan_rapat' => 'Pimpinan rapat',
        ];
    }
}
