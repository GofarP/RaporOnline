<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Alfa6661\AutoNumber\AutoNumberTrait;


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
}
