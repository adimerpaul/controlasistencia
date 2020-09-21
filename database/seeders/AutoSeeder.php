<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('autos')->insert(['placa'=>'AAAA-1010','tipo'=>'TOYOTA','uso'=>'USO PARTICULAR','persona_id'=>'1']);

    }
}
