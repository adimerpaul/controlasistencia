<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DestinoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('destinos')->insert(['nombre'=>'PLAYA MAQUINARIA','recinto_id'=>2]);
        DB::table('destinos')->insert(['nombre'=>'OFICINAS ADMINISTRATIVAS','recinto_id'=>2]);
    }
}
