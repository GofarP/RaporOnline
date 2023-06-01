<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Alfa6661\AutoNumber\AutoNumberTrait;

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
}
