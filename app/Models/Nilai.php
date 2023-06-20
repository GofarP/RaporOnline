<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Alfa6661\AutoNumber\AutoNumber;
use Alfa6661\AutoNumber\AutoNumberTrait;

class Nilai extends Model
{
    use HasFactory, AutoNumberTrait;

    public function getAutoNumberOptions()
    {
        return [
            'id_nilai_master' => [
                'format' => 'NLI-?', // autonumber format. '?' will be replaced with the generated number.
                'length' => 5 // The number of digits in an autonumber
            ]
        ];
    }

    protected $primaryKey = 'id_nilai_master';
    protected $table='nilai_master';
    public $incrementing=false;
    protected $guarded=[];


    public function kelas()
    {
        return $this->hasOne(Kelas::class,'id_kelas');
    }

    public function siswa()
    {
        return $this->hasOne(Siswa::class,'nisn');
    }

    public function mapel()
    {
        return $this->hasOne(MataPelajaran::class,'id_mapel');
    }

    public function tahunajaran()
    {
        return $this->hasOne(Tahunajaran::class,'id_tahun_ajaran');
    }


}
