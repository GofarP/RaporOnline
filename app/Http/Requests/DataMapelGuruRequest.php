<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DataMapelGuruRequest extends FormRequest
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
            'nip'=>'required|numeric|exists:guru,nip',
            'id_mapel'=>'required|exists:mata_pelajaran,id_mapel',
        ];
    }


    public function messages()
    {
        return[
            'nip.required'=>"Nip Guru Tidak Valid, Silahkan Pilih Ulang Guru",
            'nip.numeric'=>'Nip Guru Harus Berupa Angka',
            'nip.exists'=>'Nip Guru Tidak Ditemukan, Silahkan Pilih Ulang Guru',
            'id_mapel.required'=>'Id Mapel Tidak Valid, Silahkan refresh browser',
            'id_mapel.exists'=>'Id Mapel Tidak Ditemukan, Silahkan Refresh browser',
        ];
    }
}
