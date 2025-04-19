<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Helpers\RoutineHelper;
use App\Models\RoutineRecommendation;

class WeatherController extends Controller
{
    public function getWeather($city, $countryCode)
    {
        $apiKey = config('services.openweather.key');
        $query = "{$city},{$countryCode}";

        // Solicitar el clima actual y la previsión de 5 días
        $response = Http::get("https://api.openweathermap.org/data/2.5/forecast", [
            'q' => $query,
            'appid' => $apiKey,
            'units' => 'metric',
            'lang' => 'es',
        ]);

        // Si la solicitud falla
        if ($response->failed()) {
            return response()->json([
                'error' => 'No se pudo obtener el clima',
            ], 400);
        }

        // Obtener los datos
        $data = $response->json();

        // Datos del clima actual
        $weather = $data['list'][0]['weather'][0]['main'];
        $temp = $data['list'][0]['main']['temp'];
        $icon = $data['list'][0]['weather'][0]['icon'];
        $iconUrl = "http://openweathermap.org/img/wn/{$icon}.png";

        // Obtener pronóstico de los próximos 5 días
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
                    'recomendacion' => $this->getRoutineRecommendation($entry['weather'][0]['main']),
                ];
            }
        }

        // Respuesta JSON con el clima actual y el pronóstico
        return response()->json([
            'ciudad' => $city,
            'pais' => strtoupper($countryCode),
            'temperatura_actual' => $temp . " °C",
            'estado_actual' => $weather,
            'icono_actual' => $iconUrl,
            'recomendacion_actual' => $this->getRoutineRecommendation($weather),
            'pronostico_5_dias' => $forecast,
        ]);
    }

    // Método para obtener la recomendación
    private function getRoutineRecommendation($weather)
    {
        // Buscar la recomendación en la base de datos
        $entry = RoutineRecommendation::where('weather', strtolower($weather))->first();
        
        // Si existe una recomendación en la base de datos, la usamos; si no, usamos la del helper
        return $entry?->recommendation ?? RoutineHelper::getRecommendation($weather);
    }
}
