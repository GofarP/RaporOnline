<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\WaliKelas;
use Illuminate\Http\Request;
use App\Models\DataMapelGuru;
use App\Models\MataPelajaran;
use App\Models\PenempatanSiswa;
use App\Models\TahunAjaranAktif;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\NilaiSiswaRequest;
use App\Http\Requests\PenempatanSiswaRequest;
use App\Models\AturMataPelajaran;
use App\Models\TahunAjaran;

class NilaiController extends Controller
{

    public function indexDataNilaiSiswa()
    {
        $email_pengguna=Auth::user()->email;

        $data_guru=Guru::where('email',$email_pengguna)->first();

        $data_tahun_ajaran_aktif=TahunAjaranAktif::where('id_tahun_ajaran_aktif','=',1)->first();

        $is_wali_kelas=WaliKelas::where('nip','=',$data_guru->nip)
        ->where('id_tahun_ajaran','=',$data_tahun_ajaran_aktif->id_tahun_ajaran)
        ->first();

        $data_mapel_diampu=DataMapelGuru::where('nip','=',$data_guru['nip'])->get();

        $data_mapel_kelas=AturMataPelajaran::whereIn('id_mata_pelajaran',$data_mapel_diampu->pluck('id_mapel'))->get();

        $data_penempatan_siswa=PenempatanSiswa::select('penempatan_siswa.*', 'siswa.nama', 'kelas.kelas', 'tahun_ajaran.tahun_ajaran')
        ->with(['siswa','kelas','tahunajaran'])
        ->join('siswa','penempatan_siswa.nisn','=','siswa.nisn')
        ->join('kelas','penempatan_siswa.id_kelas','=','kelas.id_kelas')
        ->join('tahun_ajaran','penempatan_siswa.id_tahun_ajaran','=','tahun_ajaran.id_tahun_ajaran')
        ->whereIn('kelas.id_kelas',$data_mapel_kelas->pluck('id_kelas'))
        ->get();

        $data_nilai = Nilai::select('nilai_master.*', 'siswa.nama AS nama_siswa', 'mata_pelajaran.nama AS nama_mapel', 'kelas.kelas', 'tahun_ajaran.tahun_ajaran')
        ->join('siswa', 'nilai_master.nisn', '=', 'siswa.nisn')
        ->join('mata_pelajaran', 'nilai_master.id_mapel', '=', 'mata_pelajaran.id_mapel')
        ->join('tahun_ajaran', 'nilai_master.id_tahun_ajaran', '=', 'tahun_ajaran.id_tahun_ajaran')
        ->join('kelas', 'nilai_master.id_kelas', '=', 'kelas.id_kelas')
        ->where('NIP',$data_guru->nip)
        ->get();


        return view('Guru.Nilai.index',['data_penempatan_siswa'=>$data_penempatan_siswa,
        'data_nilai'=>$data_nilai,
        'is_wali_kelas'=>$is_wali_kelas]);

    }


    public function createDataNilaiSiswa(PenempatanSiswa $penempatansiswa)
    {
        $email_pengguna=Auth::user()->email;
        $data_guru=Guru::where('email','=',$email_pengguna)->first();

        $data_mapel_diampu=DataMapelGuru::select('mata_pelajaran_guru.*','guru.nama','mata_pelajaran.nama')
        ->with('matapelajaran','guru')
        ->join('guru','guru.nip','=','mata_pelajaran_guru.nip')
        ->join('mata_pelajaran','mata_pelajaran.id_mapel','=','mata_pelajaran_guru.id_mapel')
        ->where('mata_pelajaran_guru.nip','=',$data_guru->nip)
        ->get();

        $data_siswa=Siswa::where('nisn','=',$penempatansiswa->nisn)->first();

        $data_kelas=Kelas::where('id_kelas','=',$penempatansiswa->id_kelas)->first();

        $data_tahun_ajaran_aktif=TahunAjaranAktif::where('id_tahun_ajaran_aktif','=',1)->first();

        $is_wali_kelas=WaliKelas::where('nip','=',$data_guru->nip)
        ->where('id_tahun_ajaran','=',$data_tahun_ajaran_aktif->id_tahun_ajaran)
        ->first();

        return view('Guru.Nilai.tambah',[
        'data_penempatan_siswa'=>$penempatansiswa,
        'data_mapel'=>$data_mapel_diampu,
        'data_siswa'=>$data_siswa,
        'data_kelas'=>$data_kelas,
        'is_wali_kelas'=>$is_wali_kelas]);
    }


    public function storeDataNilaiSiswa(PenempatanSiswa $penempatansiswa,NilaiSiswaRequest $request)
    {

        $data_nilai=$request->all();

        $email_pengguna=Auth::user()->email;
        $data_guru=Guru::where('email','=',$email_pengguna)->first();

        $data_tahun_ajaran_aktif=TahunAjaranAktif::first();

        $data_nilai['nip']=$data_guru->nip;
        $data_nilai['nisn']=$penempatansiswa->nisn;
        $data_nilai['id_kelas']=$penempatansiswa->id_kelas;
        $data_nilai['id_tahun_ajaran']=$data_tahun_ajaran_aktif->id_tahun_ajaran;
        $data_nilai['semester']=$data_tahun_ajaran_aktif->semester;

        $conditions=[
            ['nip',$data_nilai['nip']],
            ['nisn',$data_nilai['nisn']],
            ['id_mapel',$data_nilai['id_mapel']],
            ['id_kelas',$data_nilai['id_kelas']],
            ['id_tahun_ajaran',$data_nilai['id_tahun_ajaran']],
            ['semester',$data_nilai['semester']]
        ];

        $check_data=Nilai::where($conditions)->first();

        if($check_data)
        {
            return redirect()->back()->with('error','Nilai Sudah Ditambahkan untuk Siswa, MataPelajaran, Tahun Ajaran, Dan Kelas Ini.');
        }

        else
        {
            Nilai::create($data_nilai);
            return redirect()->route('index_data_nilai_siswa')->with('success','Nilai Berhasil Ditambahkan Untuk Siswa Ini.');
        }
    }

    public function editDataNilaiSiswa(Nilai $nilai)
    {

        $data_mapel=MataPelajaran::where('id_mapel',$nilai->id_mapel)->first();

        $data_siswa=Siswa::where('nisn',$nilai->NISN)->first();

        $data_kelas=Kelas::where('id_kelas',$nilai->id_kelas)->first();

        $data_tahun_ajaran_aktif=TahunAjaranAktif::where('id_tahun_ajaran_aktif','=',1)->first();

        $email_pengguna=Auth::user()->email;
        $data_guru=Guru::where('email','=',$email_pengguna)->first();

        $is_wali_kelas=WaliKelas::where('nip','=',$data_guru->nip)
        ->where('id_tahun_ajaran','=',$data_tahun_ajaran_aktif->id_tahun_ajaran)
        ->first();

        return view('Guru.Nilai.edit',['data_mapel'=>$data_mapel,
        'data_nilai'=>$nilai,'data_siswa'=>$data_siswa,
        'data_kelas'=>$data_kelas,
        'is_wali_kelas'=>$is_wali_kelas
        ]);

    }

    public function updateDataNilaiSiswa(Nilai $nilai, NilaiSiswaRequest $request)
    {
        $data_nilai=$request->except(['_token','_method']);

        $data_nilai['nip']=$nilai->NIP;
        $data_nilai['nisn']=$nilai->NISN;
        $data_nilai['id_kelas']=$nilai->id_kelas;
        $data_nilai['id_tahun_ajaran']=$nilai->id_tahun_ajaran;

        Nilai::where('id_nilai_master',$nilai->id_nilai_master)->update($data_nilai);

        return redirect()->route('index_data_nilai_siswa')->with('success','Sukses Mengubah Nilai Siswa');

    }

    public function destroyDataNilaiSiswa(Nilai $nilai)
    {
        Nilai::where('id_nilai_master',$nilai->id_nilai_master)->delete();

        return redirect()->route('index_data_nilai_siswa')->with('success','Sukses menghapus data nilai siswa');
    }

    
}
