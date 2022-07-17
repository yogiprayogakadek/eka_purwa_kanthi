<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KandidatRequest extends FormRequest
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
            'nama' => 'required',
            'visi' => 'required',
        ];

        for($i = 0; $i < count($this->input('misi')); $i++) {
            $rules['misi.'.$i] = 'required';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'required' => ':attribute tidak boleh kosong',
        ];
    }

    public function attributes()
    {
        $attr = [
            'nama' => 'Nama kandiadat',
            'visi' => 'Visi',
        ];

        for($i = 0; $i < count($this->input('misi')); $i++) {
            $attr['misi.'.$i] = 'Misi ';
        }

        return $attr;
    }
}

