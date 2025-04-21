<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RoutineRecommendation;

class RoutineRecommendationSeeder extends Seeder
{
    public function run()
    {
        $recommendations = [
            ['weather' => 'clear', 'recommendation' => 'Ideal para salir a correr al aire libre.'],
            ['weather' => 'clouds', 'recommendation' => 'Perfecto para una caminata tranquila.'],
            ['weather' => 'rain', 'recommendation' => 'Mejor hacer una rutina indoor, como yoga o ejercicios de fuerza.'],
            ['weather' => 'snow', 'recommendation' => 'Haz cardio suave dentro de casa.'],
            ['weather' => 'default', 'recommendation' => 'Haz lo que puedas en casa, ¡mantente activo!'],
        ];

        foreach ($recommendations as $recommendation) {
            RoutineRecommendation::create($recommendation);
        }
    }
}
