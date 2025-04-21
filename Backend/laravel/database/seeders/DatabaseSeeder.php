<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Asegúrate de importar DB
use App\Models\RoutineRecommendation;
use App\Models\Country;
use App\Models\City;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Deshabilitar las verificaciones de claves foráneas
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Truncar las tablas
        RoutineRecommendation::truncate();
        Country::truncate();
        City::truncate();

        // Habilitar las verificaciones de claves foráneas nuevamente
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Ejecutar los seeders
        $this->call([
            RoutineRecommendationSeeder::class,
            CountrySeeder::class,
            CitySeeder::class,
        ]);
    }
}
