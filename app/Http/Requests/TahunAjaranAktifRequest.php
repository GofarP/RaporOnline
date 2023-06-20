<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TahunAjaranAktifRequest extends FormRequest
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
            'id_tahun_ajaran'=>'required|exists:tahun_ajaran,id_tahun_ajaran'
        ];
    }

    public function messages()
    {
        return[
            'id_tahun_ajaran.required'=>'Silahkan Pilih Tahun Ajaran',
            'id_tahun_ajaran.exists'=>'Tahun Ajaran Tidak Valid'
        ];
    }
}
