<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Alfa6661\AutoNumber\AutoNumberTrait;

class Kelas extends Model
{
    use HasFactory, AutoNumberTrait;


    public function getAutoNumberOptions()
    {
        return [
            'id_kelas' => [
                'format' => 'KLS-?', // autonumber format. '?' will be replaced with the generated number.
                'length' => 5 // The number of digits in an autonumber
            ]
        ];
    }

    protected $primaryKey = 'id_kelas';

    protected $table='kelas';

    public $incrementing=false;

    protected $guarded=[];

    public function penempatan()
    {
        return $this->hasMany(PenempatanSiswa::class,'id_kelas');
    }
}
