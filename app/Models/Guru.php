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
}
