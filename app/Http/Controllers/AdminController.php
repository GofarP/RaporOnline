<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Enums\Agama;
use App\Enums\JenisKelamin;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use App\Models\MataPelajaran;
use App\Models\PenempatanSiswa;
use Illuminate\Validation\Rule;
use Illuminate\Routing\Controller;
use App\Http\Requests\KelasRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Enum;
use App\Http\Requests\DataGuruRequest;
use App\Http\Requests\DataMapelGuruRequest;
use App\Http\Requests\DataMapelRequest;
use App\Http\Requests\DataSiswaRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\TahunAjaranRequest;
use App\Http\Requests\KredensialGuruRequest;
use App\Http\Requests\KredensialSiswaRequest;
use App\Http\Requests\PenempatanSiswaRequest;
use App\Models\DataMapelGuru;

class AdminController extends Controller
{

    //Data Guru
    public function indexDataGuru()
    {
        $data_guru=Guru::all();
        return view('admin.DataGuru.index',['data_guru'=>$data_guru]);
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

    public function editDataGuru(Guru $guru)
    {
        return view('admin.DataGuru.edit',['data_guru'=>$guru]);
    }

    public function updateDataGuru(Request $request, Guru $guru)
    {

        $request->validate([
            "nip"=>['required','numeric',Rule::unique('guru', 'nip')->ignore($guru->nip,'nip')],
            "nama"=>"required|max:255",
            "agama"=>['required',new Enum(Agama::class)],
            "tempat_lahir"=>"required|string|max:255",
            'tanggal_lahir'=>'required|date_format:"d-m-Y"',
            "jenis_kelamin"=>['required',new Enum(JenisKelamin::class)],
            'alamat'=>'required|string|max:255',
            'foto'=>'image|file|mimes:jpeg,jpg|max:500',
            'pendidikan_terakhir'=>'required|string|max:255'
        ],[
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
            'jenis_kelamin.Illuminate\Validation\Rules\Enum'=>"Pilihan Agama Tidak Valid",
            'alamat.required'=>'Silahkan Isi Alamat Guru',
            'foto.image'=>'File Yang Diupload Harus Merupakan Gambar/Foto',
            'foto.uploaded'=>'Ukuran Gambar Yang Diupload Maksimal 500KB',
            'pendidikan_terakhir.required'=>'Silahkan Isi Pendidikan Terakhir'
        ]);

        $data_guru=$request->except(['_token','_method']);

        if($request->file('foto'))
        {
            Storage::disk('public')->delete($guru->foto);
            $data_guru['foto']=$request->file('foto')->store('assets/guru','public');
        }

        Guru::where('nip','=',$guru->nip)->update($data_guru);

        return redirect()->route('index_data_guru')->with('success','Sukses Mengubah Data Guru');;

    }

    public function destroyDataGuru(Guru $guru)
    {
        Storage::disk('public')->delete($guru->foto);

        Guru::where('nip',$guru->nip)->delete();

        return redirect()->route('index_data_guru')->with('success',"Sukses Menghapus Data Guru");;
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

    public function updateDataSiswa(Request $request, Siswa $siswa)
    {
        $request->validate([
            "nisn"=>['required','numeric',Rule::unique('siswa', 'nisn')->ignore($siswa->nisn,'nisn')],
            "nama"=>"required|max:255",
            "agama"=>['required',new Enum(Agama::class)],
            "tempat_lahir"=>"required|string|max:255",
            'tanggal_lahir'=>'required|date_format:"d-m-Y"',
            'jenis_kelamin'=>['required',new Enum(JenisKelamin::class)],
            'alamat'=>'required|string|max:255',
            'foto'=>'image|file|mimes:jpeg,jpg|max:500',
        ],[
            'nisn.required'=>"Silahkan Isi NISN Siswa",
            'nisn.unique'=>"Pengguna Dengan NISN Ini Sudah Ditambahkan",
            'nisn.numeric'=>"NISN Harus Menggunakan Angka",
            'nama.required'=>"Silahkan Isi Nama Siswa",
            'agama.required'=>"Silahkan Isi Agama Siswa",
            'agama.Illuminate\Validation\Rules\Enum'=>"Pilihan Agama Tidak Valid",
            'tempat_lahir.required'=>"Silahkan Isi Tempat Lahir Siswa",
            'tanggal_lahir.required'=>"Silahkan Isi Tanggal Lahir Siswa",
            'tanggal_lahir.date_format'=>"Format Tanggal Lahir Tidak Valid",
            'jenis_kelamin.required'=>"Silahkan Isi Jenis Kelamin Siswa",
            'jenis_kelamin.Illuminate\Validation\Rules\Enum'=>"Pilihan Jenis Kelamin Tidak Valid",
            'alamat.required'=>'Silahkan Isi Alamat Siswa',
            'foto.image'=>'File Yang Diupload Harus Merupakan Gambar/Foto',
            'foto.uploaded'=>'Ukuran Gambar Yang Diupload Maksimal 500KB',
        ]);

        $data_siswa=$request->except(['_token','_method']);

        if($request->file('foto'))
        {
            Storage::disk('public')->delete($siswa->foto);
            $data_siswa['foto']=$request->file('foto')->store('assets/siswa','public');
        }

        Siswa::where('nisn','=',$siswa->nisn)->update($data_siswa);

        return redirect()->route('index_data_siswa')->with('success','Sukses Mengubah Data Siswa');;

    }


    public function destroyDataSiswa(Siswa $siswa)
    {
        Siswa::where('nisn','=',$siswa->nisn)->delete();

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
        $data_mapel=MataPelajaran::all();
        return view('admin.DataMapel.index',['data_mapel'=>$data_mapel]);
    }
    public function createDataMataPelajaran()
    {
        return view('admin.DataMapel.tambah');
    }

    public function storeDataMataPelajaran(DataMapelRequest $request)
    {
        $data_mapel=$request->all();

        MataPelajaran::create($data_mapel);

        return redirect()->route('index_data_mata_pelajaran')->with('success',"Sukses Menambah Data Mata Pelajaran Baru");

    }


    public function editDataMataPelajaran(MataPelajaran $matapelajaran)
    {
        return view('admin.DataMapel.edit',['mataPelajaran'=>$matapelajaran]);
    }


    public function updateDataMataPelajaran(Request $request,MataPelajaran $matapelajaran)
    {
        $request->validate([
            'nama' => 'required|string|unique:mata_pelajaran,nama,'. $matapelajaran->id_mapel.',id_mapel',

        ],[
            'nama.required'=>"Silahkan Masukkan Nama Mata Pelajaran",
            'nama.string'=>'Nama Pelajaran Tidak Boleh Menggunakan Angka',
            'nama.unique'=>'Pelajaran Ini Telah Didaftarkan Sebelumnya'
        ]);

        $data_mapel=$request->except(['_token','_method']);

        MataPelajaran::where('id_mapel','=',$matapelajaran->id_mapel)
        ->update($data_mapel);

        return redirect()->route('index_data_mata_pelajaran')->with('success',"Sukses Mengubah Data Mata Pelajaran Baru");

    }


    public function destroyDataMataPelajaran(MataPelajaran $matapelajaran)
    {
        MataPelajaran::where('id_mapel','=',$matapelajaran->id_mapel)
        ->delete();

        return redirect()->route('index_data_mata_pelajaran')->with('success',"Sukses Menghapus Mata Pelajaran");
    }


    //Tahun Ajaran
    public function indexDataTahunAjaran()
    {
        $data_tahun_ajaran=TahunAjaran::all();

        return view('admin.DataTahunAjaran.index',['tahun_ajaran'=>$data_tahun_ajaran]);
    }

    public function createDataTahunAjaran()
    {
        return view('admin.DataTahunAjaran.tambah');
    }

    public function storeDataTahunAjaran(TahunAjaranRequest $request)
    {
        $data_tahun_ajaran=$request->all();

        if($data_tahun_ajaran["tahun_awal"]>$data_tahun_ajaran["tahun_akhir"])
        {
            return back()->with('rentang_tahun_error',"Tahun Awal Harus Lebih Kecil Daripada Tahun Akhir");
        }


        $data['tahun_ajaran']=$data_tahun_ajaran["tahun_awal"]."-".$data_tahun_ajaran["tahun_akhir"];
        $cek_tahun_ajaran=TahunAjaran::where('tahun_ajaran','=',$data['tahun_ajaran'])->first();

        if($cek_tahun_ajaran)
        {
            return redirect()->back()->with('error','Tahun Ajaran Ini Sudah Ditambahkan Sebelumnya');
        }

        TahunAjaran::create($data);

        return redirect()->route('index_data_tahun_ajaran')->with('success','Sukses Menambahkan Tahun Ajaran');

    }


    public function editDataTahunAjaran(TahunAjaran $tahunajaran)
    {
        return view('admin.DataTahunAjaran.edit',['tahun_ajaran'=>$tahunajaran]);
    }


    public function updateDataTahunAjaran(Request $request, TahunAjaran $tahunajaran)
    {

        $data_tahun_ajaran=$request->except(['_method','_token']);

        $request->validate([
            'tahun_awal'=>'required|numeric',
            'tahun_akhir'=>'required|numeric'
        ],[
            'tahun_awal.required'=>'Silahkan Masukkan Tahun Awal Ajaran',
            'tahun_awal.numeric'=>'Tahun Awal Ajaran Harus Berupa Angka',
            'tahun_akhir.required'=>'Silahkan Masukkan Tahun Akhir Ajaran',
            'tahun_akhir.numeric'=>'Tahun Akhir Ajaran Harus Berupa Angka',
        ]);


        $data['tahun_ajaran']=$data_tahun_ajaran["tahun_awal"]."-".$data_tahun_ajaran["tahun_akhir"];

        $cek_tahun_ajaran=TahunAjaran::where('tahun_ajaran','=',$data['tahun_ajaran'])->first();

        if($cek_tahun_ajaran)
        {
            return redirect()->back()->with('error','Tahun Ajaran Ini Sudah Ditambahkan Sebelumnya');
        }

        if($data_tahun_ajaran['tahun_awal']>$data_tahun_ajaran['tahun_akhir'])
        {
            return redirect()->back()->with('error','Tahun Awal Tidak Boleh Lebih Besar Dari Tahun Akhir');
        }


        TahunAjaran::where('id_tahun_ajaran','=',$tahunajaran->id_tahun_ajaran)->update($data);

        return redirect()->route('index_data_tahun_ajaran')->with('success','Sukses Menambahkan Tahun Ajaran');


    }


    public function destroyDataTahunAjaran(TahunAjaran $tahunajaran)
    {
        TahunAjaran::where('id_tahun_ajaran','=',$tahunajaran->id_tahun_ajaran)->delete();

         return redirect()->route('index_data_tahun_ajaran')->with('success','Sukses Menghapus Tahun Ajaran');
    }


    public function indexDataKelas()
    {
        $data_kelas=Kelas::all();
        return view ('admin.DataKelas.index',['data_kelas'=>$data_kelas]);
    }


    public function createDataKelas()
    {
        return view('admin.DataKelas.tambah');
    }


    public function storeDataKelas(KelasRequest $request)
    {
        $data_kelas = $request->all();

        Kelas::create($data_kelas);

        return redirect()->route('index_data_kelas')->with('success','Sukses Menambah Kelas');

    }


    public function editDataKelas(Kelas $kelas)
    {
        return view ('admin.DataKelas.edit',['data_kelas'=>$kelas]);
    }


    public function updateDataKelas(Request $request,Kelas $kelas)
    {
        $request->validate([
            'kelas' => 'required|unique:kelas,kelas,'. $kelas->id_kelas.',id_kelas',
        ],[
            'kelas.required'=>"Silahkan Masukkan Kelas Yang Ingin Ditambahkan",
            'kelas.unique'=>'Kelas Ini Sudah Ditambahkan',
        ]);

        $data_kelas=$request->except(['_token','_method']);

        Kelas::where('id_kelas','=',$kelas->id_kelas)->update($data_kelas);

        return redirect()->route('index_data_kelas')->with('success',"Berhasil Mengubah Data Kelas");

    }


    public function deleteDataKelas(Kelas $kelas)
    {
        Kelas::where('id_kelas','=',$kelas->id_kelas)->delete();
        return redirect()->route('index_data_kelas')->with('success',"Berhasil Mengubah Data");
    }


    //Mapel Guru
    public function indexDataMapelGuru()
    {
        $data_mapel_guru=DataMapelGuru::select('mata_pelajaran_guru.*', 'guru.nama AS nama_guru', 'mata_pelajaran.nama AS nama_mapel')
        ->with(['matapelajaran','guru'])
        ->join('guru','mata_pelajaran_guru.nip','=','guru.nip')
        ->join('mata_pelajaran','mata_pelajaran.id_mapel','=','mata_pelajaran_guru.id_mapel')
        ->get();

        $data_guru=Guru::all();

        return view('admin.DataMapelGuru.index',['data_mapel_guru'=>$data_mapel_guru,'data_guru'=>$data_guru]);
    }


    public function createDataMapelGuru(Guru $guru)
    {
        $data_mapel=MataPelajaran::all();
        return view('admin.DataMapelGuru.tambah',['data_guru'=>$guru,'data_mapel'=>$data_mapel]);
    }

    public function storeDataMapelGuru(DataMapelGuruRequest $request)
    {
        $data_mapel_guru=$request->all();


        $cek_mapel_guru=DataMapelGuru::where([
                ['id_mapel','=',$data_mapel_guru['id_mapel']],['nip','=',$data_mapel_guru['nip']]
            ])
        ->first();

        if($cek_mapel_guru)
        {
            return redirect()->back()->with('error','Guru Ini Sudah mengambil Mata Pelajaran Ini Sebelumnya');
        }

        DataMapelGuru::create($data_mapel_guru);

        return redirect()->route('index_data_mapel_guru')->with('success','Sukses Menambah Guru Mata Pelajaran');

    }


    public function editDataMapelGuru(DataMapelGuru $mapelguru)
    {
        $data_mapel_guru=DataMapelGuru::select('mata_pelajaran_guru.*', 'guru.nama AS nama_guru', 'mata_pelajaran.nama AS nama_mapel')
        ->with(['matapelajaran','guru'])
        ->join('guru','mata_pelajaran_guru.nip','=','guru.nip')
        ->join('mata_pelajaran','mata_pelajaran.id_mapel','=','mata_pelajaran_guru.id_mapel')
        ->where('id_mapel_guru','=',$mapelguru->id_mapel_guru)
        ->first();

        $data_mapel=MataPelajaran::all();


        return view('admin.DataMapelGuru.edit',['data_mapel_guru'=>$data_mapel_guru,'data_mapel'=>$data_mapel]);
    }

    public function updateDataMapelGuru(Request $request, DataMapelGuru $mapelguru)
    {
        $data_mapel_guru=$request->except(['_token','_method']);

        // $cek_mapel_guru=DataMapelGuru::where(['nip','=',$mapelguru->nip], ['id_mapel'])

        DataMapelGuru::where('id_mapel_guru','=',$data_mapel->id_mapel_guru)->update();
        return redirect()->route('index_data_mapel_guru')->with('success','Sukses Mengubah Guru Mata Pelajaran');
    }


    public function deleteDataMapelGuru(DataMapelGuru $mapelguru)
    {
        DataMapelGuru::where('id_mapel_guru','=',$mapelguru->id_mapel_guru)->delete();

        return redirect()->route('index_penempatan_siswa')->with('success','Sukses Menghapus Data Guru MataPelajaran');
    }


    //Guru Penempatan Siswa
    public function indexDataPenempatanSiswa()
    {
        $data_siswa=Siswa::all();
        $data_penempatan=PenempatanSiswa::select('penempatan_siswa.*', 'siswa.nama', 'kelas.kelas', 'tahun_ajaran.tahun_ajaran')
        ->with(['siswa','kelas','tahunajaran'])
        ->join('siswa','penempatan_siswa.nisn','=','siswa.nisn')
        ->join('kelas','penempatan_siswa.id_kelas','=','kelas.id_kelas')
        ->join('tahun_ajaran','penempatan_siswa.id_tahun_ajaran','=','tahun_ajaran.id_tahun_ajaran')
        ->get();

        return view('admin.DataPenempatanSiswa.index',['data_siswa'=>$data_siswa,
        'data_penempatan'=>$data_penempatan]);
    }


    public function createDataPenempatanSiswa(Siswa $siswa)
    {
        $data_kelas=Kelas::all();
        $data_tahun_ajaran=TahunAjaran::all();

        return view('admin.DataPenempatanSiswa.tambah',['data_siswa'=>$siswa
        ,'data_kelas'=>$data_kelas
        ,'data_tahun_ajaran'=>$data_tahun_ajaran]);
    }

    public function storeDataPenempatanSiswa(PenempatanSiswaRequest $request)
    {
        $data_penempatan=$request->all();

        $cek_penempatan=PenempatanSiswa::where('nisn','=',$data_penempatan['nisn'])->first();

        if($cek_penempatan)
        {
            return redirect()->back()->with('error','Siswa Sudah Ditempatkan Di Kelas Lain');
        }

        else
        {
            PenempatanSiswa::create($data_penempatan);
            return redirect()->route('index_data_penempatan_siswa')->with('success','Sukses Menempatkan Siswa Di Kelas Ini');
        }

    }

    public function editDataPenempatanSiswa(PenempatanSiswa $penempatan)
    {
        $data_kelas=Kelas::all();

        $data_tahun_ajaran=TahunAjaran::all();

        $data_penempatan=PenempatanSiswa::select('penempatan_siswa.*', 'siswa.nama', 'kelas.kelas', 'tahun_ajaran.tahun_ajaran')
        ->with(['siswa','kelas','tahunajaran'])
        ->join('siswa','penempatan_siswa.nisn','=','siswa.nisn')
        ->join('kelas','penempatan_siswa.id_kelas','=','kelas.id_kelas')
        ->join('tahun_ajaran','penempatan_siswa.id_tahun_ajaran','=','tahun_ajaran.id_tahun_ajaran')
        ->where('id_penempatan_siswa','=',$penempatan->id_penempatan_siswa)
        ->first();

        return view('admin.DataPenempatanSiswa.edit',['data_penempatan'=>$data_penempatan
        ,'data_kelas'=>$data_kelas
        ,'data_tahun_ajaran'=>$data_tahun_ajaran]);
    }

    public function updateDataPenempatanSiswa(Request $request, PenempatanSiswa $penempatan)
    {
        $data_penempatan=$request->except(['_method','_token']);

        PenempatanSiswa::where('id_penempatan_siswa','=',$penempatan->id_penempatan_siswa)
        ->update($data_penempatan);

        return redirect()->route('index_data_penempatan_siswa')->with('success','Sukses Mengubah Penempatan Siswa');
    }


    public function deleteDataPenempatanSiswa(PenempatanSiswa $penempatan)
    {
        PenempatanSiswa::where('id_penempatan_siswa','=',$penempatan->id_penempatan_siswa)->delete();

        return redirect()->route('index_data_penempatan_siswa')->with('success','Sukses Menghapus Data Penempatan Siswa');
    }

}
