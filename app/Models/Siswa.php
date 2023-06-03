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

    public function penempatan()
    {
        return $this->hasMany(PenempatanSiswa::class,'nisn');
    }

}
