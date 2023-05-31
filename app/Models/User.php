<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Alfa6661\AutoNumber\AutoNumberTrait;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, AutoNumberTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     *
     */

     public function getAutoNumberOptions()
     {
         return [
             'id_users' => [
                 'format' => 'ID-?', // autonumber format. '?' will be replaced with the generated number.
                 'length' => 5 // The number of digits in an autonumber
             ]
         ];
     }

    protected $primaryKey = 'id_users';

    public $incrementing = false;

    protected $fillable = [
        'id_users',
        'name',
        'email',
        'role',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



}
