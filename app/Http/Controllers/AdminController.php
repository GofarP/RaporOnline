<?php

namespace App\Http\Controllers;

use App\Enums\Agama;
use App\Models\Guru;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Nilai;
use App\Models\WaliKelas;
use App\Enums\JenisKelamin;
use App\Http\Requests\AturMataPelajaranRequest;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use App\Models\DataMapelGuru;
use App\Models\MataPelajaran;
use App\Models\PenempatanSiswa;
use Illuminate\Validation\Rule;
use App\Models\TahunAjaranAktif;
use Illuminate\Routing\Controller;
use App\Http\Requests\KelasRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Enum;
use App\Http\Requests\DataGuruRequest;
use App\Http\Requests\DataMapelRequest;
use App\Http\Requests\DataSiswaRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\TahunAjaranRequest;
use App\Http\Requests\DataMapelGuruRequest;
use App\Http\Requests\KredensialGuruRequest;
use App\Http\Requests\KredensialSiswaRequest;
use App\Http\Requests\PenempatanSiswaRequest;
use App\Http\Requests\TahunAjaranAktifRequest;
use App\Http\Requests\WaliKelasRequest;
use App\Models\AturMataPelajaran;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('role:Admin');
    }

    //Data Guru
    public function indexDataGuru()
    {
        $data_guru = Guru::all();
        return view('admin.DataGuru.index', ['data_guru' => $data_guru]);
    }

    public function createDataGuru()
    {
        return view('admin.DataGuru.tambah');
    }

    public function storeDataGuru(DataGuruRequest $request)
    {

        $data_guru = $request->all();

        $data_guru['foto'] = $request->file('foto')->store('assets/guru', 'public');

        Guru::create($data_guru);

        return redirect()->route('index_data_guru')->with('success', 'Sukses Menambah Data Guru Baru');
    }

    public function editDataGuru(Guru $guru)
    {
        return view('admin.DataGuru.edit', ['data_guru' => $guru]);
    }

    public function updateDataGuru(Request $request, Guru $guru)
    {

        $request->validate([
            "nip" => ['required', 'numeric', Rule::unique('guru', 'nip')->ignore($guru->nip, 'nip')],
            "nama" => "required|max:255",
            "email" => ['required', 'email', Rule::unique('guru', 'email')->ignore($guru->email, 'email')],
            "agama" => ['required', new Enum(Agama::class)],
            "tempat_lahir" => "required|string|max:255",
            'tanggal_lahir' => 'required|date_format:"d-m-Y"',
            "jenis_kelamin" => ['required', new Enum(JenisKelamin::class)],
            'alamat' => 'required|string|max:255',
            'foto' => 'image|file|mimes:jpeg,jpg|max:500',
            'pendidikan_terakhir' => 'required|string|max:255'
        ], [
            'nip.required' => "Silahkan Isi NIP Guru",
            'nip.unique' => "Pengguna Dengan NIP Ini Sudah Ditambahkan",
            'nip.numeric' => "NIP Harus Menggunakan Angka",
            'nama.required' => "Silahkan Isi Nama Guru",
            'email.required' => "Silahkan Isi Email Guru",
            'email.email' => "Harus Berupa Email",
            'email.unique' => "Email Sudah Digunakan",
            'agama.required' => "Silahkan Isi Agama Guru",
            'agama.Illuminate\Validation\Rules\Enum' => "Pilihan Agama Tidak Valid",
            'tempat_lahir.required' => "Silahkan Isi Tempat Lahir Guru",
            'tanggal_lahir.required' => "Silahkan Isi Tanggal Lahir Guru",
            'tanggal_lahir.date_format' => "Format Tanggal Lahir Tidak Valid",
            'jenis_kelamin.required' => "Silahkan Isi Jenis Kelamin Guru",
            'jenis_kelamin.Illuminate\Validation\Rules\Enum' => "Pilihan Agama Tidak Valid",
            'alamat.required' => 'Silahkan Isi Alamat Guru',
            'foto.image' => 'File Yang Diupload Harus Merupakan Gambar/Foto',
            'foto.uploaded' => 'Ukuran Gambar Yang Diupload Maksimal 500KB',
            'pendidikan_terakhir.required' => 'Silahkan Isi Pendidikan Terakhir'
        ]);

        $data_guru = $request->except(['_token', '_method']);

        if ($request->file('foto')) {
            Storage::disk('public')->delete($guru->foto);
            $data_guru['foto'] = $request->file('foto')->store('assets/guru', 'public');
        }

        Guru::where('nip', '=', $guru->nip)->update($data_guru);

        return redirect()->route('index_data_guru')->with('success', 'Sukses Mengubah Data Guru');;
    }

    public function destroyDataGuru(Guru $guru)
    {
        Storage::disk('public')->delete($guru->foto);

        Guru::where('nip', $guru->nip)->delete();

        return redirect()->route('index_data_guru')->with('success', "Sukses Menghapus Data Guru");;
    }


    //Kredensial Guru
    public function indexKredensialGuru()
    {
        $kredensial_data = User::where('role', '=', "Guru")->get();

        return view('admin.DataGuru.kredensial.index', ['kredensial' => $kredensial_data]);
    }

    public function createKredensialGuru()
    {
        return view('admin.DataGuru.kredensial.tambah');
    }

    public function storeKredensialGuru(KredensialGuruRequest $request)
    {
        $kredensial_guru = $request->all();

        $kredensial_guru['password'] = Hash::make($request->password);
        $kredensial_guru['role'] = "Guru";

        User::create($kredensial_guru);

        return redirect()->route('index_kredensial_guru')->with('success', 'Sukses Menambah Kredensial Baru');
    }

    public function editKredensialGuru(User $user)
    {
        return view('admin.DataGuru.kredensial.edit', ['user' => $user]);
    }

    public function updateKredensialGuru(Request $request, User $user)
    {

        $request->validate([
            'email' => 'required|email|unique:users,email,' . $user->id_users . ',id_users',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required|min:8'
        ], [
            'email.required' => "Silahkan Masukkan Email Kredensial Guru",
            'email.email' => 'Format Email Tidak Valid',
            'email.unique' => 'Email Ini Sudah Digunakan',
            'password.required' => 'Silahkan Masukkan Password Guru',
            'password.min' => "Panjang Password Minimal 8 Karakter",
            'password.confirmed' => 'Password Dan Konfirmasi Password Tidak Cocok',
            'password_confirmation.required' => 'Silahkan Masukkan Konfirmasi Password',
            'password_confirmation.min' => 'Panjang Konfirmasi Password Minimal 8'
        ]);


        $kredensial_guru = $request->except(['_token', '_method', 'password_confirmation']);

        $kredensial_guru['password'] = Hash::make($request->password);
        $kredensial_guru['role'] = "Guru";

        User::where('id_users', $user->id_users)->update($kredensial_guru);
        return redirect()->route('index_kredensial_guru')->with('success', 'Sukses Mengubah Kredensial Guru');;
    }

    public function destroyKredensialGuru(User $user)
    {
        User::where('id_users', $user->id_users)->delete();

        return redirect()->route('index_kredensial_guru')->with('success', "Sukses Menghapus Kredensial Guru");;
    }






    //Data Siswa
    public function indexDataSiswa()
    {
        $data_siswa = Siswa::all();
        return view('admin.DataSiswa.index', ['data_siswa' => $data_siswa]);
    }

    public function createDataSiswa()
    {
        return view('admin.DataSiswa.tambah');
    }

    public function storeDataSiswa(DataSiswaRequest $request)
    {
        $data_siswa = $request->all();

        $data_siswa['foto'] = $request->file('foto')->store('assets/siswa', 'public');

        Siswa::create($data_siswa);

        return redirect()->route('index_data_siswa')->with('success', 'Sukses Menambah Data Siswa Baru');
    }

    public function editDataSiswa(Siswa $siswa)
    {
        return view('admin.DataSiswa.edit', ['siswa' => $siswa]);
    }

    public function updateDataSiswa(Request $request, Siswa $siswa)
    {
        $request->validate([
            "nisn" => ['required', 'numeric', Rule::unique('siswa', 'nisn')->ignore($siswa->nisn, 'nisn')],
            "nama" => "required|max:255",
            "email" => ['required', 'email', Rule::unique('siswa', 'email')->ignore($siswa->email, 'nip')],
            "agama" => ['required', new Enum(Agama::class)],
            "tempat_lahir" => "required|string|max:255",
            'tanggal_lahir' => 'required|date_format:"d-m-Y"',
            'jenis_kelamin' => ['required', new Enum(JenisKelamin::class)],
            'alamat' => 'required|string|max:255',
            'foto' => 'image|file|mimes:jpeg,jpg|max:500',
        ], [
            'nisn.required' => "Silahkan Isi NISN Siswa",
            'nisn.unique' => "Pengguna Dengan NISN Ini Sudah Ditambahkan",
            'nisn.numeric' => "NISN Harus Menggunakan Angka",
            'nama.required' => "Silahkan Isi Nama Siswa",
            'email.required' => "Silahkan Masukkan Email Siswa",
            'email.email' => 'Harus Berupa Email',
            'email.unique' => 'Email ini sudah digunakan sebelumnya',
            'agama.required' => "Silahkan Isi Agama Siswa",
            'agama.Illuminate\Validation\Rules\Enum' => "Pilihan Agama Tidak Valid",
            'tempat_lahir.required' => "Silahkan Isi Tempat Lahir Siswa",
            'tanggal_lahir.required' => "Silahkan Isi Tanggal Lahir Siswa",
            'tanggal_lahir.date_format' => "Format Tanggal Lahir Tidak Valid",
            'jenis_kelamin.required' => "Silahkan Isi Jenis Kelamin Siswa",
            'jenis_kelamin.Illuminate\Validation\Rules\Enum' => "Pilihan Jenis Kelamin Tidak Valid",
            'alamat.required' => 'Silahkan Isi Alamat Siswa',
            'foto.image' => 'File Yang Diupload Harus Merupakan Gambar/Foto',
            'foto.uploaded' => 'Ukuran Gambar Yang Diupload Maksimal 500KB',
        ]);

        $data_siswa = $request->except(['_token', '_method']);

        if ($request->file('foto')) {
            Storage::disk('public')->delete($siswa->foto);
            $data_siswa['foto'] = $request->file('foto')->store('assets/siswa', 'public');
        }

        Siswa::where('nisn', '=', $siswa->nisn)->update($data_siswa);

        return redirect()->route('index_data_siswa')->with('success', 'Sukses Mengubah Data Siswa');;
    }


    public function destroyDataSiswa(Siswa $siswa)
    {
        Siswa::where('nisn', '=', $siswa->nisn)->delete();

        return redirect()->route('index_data_siswa')->with('success', "Sukses Menghapus Data Siswa");
    }




    //Kredensial Siswa
    public function indexKredensialSiswa()
    {
        $kredensial_data = User::where('role', '=', "Siswa")->get();
        return view('admin.DataSiswa.kredensial.index', ['kredensial' => $kredensial_data]);
    }

    public function createKredensialSiswa()
    {
        return view('admin.DataSiswa.kredensial.tambah');
    }

    public function storeKredensialSiswa(KredensialSiswaRequest $request)
    {
        $kredensial_siswa = $request->all();

        $kredensial_siswa['password'] = Hash::make($request->password);
        $kredensial_siswa['role'] = "Siswa";

        User::create($kredensial_siswa);

        return redirect()->route('index_kredensial_siswa')->with('success', 'Sukses Menambah Kredensial Baru');
    }

    public function editKredensialSiswa(User $user)
    {
        return view('admin.DataSiswa.kredensial.edit', ['user' => $user]);
    }

    public function updateKredensialSiswa(Request $request, User $user)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email,' . $user->id_users . ',id_users',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required|min:8'
        ], [
            'email.required' => "Silahkan Masukkan Email Kredensial Guru",
            'email.email' => 'Format Email Tidak Valid',
            'email.unique' => 'Email Ini Sudah Digunakan',
            'password.required' => 'Silahkan Masukkan Password Guru',
            'password.min' => "Panjang Password Minimal 8 Karakter",
            'password.confirmed' => 'Password Dan Konfirmasi Password Tidak Cocok',
            'password_confirmation.required' => 'Silahkan Masukkan Konfirmasi Password',
            'password_confirmation.min' => 'Panjang Konfirmasi Password Minimal 8'
        ]);


        $kredensial_siswa = $request->except(['_token', '_method', 'password_confirmation']);

        $kredensial_siswa['password'] = Hash::make($request->password);
        $kredensial_siswa['role'] = "Siswa";

        User::where('id_users', $user->id_users)->update($kredensial_siswa);
        return redirect()->route('index_kredensial_siswa')->with('success', 'Sukses Mengubah Kredensial Siswa');
    }

    public function destroyKredensialSiswa(User $user)
    {
        User::where('id_users', $user->id_users)->delete();

        return redirect()->route('index_kredensial_siswa')->with('success', "Sukses Menghapus kredensial Siswa");
    }


    //MAta Pelajaran
    public function indexDataMataPelajaran()
    {
        $data_mapel = MataPelajaran::all();
        return view('admin.DataMapel.index', ['data_mapel' => $data_mapel]);
    }
    public function createDataMataPelajaran()
    {
        return view('admin.DataMapel.tambah');
    }

    public function storeDataMataPelajaran(DataMapelRequest $request)
    {
        $data_mapel = $request->all();

        MataPelajaran::create($data_mapel);

        return redirect()->route('index_data_mata_pelajaran')->with('success', "Sukses Menambah Data Mata Pelajaran Baru");
    }


    public function editDataMataPelajaran(MataPelajaran $matapelajaran)
    {
        return view('admin.DataMapel.edit', ['mataPelajaran' => $matapelajaran]);
    }


    public function updateDataMataPelajaran(Request $request, MataPelajaran $matapelajaran)
    {
        $request->validate([
            'nama' => 'required|string|unique:mata_pelajaran,nama,' . $matapelajaran->id_mapel . ',id_mapel',

        ], [
            'nama.required' => "Silahkan Masukkan Nama Mata Pelajaran",
            'nama.string' => 'Nama Pelajaran Tidak Boleh Menggunakan Angka',
            'nama.unique' => 'Pelajaran Ini Telah Didaftarkan Sebelumnya'
        ]);

        $data_mapel = $request->except(['_token', '_method']);

        MataPelajaran::where('id_mapel', '=', $matapelajaran->id_mapel)
            ->update($data_mapel);

        return redirect()->route('index_data_mata_pelajaran')->with('success', "Sukses Mengubah Data Mata Pelajaran Baru");
    }


    public function destroyDataMataPelajaran(MataPelajaran $matapelajaran)
    {
        MataPelajaran::where('id_mapel', '=', $matapelajaran->id_mapel)
            ->delete();

        return redirect()->route('index_data_mata_pelajaran')->with('success', "Sukses Menghapus Mata Pelajaran");
    }


    public function indexAturMataPelajaran()
    {
        $data_atur_mapel = AturMataPelajaran::join('mata_pelajaran', 'mata_pelajaran.id_mapel', '=', 'atur_mata_pelajaran.id_mata_pelajaran')
            ->join('tahun_ajaran', 'tahun_ajaran.id_tahun_ajaran', '=', 'atur_mata_pelajaran.id_tahun_ajaran')
            ->join('kelas', 'kelas.id_kelas', '=', 'atur_mata_pelajaran.id_kelas')
            ->get();

        $data_mapel = MataPelajaran::all();

        return view('admin.DataMapel.AturMapel.index', ['data_atur_mapel' => $data_atur_mapel, 'data_mapel' => $data_mapel]);
    }


    public function createAturMataPelajaran(MataPelajaran $matapelajaran)
    {
        $data_kelas = Kelas::all();
        $data_tahun_ajaran = TahunAjaran::all();

        return view('admin.DataMapel.AturMapel.tambah', ['data_kelas' => $data_kelas, 'data_tahun_ajaran' => $data_tahun_ajaran, 'mapel' => $matapelajaran]);
    }

    public function storeAturMataPelajaran(AturMataPelajaranRequest $request)
    {
        $data_atur_mapel = $request->all();

        $validasi_data = AturMataPelajaran::where('id_mata_pelajaran', '=', $data_atur_mapel['id_mata_pelajaran'])
            ->where('id_kelas', '=', $data_atur_mapel['id_kelas'])
            ->where('id_tahun_ajaran', '=', $data_atur_mapel['id_tahun_ajaran'])
            ->first();

        if ($validasi_data) {
            return redirect()->back()->with('error', 'Mata Pelajaran Ini Sudah Diatur Untuk ini Kelas Dan Tahun ajaran Ini Sebelumnya');
        } else {
            AturMataPelajaran::create($data_atur_mapel);

            return redirect()->route('index_atur_mata_pelajaran')->with('success', 'Sukses Mengatur Mata Pelajaran Untuk Kelas Ini');
        }
    }

    public function editAturMataPelajaran(AturMataPelajaran $aturmatapelajaran)
    {
        $data_mapel = AturMataPelajaran::select('mata_pelajaran.*')
            ->join('mata_pelajaran', 'mata_pelajaran.id_mapel', '=', 'atur_mata_pelajaran.id_mata_pelajaran')
            ->join('tahun_ajaran', 'tahun_ajaran.id_tahun_ajaran', '=', 'atur_mata_pelajaran.id_tahun_ajaran')
            ->join('kelas', 'kelas.id_kelas', '=', 'atur_mata_pelajaran.id_kelas')
            ->where('id_mata_pelajaran','=',$aturmatapelajaran->id_mata_pelajaran)->first();

        $data_kelas = Kelas::all();

        $data_tahun_ajaran=TahunAjaran::all();
        return view('admin.DataMapel.AturMapel.edit', ['data_atur_mapel' => $aturmatapelajaran,
        'data_kelas' => $data_kelas,
        'data_tahun_ajaran' => $data_tahun_ajaran,
        'data_mapel'=>$data_mapel]);
    }


    public function updateAturMataPelajaran(AturMataPelajaran $aturMataPelajaran, AturMataPelajaranRequest $request)
    {
        $data_atur_mapel = $request->except(['_method', '_token']);


        $validasi_data = AturMataPelajaran::where('id_mata_pelajaran', '=', $data_atur_mapel['id_mata_pelajaran'])
            ->where('id_kelas', '=', $data_atur_mapel['id_kelas'])
            ->where('id_tahun_ajaran', '=', $data_atur_mapel['id_tahun_ajaran'])
            ->first();

        if ($validasi_data) {
            return redirect()->back()->with('error', 'Mata Pelajaran Ini Sudah Diatur Untuk ini Kelas Dan Tahun ajaran Ini Sebelumnya');
        }

        else{
            AturMataPelajaran::where('id_atur_mata_pelajaran', '=', $aturMataPelajaran->id_atur_mata_pelajaran)
            ->update($data_atur_mapel);
            return redirect()->route('index_atur_mata_pelajaran')->with('success', 'Sukses Mengubah Mata Pelajaran Untuk Kelas Ini');
        }

    }


    public function deleteMataPelajaran(AturMataPelajaran $aturMataPelajaran)
    {
        AturMataPelajaran::where('id_atur_mata_pelajaran', '=', $aturMataPelajaran->id_atur_mata_pelajaran)
            ->delete();

        return redirect()->back()->with('success', 'Sukses Menghapus Data Mata Pelajaran Ini');
    }

    //Tahun Ajaran
    public function indexDataTahunAjaran()
    {
        $data_tahun_ajaran = TahunAjaran::all();

        $data_tahun_ajaran_aktif = TahunAjaranAktif::select('tahun_ajaran.tahun_ajaran','tahun_ajaran_aktif.semester')
            ->with('tahunajaran')
            ->join('tahun_ajaran', 'tahun_ajaran.id_tahun_ajaran', '=', 'tahun_ajaran_aktif.id_tahun_ajaran')
            ->where('tahun_ajaran_aktif.id_tahun_ajaran_aktif', '=', 1)->first();


        return view('admin.DataTahunAjaran.index', ['tahun_ajaran' => $data_tahun_ajaran,
        'data_tahun_ajaran_aktif' => $data_tahun_ajaran_aktif,
        ]);
    }

    public function createDataTahunAjaran()
    {
        return view('admin.DataTahunAjaran.tambah');
    }

    public function storeDataTahunAjaran(TahunAjaranRequest $request)
    {
        $data_tahun_ajaran = $request->all();

        if ($data_tahun_ajaran["tahun_awal"] > $data_tahun_ajaran["tahun_akhir"]) {
            return back()->with('rentang_tahun_error', "Tahun Awal Harus Lebih Kecil Daripada Tahun Akhir");
        }


        $data['tahun_ajaran'] = $data_tahun_ajaran["tahun_awal"] . "-" . $data_tahun_ajaran["tahun_akhir"];
        $cek_tahun_ajaran = TahunAjaran::where('tahun_ajaran', '=', $data['tahun_ajaran'])->first();

        if ($cek_tahun_ajaran) {
            return redirect()->back()->with('error', 'Tahun Ajaran Ini Sudah Ditambahkan Sebelumnya');
        }

        TahunAjaran::create($data);

        return redirect()->route('index_data_tahun_ajaran')->with('success', 'Sukses Menambahkan Tahun Ajaran');
    }


    public function editDataTahunAjaran(TahunAjaran $tahunajaran)
    {
        return view('admin.DataTahunAjaran.edit', ['tahun_ajaran' => $tahunajaran]);
    }


    public function updateDataTahunAjaran(Request $request, TahunAjaran $tahunajaran)
    {

        $data_tahun_ajaran = $request->except(['_method', '_token']);

        $request->validate([
            'tahun_awal' => 'required|numeric',
            'tahun_akhir' => 'required|numeric'
        ], [
            'tahun_awal.required' => 'Silahkan Masukkan Tahun Awal Ajaran',
            'tahun_awal.numeric' => 'Tahun Awal Ajaran Harus Berupa Angka',
            'tahun_akhir.required' => 'Silahkan Masukkan Tahun Akhir Ajaran',
            'tahun_akhir.numeric' => 'Tahun Akhir Ajaran Harus Berupa Angka',
        ]);


        $data['tahun_ajaran'] = $data_tahun_ajaran["tahun_awal"] . "-" . $data_tahun_ajaran["tahun_akhir"];

        $cek_tahun_ajaran = TahunAjaran::where('tahun_ajaran', '=', $data['tahun_ajaran'])->first();

        if ($cek_tahun_ajaran) {
            return redirect()->back()->with('error', 'Tahun Ajaran Ini Sudah Ditambahkan Sebelumnya');
        }

        if ($data_tahun_ajaran['tahun_awal'] > $data_tahun_ajaran['tahun_akhir']) {
            return redirect()->back()->with('error', 'Tahun Awal Tidak Boleh Lebih Besar Dari Tahun Akhir');
        }


        TahunAjaran::where('id_tahun_ajaran', '=', $tahunajaran->id_tahun_ajaran)->update($data);

        return redirect()->route('index_data_tahun_ajaran')->with('success', 'Sukses Menambahkan Tahun Ajaran');
    }


    public function destroyDataTahunAjaran(TahunAjaran $tahunajaran)
    {
        TahunAjaran::where('id_tahun_ajaran', '=', $tahunajaran->id_tahun_ajaran)->delete();

        return redirect()->route('index_data_tahun_ajaran')->with('success', 'Sukses Menghapus Tahun Ajaran');
    }

    public function showTahunAjaran()
    {
        $data_tahun_ajaran = TahunAjaran::all();

        $data_tahun_ajaran_aktif = TahunAjaranAktif::where('id_tahun_ajaran_aktif', '=', 1)->first();

        return view(
            'admin.DataTahunAjaran.tahunajaran',
            ['data_tahun_ajaran' => $data_tahun_ajaran],
            ['tahun_ajaran_aktif' => $data_tahun_ajaran_aktif]
        );
    }

    public function setTahunAjaranAktif(TahunAjaranAktifRequest $request)
    {
        $data_tahun_ajaran = $request->all();

        TahunAjaranAktif::create($data_tahun_ajaran);

        return redirect()->route('index_data_tahun_ajaran')->with('success', 'Sukses Menetapkan Tahun Ajaran Baru');
    }

    public function updateTahunAjaranAktif(TahunAjaranAktifRequest $request)
    {
        $data_tahun_ajaran = $request->except(['_token', '_method']);
        TahunAjaranAktif::where('id_tahun_ajaran_aktif', '=', 1)->update($data_tahun_ajaran);

        return redirect()->route('index_data_tahun_ajaran')->with('success', 'Sukses Mengubah Tahun Ajaran Baru');
    }



    public function indexDataKelas()
    {
        $data_kelas = Kelas::all();
        return view('admin.DataKelas.index', ['data_kelas' => $data_kelas]);
    }


    public function createDataKelas()
    {
        return view('admin.DataKelas.tambah');
    }


    public function storeDataKelas(KelasRequest $request)
    {
        $data_kelas = $request->all();

        Kelas::create($data_kelas);

        return redirect()->route('index_data_kelas')->with('success', 'Sukses Menambah Kelas');
    }


    public function editDataKelas(Kelas $kelas)
    {
        return view('admin.DataKelas.edit', ['data_kelas' => $kelas]);
    }


    public function updateDataKelas(Request $request, Kelas $kelas)
    {
        $request->validate([
            'kelas' => 'required|unique:kelas,kelas,' . $kelas->id_kelas . ',id_kelas',
        ], [
            'kelas.required' => "Silahkan Masukkan Kelas Yang Ingin Ditambahkan",
            'kelas.unique' => 'Kelas Ini Sudah Ditambahkan',
        ]);

        $data_kelas = $request->except(['_token', '_method']);

        Kelas::where('id_kelas', '=', $kelas->id_kelas)->update($data_kelas);

        return redirect()->route('index_data_kelas')->with('success', "Berhasil Mengubah Data Kelas");
    }


    public function deleteDataKelas(Kelas $kelas)
    {
        Kelas::where('id_kelas', '=', $kelas->id_kelas)->delete();
        return redirect()->route('index_data_kelas')->with('success', "Berhasil Mengubah Data");
    }


    //Mapel Guru
    public function indexDataMapelGuru()
    {
        $data_mapel_guru = DataMapelGuru::select('mata_pelajaran_guru.*', 'guru.nama AS nama_guru', 'mata_pelajaran.nama AS nama_mapel')
            ->with(['matapelajaran', 'guru'])
            ->join('guru', 'mata_pelajaran_guru.nip', '=', 'guru.nip')
            ->join('mata_pelajaran', 'mata_pelajaran.id_mapel', '=', 'mata_pelajaran_guru.id_mapel')
            ->get();

        $data_guru = Guru::all();

        return view('admin.DataMapelGuru.index', ['data_mapel_guru' => $data_mapel_guru, 'data_guru' => $data_guru]);
    }


    public function createDataMapelGuru(Guru $guru)
    {
        $data_mapel = MataPelajaran::all();
        return view('admin.DataMapelGuru.tambah', ['data_guru' => $guru, 'data_mapel' => $data_mapel]);
    }

    public function storeDataMapelGuru(DataMapelGuruRequest $request)
    {
        $data_mapel_guru = $request->all();


        $cek_mapel_guru = DataMapelGuru::where([
            ['id_mapel', '=', $data_mapel_guru['id_mapel']], ['nip', '=', $data_mapel_guru['nip']]
        ])
            ->first();

        if ($cek_mapel_guru) {
            return redirect()->back()->with('error', 'Guru Ini Sudah mengambil Mata Pelajaran Ini Sebelumnya');
        }

        DataMapelGuru::create($data_mapel_guru);

        return redirect()->route('index_data_mapel_guru')->with('success', 'Sukses Menambah Guru Mata Pelajaran');
    }


    public function editDataMapelGuru(DataMapelGuru $mapelguru)
    {
        $data_mapel_guru = DataMapelGuru::select('mata_pelajaran_guru.*', 'guru.nama AS nama_guru', 'mata_pelajaran.nama AS nama_mapel')
            ->with(['matapelajaran', 'guru'])
            ->join('guru', 'mata_pelajaran_guru.nip', '=', 'guru.nip')
            ->join('mata_pelajaran', 'mata_pelajaran.id_mapel', '=', 'mata_pelajaran_guru.id_mapel')
            ->where('id_mapel_guru', '=', $mapelguru->id_mapel_guru)
            ->first();

        $data_mapel = MataPelajaran::all();


        return view('admin.DataMapelGuru.edit', ['data_mapel_guru' => $data_mapel_guru, 'data_mapel' => $data_mapel]);
    }


    public function updateDataMapelGuru(Request $request, DataMapelGuru $mapelguru)
    {

        $request->validate(
            [
                'nip' => 'required|numeric|exists:guru,nip',
                'id_mapel' => 'required|exists:mata_pelajaran,id_mapel',
            ],
            [
                'nip.required' => "Nip Guru Tidak Valid, Silahkan Pilih Ulang Guru",
                'nip.numeric' => 'Nip Guru Harus Berupa Angka',
                'nip.exists' => 'Nip Guru Tidak Ditemukan, Silahkan Pilih Ulang Guru',
                'id_mapel.required' => 'Id Mapel Tidak Valid, Silahkan refresh browser',
                'id_mapel.exists' => 'Id Mapel Tidak Ditemukan, Silahkan Refresh browser',
            ]
        );

        $id_mapel = $request->id_mapel;

        $cek_mapel_guru = DataMapelGuru::where([['id_mapel', '=', $id_mapel], ['nip', '=', $mapelguru->nip]])->first();

        if ($cek_mapel_guru) {
            return redirect()->back()->with('error', "Guru Sudah Mengambil Data Ini Sebelumnya");
        } else {
            $data_mapel_guru = $request->except(['_method', '_token']);
            DataMapelguru::where('id_mapel_guru', '=', $mapelguru->id_mapel_guru)->update($data_mapel_guru);
            return redirect()->route('index_data_mapel_guru')->with('success', "Sukses Mengubah Guru Matapelajaran");
        }
    }


    public function deleteDataMapelGuru(DataMapelGuru $mapelguru)
    {
        DataMapelGuru::where('id_mapel_guru', '=', $mapelguru->id_mapel_guru)->delete();

        return redirect()->route('index_penempatan_siswa')->with('success', 'Sukses Menghapus Data Guru MataPelajaran');
    }


    //Guru Penempatan Siswa
    public function indexDataPenempatanSiswa()
    {
        $data_siswa = Siswa::all();
        $data_penempatan = PenempatanSiswa::select('penempatan_siswa.*', 'siswa.nama', 'kelas.kelas', 'tahun_ajaran.tahun_ajaran')
            ->with(['siswa', 'kelas', 'tahunajaran'])
            ->join('siswa', 'penempatan_siswa.nisn', '=', 'siswa.nisn')
            ->join('kelas', 'penempatan_siswa.id_kelas', '=', 'kelas.id_kelas')
            ->join('tahun_ajaran', 'penempatan_siswa.id_tahun_ajaran', '=', 'tahun_ajaran.id_tahun_ajaran')
            ->get();

        return view('admin.DataPenempatanSiswa.index', [
            'data_siswa' => $data_siswa,
            'data_penempatan' => $data_penempatan
        ]);
    }


    public function createDataPenempatanSiswa(Siswa $siswa)
    {
        $data_kelas = Kelas::all();
        $data_tahun_ajaran = TahunAjaran::all();

        return view('admin.DataPenempatanSiswa.tambah', [
            'data_siswa' => $siswa, 'data_kelas' => $data_kelas, 'data_tahun_ajaran' => $data_tahun_ajaran
        ]);
    }

    public function storeDataPenempatanSiswa(PenempatanSiswaRequest $request)
    {
        $data_penempatan = $request->all();


        $cek_siswa = PenempatanSiswa::where('nisn', '=', $data_penempatan['nisn'])
            ->where('id_tahun_ajaran', '=', $data_penempatan['id_tahun_ajaran'])
            ->first();


        if ($cek_siswa) {
            return redirect()->back()->with('error', 'Siswa Sudah Ditempatkan Di Kelas Lain untuk Tahun Ajaran Ini');
        } else {
            PenempatanSiswa::create($data_penempatan);
            return redirect()->route('index_data_penempatan_siswa')->with('success', 'Sukses Menempatkan Siswa Di Kelas Ini');
        }
    }

    public function editDataPenempatanSiswa(PenempatanSiswa $penempatan)
    {
        $data_kelas = Kelas::all();

        $data_tahun_ajaran = TahunAjaran::all();

        $data_penempatan = PenempatanSiswa::select('penempatan_siswa.*', 'siswa.nama', 'kelas.kelas', 'tahun_ajaran.tahun_ajaran')
            ->with(['siswa', 'kelas', 'tahunajaran'])
            ->join('siswa', 'penempatan_siswa.nisn', '=', 'siswa.nisn')
            ->join('kelas', 'penempatan_siswa.id_kelas', '=', 'kelas.id_kelas')
            ->join('tahun_ajaran', 'penempatan_siswa.id_tahun_ajaran', '=', 'tahun_ajaran.id_tahun_ajaran')
            ->where('id_penempatan_siswa', '=', $penempatan->id_penempatan_siswa)
            ->first();

        return view('admin.DataPenempatanSiswa.edit', [
            'data_penempatan' => $data_penempatan, 'data_kelas' => $data_kelas, 'data_tahun_ajaran' => $data_tahun_ajaran
        ]);
    }

    public function updateDataPenempatanSiswa(Request $request, PenempatanSiswa $penempatan)
    {
        $data_penempatan = $request->except(['_method', '_token']);

        $data_penempatan['id_tahun_ajaran'] = $data_penempatan['id_tahun_ajaran'];

        // $cek_siswa=PenempatanSiswa::where('nisn','=',$data_penempatan['nisn'])
        // ->where('id_tahun_ajaran','=',$data_penempatan['id_tahun_ajaran'])
        // ->first();

        PenempatanSiswa::where('id_penempatan_siswa', '=', $penempatan->id_penempatan_siswa)
            ->update($data_penempatan);

        return redirect()->route('index_data_penempatan_siswa')->with('success', 'Sukses Mengubah Penempatan Siswa');
    }


    public function deleteDataPenempatanSiswa(PenempatanSiswa $penempatan)
    {
        PenempatanSiswa::where('id_penempatan_siswa', '=', $penempatan->id_penempatan_siswa)->delete();

        return redirect()->route('index_data_penempatan_siswa')->with('success', 'Sukses Menghapus Data Penempatan Siswa');
    }


    public function indexDataWaliKelas()
    {
        $data_guru = Guru::all();

        $data_wali_kelas = WaliKelas::select('wali_kelas.id_wali_kelas', 'guru.nip', 'guru.nama', 'kelas.kelas', 'tahun_ajaran.tahun_ajaran')
            ->join('guru', 'wali_kelas.nip', '=', 'guru.nip')
            ->join('kelas', 'wali_kelas.id_kelas', '=', 'kelas.id_kelas')
            ->join('tahun_ajaran', 'wali_kelas.id_tahun_ajaran', '=', 'tahun_ajaran.id_tahun_ajaran')
            ->get();

        return view('admin.DataWaliKelas.index', ['data_guru' => $data_guru, 'data_wali_kelas' => $data_wali_kelas]);
    }


    public function createDataWaliKelas(Guru $guru)
    {
        $data_kelas = Kelas::all();
        $data_tahun_ajaran = TahunAjaran::all();

        return view('admin.DataWaliKelas.tambah', [
            'data_guru' => $guru,
            'data_kelas' => $data_kelas,
            'data_tahun_ajaran' => $data_tahun_ajaran
        ]);
    }

    public function storeDataWaliKelas(WaliKelasRequest $request)
    {

        $data_wali_kelas = $request->all();
        $id_tahun_ajaran = $data_wali_kelas['id_tahun_ajaran'];
        $id_kelas = $data_wali_kelas['id_kelas'];
        $nip = $data_wali_kelas['nip'];

        $validasi_wali_kelas = WaliKelas::where('id_tahun_ajaran', '=', $id_tahun_ajaran)
            ->where('id_kelas', '=', $id_kelas)
            ->first();

        $validasi_guru = WaliKelas::where('nip', '=', $nip)
            ->where('id_tahun_ajaran', '=', $id_tahun_ajaran)
            ->first();

        if ($validasi_wali_kelas) {
            return back()->with('error', "Kelas Ini Sudah Mempunyai Wali Kelas");
        } else if ($validasi_guru) {
            return back()->with('error', "Guru Ini Sudah Menjadi Wali Kelas Untuk Tahun Ajaran Ini");
        } else {
            WaliKelas::create($data_wali_kelas);
            return redirect()->route('index_data_wali_kelas')->with('success', "Sukses Menambahkan Data Wali Kelas");
        }
    }


    public function editDataWaliKelas(WaliKelas $walikelas)
    {
        $data_wali_kelas = Walikelas::select('wali_kelas.id_wali_kelas', 'guru.nip', 'guru.nama')
            ->join('guru', 'wali_kelas.nip', '=', 'guru.nip')
            ->where("wali_kelas.id_wali_kelas", '=', $walikelas->id_wali_kelas)
            ->first();

        $data_kelas = Kelas::all();
        $data_tahun_ajaran = TahunAjaran::all();

        return view('admin.DataWaliKelas.edit', [
            'data_wali_kelas' => $data_wali_kelas,
            'data_tahun_ajaran' => $data_tahun_ajaran, 'data_kelas' => $data_kelas
        ]);
    }


    public function updateDataWaliKelas(WaliKelas $walikelas, WaliKelasRequest $request)
    {
        $data_wali_kelas = $request->except('_token', '_method');
        $id_tahun_ajaran = $data_wali_kelas['id_tahun_ajaran'];
        $id_kelas = $data_wali_kelas['id_kelas'];
        $nip = $data_wali_kelas['nip'];

        $validasi_wali_kelas = WaliKelas::where('id_tahun_ajaran', '=', $id_tahun_ajaran)
            ->where('id_kelas', '=', $id_kelas)
            ->first();

        $validasi_guru = WaliKelas::where('nip', '=', $nip)
            ->where('id_tahun_ajaran', '=', $id_tahun_ajaran)
            ->first();

        $validasi_kelas = WaliKelas::where('nip', '=', $nip)
            ->where('id_tahun_ajaran', '=', $id_tahun_ajaran)
            ->where('id_kelas', '=', $id_kelas)
            ->first();


        if ($validasi_kelas) {
            return back()->with('error', "Guru Ini Sudah Menjadi Wali Dari Kelas Ini");
        } else if ($validasi_wali_kelas) {
            return back()->with('error', "Kelas Ini Sudah Mempunyai Wali Kelas");
        } else if ($validasi_guru) {
            return back()->with('error', "Guru Ini Sudah Menjadi Wali Kelas Untuk Tahun Ajaran Ini");
        } else {
            WaliKelas::where('id_wali_kelas', '=', $walikelas->id_wali_kelas)->update($data_wali_kelas);
            return redirect()->route('index_data_wali_kelas')->with('success', "Sukses Mengubah Data Wali Kelas");
        }
    }


    public function deleteDataWaliKelas(WaliKelas $walikelas)
    {
        WaliKelas::where('id_wali_kelas', $walikelas->id_wali_kelas)->delete();

        return redirect()->route('index_data_wali_kelas')->with('success', 'Sukses Menghapus Data Wali Kelas');
    }


    public function indexDataNilaiSiswa()
    {
        $data_tahun_ajaran_aktif=TahunAjaranAktif::first();

        $data_nilai = Nilai::select('nilai_master.*', 'siswa.nama AS nama_siswa',
        'mata_pelajaran.nama AS nama_mapel', 'kelas.kelas', 'tahun_ajaran.tahun_ajaran')
        ->join('siswa', 'nilai_master.nisn', '=', 'siswa.nisn')
        ->join('mata_pelajaran', 'nilai_master.id_mapel', '=', 'mata_pelajaran.id_mapel')
        ->join('tahun_ajaran', 'nilai_master.id_tahun_ajaran', '=', 'tahun_ajaran.id_tahun_ajaran')
        ->join('kelas', 'nilai_master.id_kelas', '=', 'kelas.id_kelas')
        ->get();

        $data_penempatan_siswa=PenempatanSiswa::select('penempatan_siswa.*', 'siswa.nama', 'kelas.kelas', 'tahun_ajaran.tahun_ajaran')
        ->with(['siswa','kelas','tahunajaran'])
        ->join('siswa','penempatan_siswa.nisn','=','siswa.nisn')
        ->join('kelas','penempatan_siswa.id_kelas','=','kelas.id_kelas')
        ->join('tahun_ajaran','penempatan_siswa.id_tahun_ajaran','=','tahun_ajaran.id_tahun_ajaran')
        ->where('tahun_ajaran.id_tahun_ajaran','=',$data_tahun_ajaran_aktif->id_tahun_ajaran)
        ->get();

        return view('admin.DataNilaiSiswa.index',['data_nilai'=>$data_nilai,'data_penempatan_siswa'=>$data_penempatan_siswa]);
    }

    public function createDataNilaiSiswa(PenempatanSiswa $penempatansiswa)
    {
        $data_tahun_ajaran=TahunAjaranAktif::first();
        $data_mapel=MataPelajaran::get();

        return view('admin.DataNilaiSiswa.tambah',['data_tahun_ajaran'=>$data_tahun_ajaran,
         'data_mapel'=>$data_mapel,
         'data_siswa'=>$penempatansiswa
        ]);
    }

    public function storeDataNilaiSiswa()
    {

    }


    public function editDataNilaiSiswa()
    {

    }


    public function updateDataNilaiSiswa()
    {

    }

    public function deleteDataNilaiSiswa(Nilai $nilaisiswa)
    {
        Nilai::where('id_nilai_master','=',$nilaisiswa->id_nilai_master)->delete();

        return redirect()->route('admin_index_data_nilai_siswa')->with('success','Berhasil Menghapus Nilai Siswa');
    }
}
