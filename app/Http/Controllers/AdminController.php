<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\DataGuruRequest;
use App\Http\Requests\DataSiswaRequest;
use App\Http\Requests\KredensialGuruRequest;
use App\Http\Requests\KredensialSiswaRequest;
use App\Models\Siswa;

class AdminController extends Controller
{

    //Data Guru
    public function indexDataGuru()
    {
        return view('admin.DataGuru.index');
    }

    public function createDataGuru()
    {
        return view('admin.DataGuru.tambah');
    }

    public function storeDataGuru(DataGuruRequest $request)
    {

        $data_guru=$request->all();

        $data_guru['foto']=$request->file('foto')->store('assets/guru','public');

        Guru::create($data_guru);

        return redirect()->route('index_data_guru')->with('success','Sukses Menambah Data Guru Baru');

    }

    public function editDataGuru()
    {
        return view('admin.guru.edit');
    }

    public function updateDataGuru()
    {
        //
    }

    public function destroyDataGuru()
    {
        //
    }


    //Kredensial Guru
    public function indexKredensialGuru()
    {
        $kredensial_data=User::where('role', '=', "Guru")->get();

        return view('admin.DataGuru.kredensial.index',['kredensial'=>$kredensial_data]);
    }

    public function createKredensialGuru()
    {
        return view('admin.DataGuru.kredensial.tambah');
    }

    public function storeKredensialGuru(KredensialGuruRequest $request)
    {
        $kredensial_guru=$request->all();

        $kredensial_guru['password']=Hash::make($request->password);
        $kredensial_guru['role']="Guru";

        User::create($kredensial_guru);

        return redirect()->route('index_kredensial_guru')->with('success','Sukses Menambah Kredensial Baru');

    }

    public function editKredensialGuru(User $user)
    {
        return view('admin.DataGuru.kredensial.edit',['user' => $user]);
    }

    public function updateKredensialGuru(Request $request, User $user)
    {

        $request->validate([
            'email' => 'required|email|unique:users,email,'. $user->id_users.',id_users',
            'password'=>'required|min:8|confirmed',
            'password_confirmation'=>'required|min:8'
        ],[
            'email.required'=>"Silahkan Masukkan Email Kredensial Guru",
            'email.email'=>'Format Email Tidak Valid',
            'email.unique'=>'Email Ini Sudah Digunakan',
            'password.required'=>'Silahkan Masukkan Password Guru',
            'password.min'=>"Panjang Password Minimal 8 Karakter",
            'password.confirmed'=>'Password Dan Konfirmasi Password Tidak Cocok',
            'password_confirmation.required'=>'Silahkan Masukkan Konfirmasi Password',
            'password_confirmation.min'=>'Panjang Konfirmasi Password Minimal 8'
        ]);


        $kredensial_guru=$request->except(['_token','_method','password_confirmation']);

        $kredensial_guru['password']=Hash::make($request->password);
        $kredensial_guru['role']="Guru";

        User::where('id_users',$user->id_users)->update($kredensial_guru);
        return redirect()->route('index_kredensial_guru')->with('success','Sukses Mengubah Kredensial Guru');;

    }

    public function destroyKredensialGuru(User $user)
    {
        User::where('id_users',$user->id_users)->delete();

        return redirect()->route('index_kredensial_guru')->with('success',"Sukses Menghapus Kredensial Guru");;
    }






    //Data Siswa
    public function indexDataSiswa()
    {
        $data_siswa=Siswa::all();
        return view('admin.DataSiswa.index',['data_siswa'=>$data_siswa]);
    }

    public function createDataSiswa()
    {
        return view('admin.DataSiswa.tambah');
    }

    public function storeDataSiswa(DataSiswaRequest $request)
    {
        $data_siswa=$request->all();

        $data_siswa['foto']=$request->file('foto')->store('assets/siswa','public');

        Siswa::create($data_siswa);

        return redirect()->route('index_data_siswa')->with('success','Sukses Menambah Data Siswa Baru');
    }

    public function editDataSiswa(Siswa $siswa)
    {
        return view('admin.DataSiswa.edit',['siswa' => $siswa]);
    }

    public function updateDataSiswa()
    {
        //
    }


    public function destroyDataSiswa(Siswa $siswa)
    {
        Siswa::where('nisn',$siswa->nisn)->delete();

        return redirect()->route('index_data_siswa')->with('success',"Sukses Menghapus Data Siswa");
    }




    //Kredensial Siswa
    public function indexKredensialSiswa()
    {
        $kredensial_data=User::where('role', '=', "Siswa")->get();
        return view('admin.DataSiswa.kredensial.index',['kredensial'=>$kredensial_data]);
    }

    public function createKredensialSiswa()
    {
        return view('admin.DataSiswa.kredensial.tambah');
    }

    public function storeKredensialSiswa(KredensialSiswaRequest $request)
    {
        $kredensial_siswa=$request->all();

        $kredensial_siswa['password']=Hash::make($request->password);
        $kredensial_siswa['role']="Siswa";

        User::create($kredensial_siswa);

        return redirect()->route('index_kredensial_guru')->with('success','Sukses Menambah Kredensial Baru');


    }

    public function editKredensialSiswa(User $user)
    {
        return view('admin.DataSiswa.kredensial.edit',['user'=>$user]);
    }

    public function updateKredensialSiswa(Request $request, User $user)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email,'. $user->id_users.',id_users',
            'password'=>'required|min:8|confirmed',
            'password_confirmation'=>'required|min:8'
        ],[
            'email.required'=>"Silahkan Masukkan Email Kredensial Guru",
            'email.email'=>'Format Email Tidak Valid',
            'email.unique'=>'Email Ini Sudah Digunakan',
            'password.required'=>'Silahkan Masukkan Password Guru',
            'password.min'=>"Panjang Password Minimal 8 Karakter",
            'password.confirmed'=>'Password Dan Konfirmasi Password Tidak Cocok',
            'password_confirmation.required'=>'Silahkan Masukkan Konfirmasi Password',
            'password_confirmation.min'=>'Panjang Konfirmasi Password Minimal 8'
        ]);


        $kredensial_siswa=$request->except(['_token','_method','password_confirmation']);

        $kredensial_siswa['password']=Hash::make($request->password);
        $kredensial_siswa['role']="Siswa";

        User::where('id_users',$user->id_users)->update($kredensial_siswa);
        return redirect()->route('index_kredensial_siswa')->with('success','Sukses Mengubah Kredensial Siswa');

    }

    public function destroyKredensialSiswa(User $user)
    {
        User::where('id_users',$user->id_users)->delete();

        return redirect()->route('index_kredensial_siswa')->with('success',"Sukses Menghapus kredensial Siswa");
    }





    //MAta Pelajaran
    public function indexDataMataPelajaran()
    {
        return view('admin.DataMapel.index');
    }

    public function createDataMataPelajaran()
    {
        return view('admin.DataMapel.tambah');
    }

    public function storeDataMataPelajaran()
    {

    }


    public function editDataMataPelajaran()
    {

    }


    public function updateDataMataPelajaran()
    {

    }


    public function destroyDataMataPelajaran()
    {

    }





    //Tahun Ajaran
    public function indexDataTahunAjaran()
    {

    }

    public function createDataTahunAjaran()
    {

    }

    public function storeDataTahunAjaran()
    {

    }


    public function editDataTahunAjaran()
    {

    }


    public function updateDataTahunAjaran()
    {

    }


    public function destroyDataTahunAjaran()
    {

    }



}
