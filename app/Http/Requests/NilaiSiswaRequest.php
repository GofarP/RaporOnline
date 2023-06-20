<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NilaiSiswaRequest extends FormRequest
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
            'nip'=>'numeric|exists:guru,nip',
            'nisn'=>'numeric|exists:siswa,nisn',
            'id_mapel'=>'exists:mata_pelajaran,id_mapel',
            'id_kelas'=>'exists:kelas,id_kelas',
            'id_tahun_ajaran'=>'exists:tahun_ajaran, id_tahun_ajaran',
            'nilai'=>'required|numeric'
        ];
    }

    public function messages()
    {
        return[
            'nip.numeric'=>'NIP harus berupa angka',
            'nip.exists'=>'Ada Kesalahan Pada NIP Guru, Silahkan Muat Ulang',
            'nisn.numeric'=>'NISN harus berupa angka',
            'nisn.exists'=>'Ada Kesalahan Pada NISN Siswa, Silahkan Muat Ulang',
            'id_kelas.exists'=>'Ada Kesalahan Pada ID Kelas Siswa, Silahkan Muat Ulang',
            'id_mapel.exists'=>'Ada Kesalahan Pada ID Mata Pelajaran, Silahkan Muat Ulang',
            'id_tahun_ajaran.exists'=>'Ada Kesalahan Pada Id Tahun Ajaran, Silahkan Muat Ulang',
            'nilai.required'=>'Silahkan Masukkan Nilai Siswa',
            'nilai.numeric'=>'Nilai Hanya Dapat Berupa Angka'
        ];
    }
}
