<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KredensialGuruRequest extends FormRequest
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
            'name'=>'required',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:8|confirmed',
            'password_confirmation'=>'required|min:8'
        ];
    }



    public function messages()
    {
        return[
            'name.required'=>'Silahkan Masukkan Nama Guru',
            'email.required'=>'Silahkan Masukkan Email Guru',
            'email.email'=>'Silahkan Masukkan Format Email Yang Valid',
            'email.unique'=>"Email Ini Sudah Digunakan",
            'password.required'=>'Silahkan Masukkan Password Guru',
            'password.min'=>"Panjang Password Minimal 8 Karakter",
            'password.confirmed'=>'Password Dan Konfirmasi Password Tidak Cocok',
            'password_confirmation.required'=>'Silahkan Masukkan Konfirmasi Password',
            'password_confirmation.min'=>'Panjang Konfirmasi Password Minimal 8'
        ];
    }
}
