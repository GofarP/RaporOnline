<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\LogOutController;
use App\Http\Controllers\SiswaController;

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

Route::group(['prefix' => 'admin', 'middleware' => ['checkRole:Admin']], function(){
    Route::get('home',[HomeController::class, 'index'])->name('admin_home');

    Route::get('dataguru',[AdminController::class,'indexDataGuru'])->name('index_data_guru');
    Route::get('tambahdataguru',[AdminController::class,'createDataGuru'])->name('create_data_guru');
    Route::post('storedataguru',[AdminController::class,'storeDataGuru'])->name('store_data_guru');
    Route::get('editdataguru/{guru}',[AdminController::class,'editDataGuru'])->name('edit_data_guru');

    Route::get('kredensialguru',[AdminController::class,'indexKredensialGuru'])->name('index_kredensial_guru');
    Route::get('tambahkredensialguru',[AdminController::class,'createKredensialGuru'])->name('create_kredensial_guru');
    Route::post('simpankredensialguru',[AdminController::class,'storeKredensialGuru'])->name('store_kredensial_guru');
    Route::get('editkredensialguru/{user}',[AdminController::class,'editKredensialGuru'])->name('edit_kredensial_guru');
    Route::put('updatekredensialguru/{user}',[AdminController::class,'updateKredensialGuru'])->name('update_kredensial_guru');
    Route::delete('destroykredensialguru/{user}',[AdminController::class,'destroyKredensialGuru'])->name('destroy_kredensial_guru');


    Route::get('kredensialsiswa',[AdminController::class,'indexKredensialSiswa'])->name('index_kredensial_siswa');
    Route::get('tambahkredensialsiswa',[AdminController::class,'createKredensialSiswa'])->name('create_kredensial_siswa');
    Route::post('simpankredensialsiswa',[AdminController::class,'storeKredensialSiswa'])->name('store_kredensial_siswa');
    Route::get('editkredensialsiswa/{user}',[AdminController::class,'editKredensialSiswa'])->name('edit_kredensial_siswa');
    Route::put('updatekredensialsiswa/{user}',[AdminController::class,'updateKredensialSiswa'])->name('update_kredensial_siswa');
    Route::delete('destroykredensialsiswa/{user}',[AdminController::class,'destroyKredensialSiswa'])->name('destroy_kredensial_siswa');


    Route::get('datasiswa',[AdminController::class,'indexDataSiswa'])->name('index_data_siswa');
    Route::get('tambahdatasiswa',[AdminController::class,'createDataSiswa'])->name('create_data_siswa');
    Route::post('storedatasiswa',[AdminController::class,'storeDataSiswa'])->name('store_data_siswa');
    Route::get('editdatasiswa/{siswa}',[AdminController::class,'editDataSiswa'])->name('edit_data_siswa');
    Route::delete('destroydatasiswa/{siswa}',[AdminController::class,'destroyDataSiswa'])->name('destroy_data_siswa');


    Route::get('datamatapelajaran',[AdminController::class,'indexdataMataPelajaran'])->name('index_data_mata_pelajaran');
    Route::get('tambahdatamatapelajaran',[AdminController::class,'createDataMataPelajaran'])->name('create_data_mata_pelajaran');
    Route::post('storedatamatapelajaran',[AdminController::class,'storedataMataPelajaran'])->name('store_data_mata_pelajaran');
    Route::get('editdatamatapelajaran/{matapelajaran}',[AdminController::class,'editDataMataPelajaran'])->name('edit_data_mata_pelajaran');
    Route::put('updatedatamatapelajaran/{matapelajaran}',[AdminController::class,'updateDataMataPelajaran'])->name('update_data_mata_pelajaran');
    Route::delete('deletedatamatapelajaran/{matapelajaran}',[AdminController::class,'destroyDataMataPelajaran'])->name('destroy_data_mata_pelajaran');

    Route::get('datatahunajaran',[AdminController::class,'indexDataTahunAjaran'])->name('index_data_tahun_ajaran');
    Route::get('tambahdatatahunajaran',[AdminController::class,'createDataTahunAjaran'])->name('create_data_tahun_ajaran');
    Route::post('storedatatahunajaran',[AdminController::class,'storeDataTahunAjaran'])->name('store_data_tahun_ajaran');
    Route::get('editdatatahunajaran/{tahunajaran}',[AdminController::class,'editDatatahunAjaran'])->name('edit_data_tahun_ajaran');
    Route::put('updatedatatahunajaran/{tahunajaran}',[AdminController::class,'updateDatatahunAjaran'])->name('update_data_tahun_ajaran');
    Route::delete('deletedatatahunajaran/{tahunajaran}',[AdminController::class,'destroyDataTahunAjaran'])->name('destroy_data_tahun_ajaran');

    
    Route::get('datakelas',[AdminController::class,'indexKelas'])->name('index_data_kelas');
    Route::get('tambahdatakelas',[AdminController::class,'createDataKelas'])->name('create_data_kelas');
    Route::post('storedatakelas',[AdminController::class,'storeDataKelas'])->name('store_data_kelas');
    Route::get('editdatakelas/{kelas}',[AdminController::class,'editDataKelas'])->name('edit_data_kelas');
    Route::put('updatedatakelas/{kelas}',[AdminController::class,'updateDataKelas'])->name('update_data_kelas');
    Route::delete('deletedatakelas/{kelas}',[AdminController::class,'deleteDataKelas'])->name('destroy_data_kelas');


    Route::get('datanilaisiswa',[AdminController::class,'indexDataNilaiSiswa'])->name('index_data_nilai_siswa');
    Route::get('tambahdatanilaisiswa',[AdminController::class,'createDataNilaiSiswa'])->name('create_data_nilai_siswa');
    Route::get('editdatanilaisiswa',[AdminController::class,'editDataNilaiSiswa'])->name('edit_data_nilai_siswa');

    Route::post('logout',[LogOutController::class,'logout'])->name('logout');



});


Route::group(['prefix' => 'guru', 'middleware' => ['checkRole:Guru']],function(){
    Route::get('home',[GuruController::class, 'index'])->name('guru_home');
});


Route::group(['prefix'=>'siswa', 'middleware' => ['checkRole:Siswa']],function(){
    Route::get('home',[SiswaController::class, 'index'])->name('siswa_home');
});
