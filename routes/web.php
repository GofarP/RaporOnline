<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\LogOutController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\WaliKelasController;
use App\Models\Nilai;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Route::group(['middleware' => ['auth', 'role:Admin'], 'prefix' => 'admin'], function(){

    Route::get('/home',[HomeController::class, 'index'])->name('admin_home');

    Route::get('guru/dataguru',[AdminController::class,'indexDataGuru'])->name('index_data_guru');
    Route::get('guru/tambahdataguru',[AdminController::class,'createDataGuru'])->name('create_data_guru');
    Route::post('guru/storedataguru',[AdminController::class,'storeDataGuru'])->name('store_data_guru');
    Route::get('guru/editdataguru/{guru}',[AdminController::class,'editDataGuru'])->name('edit_data_guru');
    Route::put('guru/updatedataguru/{guru}',[AdminController::class,'updateDataGuru'])->name('update_data_guru');
    Route::delete('guru/destroydataguru/{guru}',[AdminController::class,'destroyDataGuru'])->name('destroy_data_guru');


    Route::get('kredensialguru/kredensialguru',[AdminController::class,'indexKredensialGuru'])->name('index_kredensial_guru');
    Route::get('kredensiaguru/tambahkredensialguru',[AdminController::class,'createKredensialGuru'])->name('create_kredensial_guru');
    Route::post('kredensialguru/simpankredensialguru',[AdminController::class,'storeKredensialGuru'])->name('store_kredensial_guru');
    Route::get('kredensialguru/editkredensialguru/{user}',[AdminController::class,'editKredensialGuru'])->name('edit_kredensial_guru');
    Route::put('kredensialguru/updatekredensialguru/{user}',[AdminController::class,'updateKredensialGuru'])->name('update_kredensial_guru');
    Route::delete('kredensialguru/destroykredensialguru/{user}',[AdminController::class,'destroyKredensialGuru'])->name('destroy_kredensial_guru');


    Route::get('kredensialsiswa/kredensialsiswa',[AdminController::class,'indexKredensialSiswa'])->name('index_kredensial_siswa');
    Route::get('kredensialsiswa/tambahkredensialsiswa',[AdminController::class,'createKredensialSiswa'])->name('create_kredensial_siswa');
    Route::post('kredensialsiswa/simpankredensialsiswa',[AdminController::class,'storeKredensialSiswa'])->name('store_kredensial_siswa');
    Route::get('kredensialsiswa/editkredensialsiswa/{user}',[AdminController::class,'editKredensialSiswa'])->name('edit_kredensial_siswa');
    Route::put('kredensialsiswa/updatekredensialsiswa/{user}',[AdminController::class,'updateKredensialSiswa'])->name('update_kredensial_siswa');
    Route::delete('kredensialsiswa/destroykredensialsiswa/{user}',[AdminController::class,'destroyKredensialSiswa'])->name('destroy_kredensial_siswa');


    Route::get('siswa/datasiswa',[AdminController::class,'indexDataSiswa'])->name('index_data_siswa');
    Route::get('siswa/tambahdatasiswa',[AdminController::class,'createDataSiswa'])->name('create_data_siswa');
    Route::post('siswa/storedatasiswa',[AdminController::class,'storeDataSiswa'])->name('store_data_siswa');
    Route::get('siswa/editdatasiswa/{siswa}',[AdminController::class,'editDataSiswa'])->name('edit_data_siswa');
    Route::put('siswa/updatedatasiswa/{siswa}',[AdminController::class,'updateDataSiswa'])->name('update_data_siswa');
    Route::delete('siswa/destroydatasiswa/{siswa}',[AdminController::class,'destroyDataSiswa'])->name('destroy_data_siswa');


    Route::get('matapelajaran/datamatapelajaran',[AdminController::class,'indexdataMataPelajaran'])->name('index_data_mata_pelajaran');
    Route::get('matapelajaran/tambahdatamatapelajaran',[AdminController::class,'createDataMataPelajaran'])->name('create_data_mata_pelajaran');
    Route::post('matapelajaran/storedatamatapelajaran',[AdminController::class,'storedataMataPelajaran'])->name('store_data_mata_pelajaran');
    Route::get('matapelajaran/editdatamatapelajaran/{matapelajaran}',[AdminController::class,'editDataMataPelajaran'])->name('edit_data_mata_pelajaran');
    Route::put('matapelajaran/updatedatamatapelajaran/{matapelajaran}',[AdminController::class,'updateDataMataPelajaran'])->name('update_data_mata_pelajaran');
    Route::delete('matapelajaran/deletedatamatapelajaran/{matapelajaran}',[AdminController::class,'destroyDataMataPelajaran'])->name('destroy_data_mata_pelajaran');

    Route::get('matapelajaran/aturmatapelajaran',[AdminController::class,'indexAturMataPelajaran'])->name('index_atur_mata_pelajaran');
    Route::get('matapelajaran/createaturmatapelajaran/{matapelajaran}',[AdminController::class,'createAturMataPelajaran'])->name('create_atur_mata_pelajaran');
    Route::post('matapelajaran/storeaturmatapelajaran',[AdminController::class,'storeAturMataPelajaran'])->name('store_atur_mata_pelajaran');
    Route::get('matapelajaran/editaturmatapelajaran/{aturmatapelajaran}',[AdminController::class,'editAturMataPelajaran'])->name('edit_atur_mata_pelajaran');
    Route::put('matapelajaran/updateaturmatapelajaran/{matapelajaran}',[AdminController::class,'updateAturMataPelajaran'])->name('update_atur_mata_pelajaran');
    Route::delete('matapelajaran/destroyaturmatapelajaran/{matapelajaran}',[AdminController::class,'destroyAturMataPelajaran'])->name('destroy_atur_mata_pelajaran');


    Route::get('tahunajaran/datatahunajaran',[AdminController::class,'indexDataTahunAjaran'])->name('index_data_tahun_ajaran');
    Route::get('tahunajaran/tambahdatatahunajaran',[AdminController::class,'createDataTahunAjaran'])->name('create_data_tahun_ajaran');
    Route::post('tahunajaran/storedatatahunajaran',[AdminController::class,'storeDataTahunAjaran'])->name('store_data_tahun_ajaran');
    Route::get('tahunajaran/editdatatahunajaran/{tahunajaran}',[AdminController::class,'editDatatahunAjaran'])->name('edit_data_tahun_ajaran');
    Route::put('tahunajaran/updatedatatahunajaran/{tahunajaran}',[AdminController::class,'updateDatatahunAjaran'])->name('update_data_tahun_ajaran');
    Route::delete('tahunajaran/deletedatatahunajaran/{tahunajaran}',[AdminController::class,'destroyDataTahunAjaran'])->name('destroy_data_tahun_ajaran');

    Route::get('tahunajaran/showtahunajaran',[AdminController::class,'showTahunAjaran'])->name('show_tahun_ajaran');
    Route::post('tahunajaran/settahunajaranaktif',[AdminController::class,'setTahunAjaranAktif'])->name('set_tahun_ajaran_aktif');
    Route::put('tahunajaran/updatetahunajaranaktif/{id}',[AdminController::class,'updatetahunAjaranAktif'])->name('update_tahun_ajaran_aktif');

    Route::get('kelas/datakelas',[AdminController::class,'indexDataKelas'])->name('index_data_kelas');
    Route::get('kelas/tambahdatakelas',[AdminController::class,'createDataKelas'])->name('create_data_kelas');
    Route::post('kelas/storedatakelas',[AdminController::class,'storeDataKelas'])->name('store_data_kelas');
    Route::get('kelas/editdatakelas/{kelas}',[AdminController::class,'editDataKelas'])->name('edit_data_kelas');
    Route::put('kelas/updatedatakelas/{kelas}',[AdminController::class,'updateDataKelas'])->name('update_data_kelas');
    Route::delete('kelas/deletedatakelas/{kelas}',[AdminController::class,'deleteDataKelas'])->name('destroy_data_kelas');


    Route::get('nilaisiswa/datanilaisiswa',[AdminController::class,'indexDataNilaiSiswa'])->name('admin_index_data_nilai_siswa');
    Route::get('nilaisiswa/tambahdatanilaisiswa/{penempatansiswa}',[AdminController::class,'createDataNilaiSiswa'])->name('admin_create_data_nilai_siswa');
    Route::get('nilaisiswa/dataguru/{idmapel}',[AdminController::class,'dataGuru'])->name('dataGuru');
    Route::post('nilaisiswa/storedatanilaisiswa',[AdminController::class,'storeDataNilaiSiswa'])->name('admin_store_data_nilai_siswa');
    Route::get('nilaisiswa/editdatanilaisiswa/{nilai}',[AdminController::class,'editDataNilaiSiswa'])->name('admin_edit_data_nilai_siswa');
    Route::put('nilaisiswa/updatedatanilaisiswa/{nilai}',[AdminController::class,'updatedataNilaiSiswa'])->name('admin_update_data_nilai_siswa');
    Route::delete('nilaisiswa/deletedatanilaisiswa',[AdminController::class,'deleteDataNilaiSiswa'])->name('admin_destroy_data_nilai_siswa');


    Route::get('penempatan/datapenempatansiswa',[AdminController::class,'indexDataPenempatanSiswa'])->name('index_data_penempatan_siswa');
    Route::get('penempatan/tambahdatapenempatansiswa/{siswa}',[AdminController::class,'createDataPenempatanSiswa'])->name('create_data_penempatan_siswa');
    Route::post('penempatan/storedatapenempatansiswa',[AdminController::class,'storeDataPenempatanSiswa'])->name('store_data_penempatan_siswa');
    Route::get('penempatan/editdatapenempatansiswa/{penempatan}',[AdminController::class,'editDataPenempatanSiswa'])->name('edit_data_penempatan_siswa');
    Route::put('penempatan/updatedatapenempatansiswa/{penempatan}',[AdminController::class,'updateDataPenempatanSiswa'])->name('update_data_penempatan_siswa');
    Route::delete('penempatan/deletedatapenempatansiswa/{penempatan}',[AdminController::class,'deleteDataPenempatanSiswa'])->name('destroy_data_penempatan_siswa');

    Route::get('mapelguru/datamapelguru',[AdminController::class,'indexDataMapelGuru'])->name('index_data_mapel_guru');
    Route::get('mapelguru/tambahdatamapelguru/{guru}',[AdminController::class,'createDataMapelGuru'])->name('create_data_mapel_guru');
    Route::post('mapelguru/storedatamapelguru',[AdminController::class,'storeDataMapelGuru'])->name('store_data_mapel_guru');
    Route::get('mapelguru/editdatamapelguru/{mapelguru}',[AdminController::class,'editDataMapelGuru'])->name('edit_data_mapel_guru');
    Route::put('mapelguru/updatedatamapelguru/{mapelguru}',[AdminController::class,'updateDataMapelGuru'])->name('update_data_mapel_guru');
    Route::delete('mapelguru/deletedatamapelguru/{mapelguru}',[AdminController::class,'deleteDataPenempatanSiswa'])->name('destroy_data_mapel_guru');

    Route::get('walikelas/datawalikelas',[AdminController::class,'indexDataWaliKelas'])->name('index_data_wali_kelas');
    Route::get('walikelas/tambahdatawalikelas/{guru}',[AdminController::class,'createDataWaliKelas'])->name('create_data_wali_kelas');
    Route::post('walikelas/storedatawalikelas/',[AdminController::class,'storeDataWaliKelas'])->name('store_data_wali_kelas');
    Route::get('walikelas/editdatawalikelas/{walikelas}',[AdminController::class,'editDataWaliKelas'])->name('edit_data_wali_kelas');
    Route::put('walikelas/updatedatawalikelas/{walikelas}',[AdminController::class,'updateDataWaliKelas'])->name('update_data_wali_kelas');
    Route::delete('walikelas/deletedatawalikelas/{walikelas}',[AdminController::class,'deleteDataWaliKelas'])->name('destroy_data_wali_kelas');

});


Route::group(['middleware' => ['auth', 'role:Guru'],'prefix' => 'guru'],function(){
    Route::get('home',[GuruController::class, 'index'])->name('guru_home');

    Route::get('nilaisiswa/datanilaisiswa',[NilaiController::class,'indexDataNilaiSiswa'])->name('index_data_nilai_siswa');

    Route::get('nilaisiswa/tambahnilaisiswa/{penempatansiswa}',[NilaiController::class,'createDataNilaiSiswa'])->name('guru_create_data_nilai_siswa');

    Route::post('nilaisiswa/storenilaisiswa/{penempatansiswa}',[NilaiController::class,'storeDataNilaiSiswa'])->name('guru_store_data_nilai_siswa');

    Route::get('nilaisisiswa/editnilaisiswa/{nilai}',[NilaiController::class, 'editDataNilaiSiswa'])->name('guru_edit_data_nilai_siswa');

    Route::put('nilaisiswa/updatedatanilaisiswa/{nilai}',[NilaiController::class,'updateDataNilaiSiswa'])->name('guru_update_data_nilai_siswa');

    Route::delete('nilaisiswa/deletenilaisiswa/{nilai}',[NilaiController::class,'destroyDataNilaiSiswa'])->name('guru_destroy_data_nilai_siswa');

    Route::get('walikelas/nilaisiswa/',[WaliKelasController::class,'indexWaliKelas'])->name('index_wali_kelas');

    Route::get('walikelas/sertifikat/{nisn}/{ranking}',[WaliKelasController::class,'cetakSertifikat'])->name('cetak_sertifikat');

    Route::get('walikelas/rapor/{nisn}',[WalikelasController::class,'cetakRapor'])->name('cetak_rapor');


});

Route::group(['middleware' => ['auth', 'role:Siswa'], 'prefix'=>'siswa'],function(){
    Route::get('home',[SiswaController::class, 'index'])->name('siswa_home');
});

Route::post('logout',[LogOutController::class,'logout'])->name('logout');

