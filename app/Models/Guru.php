<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;

    protected $primaryKey = 'nip';

    public $incrementing=false;

    protected $table='guru';

    protected $guarded=[];

    public function matapelajaranguru()
    {
        return $this->hasMany(DataMapelGuru::class,'id_mapel_guru');
    }

    public function walikelas()
    {
        return $this->hasMany(walikelas::class,'id_wali_kelas');
    }



}
