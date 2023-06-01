<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TahunAjaranRequest extends FormRequest
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
            'tahun_awal'=>'required|numeric',
            'tahun_akhir'=>'required|numeric'
        ];
    }


    public function messages()
    {
        return[
            'tahun_awal.required'=>'Silahkan Masukkan Tahun Awal Ajaran',
            'tahun_awal.numeric'=>'Tahun Awal Ajaran Harus Berupa Angka',
            'tahun_akhir.required'=>'Silahkan Masukkan Tahun Akhir Ajaran',
            'tahun_akhir.numeric'=>'Tahun Akhir Ajaran Harus Berupa Angka',
        ];
    }
}
