<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PenempatanSiswaRequest extends FormRequest
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
            'nisn'=>'required|numeric|exists:siswa,nisn',
            'id_kelas'=>'required|exists:kelas,id_kelas',
            'id_tahun_ajaran'=>'required|exists:tahun_ajaran,id_tahun_ajaran',
        ];
    }


    public function messages()
    {
        return[
            'nisn.required'=>"Nisn Siswa Tidak Valid, Silahkan Pilih Ulang Siswa",
            'nisn.numeric'=>'Nisn Harus Berupa Angka',
            'nisn.exists'=>'Nisn Siswa Tidak Ditemukan, Silahkan Pilih Ulang Siswa',
            'id_kelas.required'=>'Id Kelas Tidak Valid, Silahkan refresh browser',
            'id_kelas.exists'=>'Nisn Siswa Tidak Ditemukan, Silahkan Refresh browser',
            'id_tahun_ajaran.required'=>'Id Tahun Ajaran Tidak Valid, Silahkan refresh browser',
            'id_tahun_ajaran.exists'=>'Id Tahun Ajaran Tidak Ditemukan, Silahkan Refresh Browser',
        ];
    }
}
