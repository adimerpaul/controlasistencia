<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersonaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('personas')->insert([
            'nombres'=>'ALEJANDRO',
            'apellidos'=>'LOPEZ',
            'celular'=>'69603027',
            'ci'=>'7336199',
            'expedido'=>'OR',
            'nacionalidad'=>'BOLIVIANA',
            ]);
    }
}
