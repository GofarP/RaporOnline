<?php

namespace App\Models;

use App\Models\DataMapelGuru;
use Illuminate\Database\Eloquent\Model;
use Alfa6661\AutoNumber\AutoNumberTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class MataPelajaran extends Model
{
    use HasFactory, AutoNumberTrait;


    public function getAutoNumberOptions()
    {
        return [
            'id_mapel' => [
                'format' => 'MAPEL-?', // autonumber format. '?' will be replaced with the generated number.
                'length' => 5 // The number of digits in an autonumber
            ]
        ];
    }

    protected $primaryKey = 'id_mapel';

    public $incrementing=false;

    protected $table='mata_pelajaran';

    protected $guarded=[];


    public function matapelajaranguru()
    {
        return $this->hasMany(DataMapelGuru::class,'id_mapel_guru');
    }


    public function nilai()
    {
        return $this->hasMany(Nilai::class,'id_mapel');
    }
}
