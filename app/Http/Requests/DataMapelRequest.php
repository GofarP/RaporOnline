<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DataMapelRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nama'=>'required|string|unique:mata_pelajaran',
        ];
    }

    public function messages()
    {
        return[
            'nama.required'=>'Silahkan Masukkan Nama Mata Pelajaran',
            'nama.string'=>'Nama Pelajaran Tidak Boleh Menggunakan Angka',
            'nama.unique'=>'Pelajaran Ini Telah Didaftarkan Sebelumnya'
        ];
    }
}
