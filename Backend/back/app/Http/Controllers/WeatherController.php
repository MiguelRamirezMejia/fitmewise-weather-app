<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    public function getWeather($city)
    {
        $apiKey = config('services.openweather.key');

        $response = Http::get("https://api.openweathermap.org/data/2.5/weather", [
            'q' => $city,
            'appid' => $apiKey,
            'units' => 'metric', // Para que dé la temperatura en °C
            'lang' => 'es',      // Puedes usar 'en' si prefieres en inglés
        ]);

        if ($response->failed()) {
            return response()->json([
                'error' => 'No se pudo obtener el clima',
            ], 400);
        }

        $data = $response->json();

        $weather = $data['weather'][0]['main'];
        $temp = $data['main']['temp'];

        return response()->json([
            'ciudad' => $city,
            'temperatura' => $temp . " °C",
            'estado' => $weather,
            'recomendacion' => $this->getRoutineRecommendation($weather)
        ]);
    }

    private function getRoutineRecommendation($weather)
    {
        return match(strtolower($weather)) {
            'clear' => 'Ideal para salir a correr al aire libre.',
            'clouds' => 'Perfecto para una caminata tranquila.',
            'rain' => 'Mejor hacer una rutina indoor, como yoga o ejercicios de fuerza.',
            'snow' => 'Haz cardio suave dentro de casa.',
            default => 'Haz lo que puedas en casa, ¡mantente activo!',
        };
    }
}
