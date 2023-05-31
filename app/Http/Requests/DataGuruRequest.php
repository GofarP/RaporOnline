<?php

namespace App\Http\Requests;

use App\Enums\Agama;
use App\Enums\JenisKelamin;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class DataGuruRequest extends FormRequest
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
            "nip"=>"required|numeric|unique:guru",
            "nama"=>"required|max:255",
            "agama"=>['required',new Enum(Agama::class)],
            "tempat_lahir"=>"required|string|max:255",
            'tanggal_lahir'=>'required|date_format:"d-m-Y"',
            'jenis_kelamin'=>['required',new Enum(JenisKelamin::class)],
            'alamat'=>'required|string|max:255',
            'foto'=>'required|image|file|mimes:jpeg,jpg|max:500',
            'pendidikan_terakhir'=>'required|string|max:255'
        ];
    }


    public function messages()
    {
        return[
            'nip.required'=>"Silahkan Isi NIP Guru",
            'nip.unique'=>"Pengguna Dengan NIP Ini Sudah Ditambahkan",
            'nip.numeric'=>"NIP Harus Menggunakan Angka",
            'nama.required'=>"Silahkan Isi Nama Guru",
            'agama.required'=>"Silahkan Isi Agama Guru",
            'agama.Illuminate\Validation\Rules\Enum'=>"Pilihan Agama Tidak Valid",
            'tempat_lahir.required'=>"Silahkan Isi Tempat Lahir Guru",
            'tanggal_lahir.required'=>"Silahkan Isi Tanggal Lahir Guru",
            'tanggal_lahir.date_format'=>"Format Tanggal Lahir Tidak Valid",
            'jenis_kelamin.required'=>"Silahkan Isi Jenis Kelamin Guru",
            'jenis_kelamin.Illuminate\Validation\Rules\Enum'=>"Pilihan Jenis Kelamin Tidak Valid",
            'alamat.required'=>'Silahkan Isi Alamat Guru',
            'foto.required'=>"Silahkan Pilih Foto Guru",
            'foto.image'=>'File Yang Diupload Harus Merupakan Gambar/Foto',
            'foto.uploaded'=>'Ukuran Gambar Yang Diupload Maksimal 500KB',
            'pendidikan_terakhir.required'=>'Silahkan Isi Pendidikan Terakhir'
        ];
    }
}
