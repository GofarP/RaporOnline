<?php

namespace App\Models;

use App\Models\Guru;
use App\Models\MataPelajaran;
use Illuminate\Database\Eloquent\Model;
use Alfa6661\AutoNumber\AutoNumberTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class DataMapelGuru extends Model
{
    use HasFactory,AutoNumberTrait;

    public function getAutoNumberOptions()
    {
        return [
            'id_mapel_guru' => [
                'format' => 'IMG-?', // autonumber format. '?' will be replaced with the generated number.
                'length' => 5 // The number of digits in an autonumber
            ]
        ];
    }

    protected $primaryKey = 'id_mapel_guru';

    public $incrementing=false;

    protected $table='mata_pelajaran_guru';

    protected $guarded=[];

    public function matapelajaran()
    {
        return $this->hasOne(MataPelajaran::class,'id_mapel');
    }

    public function guru()
    {
        return $this->hasOne(Guru::class,'nip');
    }

}
