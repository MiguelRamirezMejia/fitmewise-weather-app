<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Helpers\RoutineHelper;

class WeatherController extends Controller
{
    public function getWeather($city, $countryCode)
    {
        $apiKey = config('services.openweather.key');
        $query = "{$city},{$countryCode}";

        $response = Http::get("https://api.openweathermap.org/data/2.5/forecast", [
            'q' => $query,
            'appid' => $apiKey,
            'units' => 'metric',
            'lang' => 'es',
        ]);

        if ($response->failed()) {
            return response()->json([
                'error' => 'No se pudo obtener el clima',
            ], 400);
        }

        $data = $response->json();

        $weather = $data['list'][0]['weather'][0]['main'];
        $temp = $data['list'][0]['main']['temp'];
        $icon = $data['list'][0]['weather'][0]['icon'];
        $iconUrl = "http://openweathermap.org/img/wn/{$icon}.png";

        $forecast = [];
        for ($i = 1; $i <= 5; $i++) {
            $index = ($i * 8) - 1;
            if (isset($data['list'][$index])) {
                $entry = $data['list'][$index];
                $forecast[] = [
                    'fecha' => $entry['dt_txt'],
                    'temperatura' => $entry['main']['temp'] . " °C",
                    'estado' => $entry['weather'][0]['main'],
                    'icono' => "http://openweathermap.org/img/wn/" . $entry['weather'][0]['icon'] . ".png",
                    'recomendacion' => RoutineHelper::getRecommendation($entry['weather'][0]['main']),
                ];
            }
        }

        return response()->json([
            'ciudad' => $city,
            'pais' => strtoupper($countryCode),
            'temperatura_actual' => $temp . " °C",
            'estado_actual' => $weather,
            'icono_actual' => $iconUrl,
            'recomendacion_actual' => RoutineHelper::getRecommendation($weather),
            'pronostico_5_dias' => $forecast,
        ]);
    }
}
