<?php

namespace App\Models;

use App\Models\PenempatanSiswa;
use App\Models\TahunAjaranAktif;
use Illuminate\Database\Eloquent\Model;
use Alfa6661\AutoNumber\AutoNumberTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TahunAjaran extends Model
{
    use HasFactory, AutoNumberTrait;

    public function getAutoNumberOptions()
    {
         return [
             'id_tahun_ajaran' => [
                 'format' => 'TA-?', // autonumber format. '?' will be replaced with the generated number.
                 'length' => 5 // The number of digits in an autonumber
             ]
         ];
    }

    protected $primaryKey = 'id_tahun_ajaran';

    public $incrementing = false;

    protected $table='tahun_ajaran';

    protected $guarded=[];

    public function penempatan()
    {
        return $this->hasMany(PenempatanSiswa::class,'id_tahun_ajaran');
    }

    public function tahunajaranaktif()
    {
        return $this->hasMany(TahunAjaranAktif::class,'id_tahun_ajaran_aktif');
    }

    public function nilai()
    {
        return $this->hasMany(Nilai::class,'id_tahun_ajaran');
    }

    public function walikelas()
    {
        return $this->hasMany(walikelas::class,'id_wali_kelas');
    }

    public function aturmatapelajaran()
    {
        return $this->hasMany(AturMataPelajaran::class,'id_atur_mata_pelajaran');
    }


}
