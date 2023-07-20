<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\WaliKelas;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use App\Models\PenempatanSiswa;
use App\Models\TahunAjaranAktif;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;

class WaliKelasController extends Controller
{
    public function indexWaliKelas()
    {

        $data_guru = Guru::where('email', '=', Auth::user()->email)->first();

        $data_wali_kelas = WaliKelas::where('nip', '=', $data_guru['nip'])->first();

        $data_tahun_ajaran_aktif = TahunAjaranAktif::with('tahunajaran')->where('id_tahun_ajaran_aktif', '=', 1)->first();

        $is_wali_kelas = WaliKelas::where('nip', '=', $data_guru->nip)
            ->where('id_tahun_ajaran', '=', $data_tahun_ajaran_aktif->id_tahun_ajaran)
            ->first();

        $data_murid_kelas = PenempatanSiswa::select('siswa.nisn', 'siswa.nama', 'kelas.kelas', 'tahun_ajaran.tahun_ajaran')
            ->where('penempatan_siswa.id_kelas', '=', $data_wali_kelas['id_kelas'])
            ->join('siswa', 'penempatan_siswa.nisn', '=', 'siswa.nisn')
            ->join('tahun_ajaran', 'penempatan_siswa.id_tahun_ajaran', '=', 'tahun_ajaran.id_tahun_ajaran')
            ->join('kelas', 'penempatan_siswa.id_kelas', '=', 'kelas.id_kelas')
            ->get();

        $data_nilai = Nilai::select('siswa.nisn', 'siswa.nama as nama', 'kelas.kelas as kelas', 'nilai')
            ->join('siswa', 'siswa.nisn', '=', 'nilai_master.NISN')
            ->join('kelas', 'kelas.id_kelas', 'nilai_master.id_kelas')
            ->where('nilai_master.id_kelas', '=', $data_wali_kelas['id_kelas'])
            ->where('id_tahun_ajaran', '=', $data_tahun_ajaran_aktif->id_tahun_ajaran)
            ->where('semester', '=', $data_tahun_ajaran_aktif->semester)
            ->get();

        $data_ranking = array();

        $arrayData = json_decode($data_nilai, true);


        foreach ($arrayData as $data) {
            $nisn = $data['nisn'];
            $nilai = $data['nilai'];
            $nama = $data['nama'];
            $kelas = $data['kelas'];
            $tahun_ajaran = $data_tahun_ajaran_aktif->tahunajaran->tahun_ajaran;

            if (count($data_ranking) <= 2) {
                if (isset($data_ranking[$nisn])) {
                    $data_ranking[$nisn]['nilai'] += $nilai;
                } else {
                    $data_ranking[$nisn] = [
                        'NISN' => $nisn,
                        'nilai' => $nilai,
                        'nama' => $nama,
                        'kelas' => $kelas,
                        'tahunajaran' => $tahun_ajaran
                    ];
                }
            } else {
                break;
            }
        }

        $data_ranking = array_values($data_ranking);

        usort($data_ranking, function ($a, $b) {
            return $b['nilai'] - $a['nilai'];
        });

        $ranking = 1;
        $index = 0;

        foreach ($data_ranking as $data) {

            $data_ranking[$index]["ranking"] = $ranking;

            $ranking++;
            $index++;
        }

        return view('Guru.WaliKelas.index', [
            'data_murid_kelas' => $data_murid_kelas,
            'is_wali_kelas' => $is_wali_kelas,
            'data_ranking' => $data_ranking
        ]);
    }



    public function cetakRapor($nisn)
    {
        $data_siswa = PenempatanSiswa::where('penempatan_siswa.nisn', '=', $nisn)
            ->join('siswa', 'penempatan_siswa.nisn', '=', 'siswa.nisn')
            ->join('kelas', 'penempatan_siswa.id_kelas', '=', 'kelas.id_kelas')
            ->first();

        $data_tahun_ajaran = TahunAjaranAktif::join('tahun_ajaran', 'tahun_ajaran.id_tahun_ajaran', '=', 'tahun_ajaran_aktif.id_tahun_ajaran')
            ->first();

        $data_nilai = Nilai::where('nisn', '=', $nisn)
            ->where('id_tahun_ajaran', '=', $data_tahun_ajaran['id_tahun_ajaran'])
            ->where('id_kelas', '=', $data_siswa['id_kelas'])
            ->where('semester', '=', $data_tahun_ajaran['semester'])
            ->join('mata_pelajaran', 'mata_pelajaran.id_mapel', '=', 'nilai_master.id_mapel')
            ->get();

        return view('Guru.WaliKelas.Rapor.rapor', ['data_siswa' => $data_siswa, 'data_tahun_ajaran' => $data_tahun_ajaran, 'data_nilai' => $data_nilai]);
    }


    // public function cetakSertifikat(Request $request)
    // {

    //     $nisn = $request->nisn;
    //     $nama = $request->nama;
    //     $kelas = $request->kelas;
    //     $tahunAjaran = $request->tahunAjaran;
    //     $ranking = $request->ranking;

    //     $data_ranking=array();

    //     $data_ranking["nisn"]=$nisn;
    //     $data_ranking["nama"]=$nama;
    //     $data_ranking['kelas']=$kelas;
    //     $data_ranking['tahun_ajaran']=$tahunAjaran;
    //     $data_ranking['ranking']=$ranking;

    //     // Lakukan operasi atau aksi yang diperlukan dengan data yang diterima dari JavaScript

    //     return $data_ranking['nisn'];
    // }

    public function cetakSertifikat($nisn,$ranking)
    {

        $data_ranking=array();


        $data_siswa=PenempatanSiswa::join('siswa','siswa.nisn','=','penempatan_siswa.nisn')
        ->join('kelas','kelas.id_kelas','=','penempatan_siswa.id_kelas')
        ->where('penempatan_siswa.nisn','=',$nisn)
        ->first();

        $data_wali_kelas=Guru::where('email','=',Auth::user()->email)->first();

        $data_tahun_ajaran_aktif = TahunAjaranAktif::with('tahunajaran')->where('id_tahun_ajaran_aktif', '=', 1)->first();

        $data_ranking["nisn"]=$nisn;
        $data_ranking["nama"]=$data_siswa->nama;
        $data_ranking['kelas']=$data_siswa->kelas;
        $data_ranking['tahun_ajaran']=$data_tahun_ajaran_aktif->tahunajaran->tahun_ajaran;
        $data_ranking['ranking']=$ranking;
        $data_ranking['wali_kelas']=$data_wali_kelas->nama;

        return view('Guru.WaliKelas.Sertifikat.sertifikat', [
            'data_ranking' => $data_ranking
        ]);

    }

}
