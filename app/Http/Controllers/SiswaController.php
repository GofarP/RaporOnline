<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\Siswa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $email_pengguna=Auth::user()->email;

        $data_siswa=Siswa::where('email','=',$email_pengguna)->first();

        $data_nilai = Nilai::select('nilai_master.*', 'guru.nama AS nama_guru', 'mata_pelajaran.nama AS nama_mapel', 'kelas.kelas', 'tahun_ajaran.tahun_ajaran')
        ->join('guru', 'nilai_master.nip', '=', 'guru.nip')
        ->join('mata_pelajaran', 'nilai_master.id_mapel', '=', 'mata_pelajaran.id_mapel')
        ->join('tahun_ajaran', 'nilai_master.id_tahun_ajaran', '=', 'tahun_ajaran.id_tahun_ajaran')
        ->join('kelas', 'nilai_master.id_kelas', '=', 'kelas.id_kelas')
        ->where('nilai_master.nisn',$data_siswa->nisn)
        ->get();

        return view('siswa.index',['data_siswa'=>$data_siswa,"data_nilai"=>$data_nilai]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function show(Siswa $siswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function edit(Siswa $siswa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Siswa $siswa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Siswa $siswa)
    {
        //
    }
}
