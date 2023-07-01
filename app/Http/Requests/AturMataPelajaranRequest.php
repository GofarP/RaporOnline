<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AturMataPelajaranRequest extends FormRequest
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
            'id_mata_pelajaran'=>'required|exists:mata_pelajaran,id_mapel',
            'id_kelas'=>'required|exists:kelas,id_kelas',
            'id_tahun_ajaran'=>'required|exists:tahun_ajaran,id_tahun_ajaran'
        ];
    }

    public function messages()
    {
        return [
            'id_mata_pelajaran.required'=>"ID Mata Pelajaran Dibutuhkan, Silahkan refresh browser",
            'id_mata_pelajaran.exists'=>"Id Mata pelajaran tidak valid, Silahkan refresh browser",
            'id_kelas.required'=>"ID Kelas Dibutuhkan, Silahkan refresh browser",
            'id_kelas.exists'=>"Id Kelas tidak valid, Silahkan refresh browser",
            'id_tahun_ajaran.required'=>"ID Tahun Ajaran Dibutuhkan, Silahkan refresh browser",
            'id_tahun_ajaran.exists'=>"Id Tahun Ajaran tidak valid, Silahkan refresh browser",
        ];
    }
}
