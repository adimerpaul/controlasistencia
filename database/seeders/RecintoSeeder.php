<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RecintoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('recintos')->insert(['nombre'=>'ADMIN',]);
//        DB::table('recintos')->insert(['nombre'=>'RECINTO ADUANERO ORURO',]);
//        DB::table('recintos')->insert(['nombre'=>'RECINTO ADUANERO LA PAZ',]);
    }
}
