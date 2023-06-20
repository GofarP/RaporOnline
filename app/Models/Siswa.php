<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $primaryKey = 'nisn';

    protected $table='siswa';

    public $incrementing=false;

    protected $guarded=[];

    public function getAutoNumberOptions()
    {
         return [
             'id_tahun_ajaran' => [
                 'format' => 'NLI-?', // autonumber format. '?' will be replaced with the generated number.
                 'length' => 5 // The number of digits in an autonumber
             ]
         ];
    }

    public function penempatan()
    {
        return $this->hasMany(PenempatanSiswa::class,'nisn');
    }

    public function nilai()
    {
        return $this->hasMany(Nilai::class,'nisn');
    }

}
