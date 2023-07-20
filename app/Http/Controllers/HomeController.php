<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\MataPelajaran;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data_jumlah_guru=Guru::count();
        $data_jumlah_siswa=Siswa::count();
        $data_jumlah_mapel=MataPelajaran::count();

        return view('admin.index.index',['data_jumlah_guru'=>$data_jumlah_guru,
        'data_jumlah_siswa'=>$data_jumlah_siswa,
        'data_jumlah_mapel'=>$data_jumlah_mapel
        ]);
    }


}
