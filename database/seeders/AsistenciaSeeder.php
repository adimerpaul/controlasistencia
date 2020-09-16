<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AsistenciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('asistencias')->insert([
            'objetos'=>'celular,gps',
            'observaciones'=>'Se le vio misrando un auto',
            'recinto'=>'ORURO',
            'unidad'=>'SISTEMAS',
            'persona_id'=>1
        ]);
    }
}
