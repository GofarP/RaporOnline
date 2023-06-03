<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Alfa6661\AutoNumber\AutoNumberTrait;


class PenempatanSiswa extends Model
{
    use HasFactory, AutoNumberTrait;


    public function getAutoNumberOptions()
    {
        return [
            'id_data' => [
                'format' => 'PNMPT-?', // autonumber format. '?' will be replaced with the generated number.
                'length' => 5 // The number of digits in an autonumber
            ]
        ];
    }

    protected $primaryKey = 'id_penempatan_siswa';
    protected $table='penempatan_siswa';
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

    public function tahunajaran()
    {
        return $this->hasOne(TahunAjaran::class,'id_tahun_ajaran');
    }


}
