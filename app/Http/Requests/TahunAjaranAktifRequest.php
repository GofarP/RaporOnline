<?php

namespace App\Http\Requests;

use App\Enums\Semester;
use Illuminate\Validation\Rules\Enum;
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
            'id_tahun_ajaran'=>'required|exists:tahun_ajaran,id_tahun_ajaran',
            "semester"=>['required',new Enum(Semester::class)],

        ];
    }

    public function messages()
    {
        return[
            'id_tahun_ajaran.required'=>'Silahkan Pilih Tahun Ajaran',
            'id_tahun_ajaran.exists'=>'Tahun Ajaran Tidak Valid',
            'semester.required'=>'Silahkan Pilih Semester',
            'semester.Illuminate\Validation\Rules\Enum'=>"Pilihan Semester Tidak Valid",
        ];
    }
}
