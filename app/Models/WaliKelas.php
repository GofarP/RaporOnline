<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Alfa6661\AutoNumber\AutoNumberTrait;

class WaliKelas extends Model
{
    use HasFactory, AutoNumberTrait;

    public function getAutoNumberOptions()
    {
         return [
             'id_wali_kelas' => [
                 'format' => 'WK-?', // autonumber format. '?' will be replaced with the generated number.
                 'length' => 5 // The number of digits in an autonumber
             ]
         ];
    }

    protected $primaryKey = 'id_wali_kelas';

    public $incrementing = false;

    protected $table='wali_kelas';

    protected $guarded=[];

    public $timestamps = false;


    public function guru()
    {
        return $this->belongsTo(Guru::class,'nip');
    }

    public function tahunajaran()
    {
        return $this->belongsTo(TahunAjaran::class,'id_tahun_ajaran');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class,'id_kelas');
    }


}
