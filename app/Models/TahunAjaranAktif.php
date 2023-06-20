<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahunAjaranAktif extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_tahun_ajaran_aktif';

    protected $table='tahun_ajaran_aktif';

    protected $guarded=[];

    public function tahunajaran()
    {
        return $this->belongsTo(TahunAjaran::class,'id_tahun_ajaran');
    }

}
