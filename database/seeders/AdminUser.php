<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' =>'enad',
            'email' =>'enad.abuzaid15@gmail.com',
            'password' => Hash::make('12345678'),
        ]);

//        User::create([
//            'name' =>'enad',
//            'email' =>'enad.abuzaid15@gmail.com',
//            'password' => Hash::make('12345678'),
//        ]);
    }
}
