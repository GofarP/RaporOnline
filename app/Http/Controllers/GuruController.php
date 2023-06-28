<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\WaliKelas;
use Illuminate\Http\Request;
use App\Models\DataMapelGuru;
use App\Models\PenempatanSiswa;
use App\Models\TahunAjaranAktif;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {


        $email_pengguna=Auth::user()->email;
        $data_guru=Guru::where('email','=',$email_pengguna)->first();

        $data_tahun_ajaran_aktif=TahunAjaranAktif::where('id_tahun_ajaran_aktif','=',1)->first();

        $data_mapel_diampu=DataMapelGuru::select('mata_pelajaran_guru.*','guru.nama','mata_pelajaran.nama')
        ->with('matapelajaran','guru')
        ->join('guru','guru.nip','=','mata_pelajaran_guru.nip')
        ->join('mata_pelajaran','mata_pelajaran.id_mapel','=','mata_pelajaran_guru.id_mapel')
        ->where('mata_pelajaran_guru.nip','=',$data_guru->nip)
        ->get();

        $data_guru=Guru::where('email','=',$email_pengguna)->first();

        $is_wali_kelas=WaliKelas::where('nip','=',$data_guru->nip)
                                ->where('id_tahun_ajaran','=',$data_tahun_ajaran_aktif->id_tahun_ajaran)
                                ->first();

        return view('guru.index',['data_mapel_diampu'=>$data_mapel_diampu,'data_guru'=>$data_guru,'is_wali_kelas'=>$is_wali_kelas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return "Hello";
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
     * @param  \App\Models\Guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function show(Guru $guru)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function edit(Guru $guru)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Guru $guru)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function destroy(Guru $guru)
    {
        //
    }
}
