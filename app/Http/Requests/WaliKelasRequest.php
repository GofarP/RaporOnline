<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WaliKelasRequest extends FormRequest
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
            'nip'=>'required|exists:guru,nip',
            'id_tahun_ajaran' => 'required',
            'id_kelas' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nip.required'=>"NIP tidak valid, Silahkan refresh halaman",
            'nip.exists'=>'Nip Tidak valid, Silahkan refresh halaman',
            'id_tahun_ajaran.required' => 'Silahkan Pilih Tahun Ajaran.',
            'id_kelas.required' => 'Silahkan Pilih Kelas.',
        ];
    }
}
