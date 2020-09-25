<?php

namespace Database\Seeders;

use App\Http\Controllers\DestinoController;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(10)->create();
        $this->call([
            RecintoSeeder::class,
            UserSeeder::class,
            PersonaSeeder::class,
            DestinoSeeder::class,
            AsistenciaSeeder::class,
            AutoSeeder::class,
        ]);
    }
}
