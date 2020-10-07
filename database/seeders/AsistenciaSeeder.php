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
            'recinto'=>'RECINTO ADUANERO ORURO',
            'motivo'=>'Control de asistencia',
            'persona_id'=>1,
            'destino_id'=>1,
            'user_id'=>2,
            'observado'=>'SI',
            'created_at'=>'2020-09-24 15:00:00'
        ]);
    }
}
