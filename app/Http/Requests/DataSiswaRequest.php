<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\Agama;
use App\Enums\JenisKelamin;
use Illuminate\Validation\Rules\Enum;


class DataSiswaRequest extends FormRequest
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
            "nisn"=>"required|numeric|unique:siswa",
            "nama"=>"required|max:255",
            "agama"=>['required',new Enum(Agama::class)],
            "tempat_lahir"=>"required|string|max:255",
            'tanggal_lahir'=>'required|date_format:"d-m-Y"',
            'jenis_kelamin'=>['required',new Enum(JenisKelamin::class)],
            'alamat'=>'required|string|max:255',
            'foto'=>'required|image|file|mimes:jpeg,jpg|max:500',
        ];
    }

    public function messages()
    {
        return[
            'nisn.required'=>"Silahkan Isi NISN",
            'nisn.unique'=>"Pengguna Dengan NISN Ini Sudah Ditambahkan",
            'nip.numeric'=>"NISN Harus Menggunakan Angka",
            'nama.required'=>"Silahkan Isi Nama Siswa",
            'agama.required'=>"Silahkan Isi Agama Siswa",
            'agama.Illuminate\Validation\Rules\Enum'=>"Pilihan Agama Tidak Valid",
            'tempat_lahir.required'=>"Silahkan Isi Tempat Lahir Siswa",
            'tanggal_lahir.required'=>"Silahkan Isi Tanggal Lahir Siswa",
            'tanggal_lahir.date_format'=>"Format Tanggal Lahir Tidak Valid",
            'jenis_kelamin.required'=>"Silahkan Isi Jenis Kelamin Siswa",
            'jenis_kelamin.Illuminate\Validation\Rules\Enum'=>"Pilihan Jenis Kelamin Tidak Valid",
            'alamat.required'=>'Silahkan Isi Alamat Siswa',
            'foto.required'=>"Silahkan Pilih Foto Siswa",
            'foto.image'=>'File Yang Diupload Harus Merupakan Gambar/Foto',
            'foto.uploaded'=>'Ukuran Gambar Yang Diupload Maksimal 500KB',
        ];
    }
}
