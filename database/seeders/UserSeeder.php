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
            'password'=>Hash::make('admin')
        ]);
        DB::table('users')->insert([
            'name'=>'oruro',
            'email'=>'oruro@gmail.com',
            'tipo'=>'ORURO',
            'password'=>Hash::make(123456)
        ]);
        DB::table('users')->insert([
            'name'=>'lapaz',
            'email'=>'lapaz@gmail.com',
            'tipo'=>'LA PAZ',
            'password'=>Hash::make(123456)
        ]);
    }
}
