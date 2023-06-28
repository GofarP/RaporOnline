<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Alfa6661\AutoNumber\AutoNumberTrait;


class AturMataPelajaran extends Model
{
    use HasFactory,AutoNumberTrait;

    public function getAutoNumberOptions()
    {
        return [
            'id_atur_mata_pelajaran' => [
                'format' => 'MP-?', // autonumber format. '?' will be replaced with the generated number.
                'length' => 5 // The number of digits in an autonumber
            ]
        ];
    }

    protected $primaryKey = 'id_atur_mata_pelajaran';

    public $incrementing=false;

    protected $table='atur_mata_pelajaran';

    protected $guarded=[];


    public function matapelajaran()
    {
        return $this->hasOne(MataPelajaran::class, 'id_mapel');
    }

    public function kelas()
    {
        return $this->hasOne(Kelas::class, 'id_kelas');
    }


}
