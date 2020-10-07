<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'=>'admin',
            'email'=>'admin@gmail.com',
            'tipo'=>'ADMIN',
            'password'=>Hash::make('admin'),
            'recinto_id'=>1
        ]);
//        DB::table('users')->insert([
//            'name'=>'oruro',
//            'email'=>'oruro@gmail.com',
//            'tipo'=>'RECINTO ADUANERO ORURO',
//            'password'=>Hash::make(123456),
//            'recinto_id'=>2
//        ]);
//        DB::table('users')->insert([
//            'name'=>'lapaz',
//            'email'=>'lapaz@gmail.com',
//            'tipo'=>'RECINTO ADUANERO LA PAZ',
//            'password'=>Hash::make(123456),
//            'recinto_id'=>3
//        ]);
    }
}
