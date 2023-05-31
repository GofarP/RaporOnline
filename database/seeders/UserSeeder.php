<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        User::create([
            'id_users'=>'0001',
            'name' =>"Admin Master",
            'email' => 'admin@gmail.com',
            'role'=>"Admin",
            'password' => Hash::make('12345678')
        ]);
    }

}
