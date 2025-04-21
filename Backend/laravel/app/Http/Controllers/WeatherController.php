<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Helpers\RoutineHelper;
use App\Models\RoutineRecommendation;

class WeatherController extends Controller
{
    public function getWeather($city, $countryCode)
    {
        Log::info("Ciudad: {$city}, País: {$countryCode}");

        $apiKey = config('services.openweather.key');
        $query  = "{$city},{$countryCode}";

        $response = Http::get("https://api.openweathermap.org/data/2.5/forecast", [
            'q'     => $query,
            'appid' => $apiKey,
            'units' => 'metric',
            'lang'  => 'es',
        ]);

        if ($response->failed()) {
            Log::error('Error al obtener datos del clima: ' . $response->body());
            return response()->json([
                'error'   => 'No se pudo obtener el clima',
                'message' => $response->body(),
            ], 400);
        }

        $data = $response->json();

        if (!isset($data['list'][0])) {
            return response()->json([
                'error'    => 'No se encontraron datos del clima en la respuesta',
                'response' => $data,
            ], 400);
        }

        try {
            // Usamos description (en español) en vez de main
            $weatherDesc = $data['list'][0]['weather'][0]['description'];
            $temp        = $data['list'][0]['main']['temp'];
            $icon        = $data['list'][0]['weather'][0]['icon'];
            $iconUrl     = "http://openweathermap.org/img/wn/{$icon}.png";
        } catch (\Exception $e) {
            return response()->json([
                'error'   => 'Datos del clima no disponibles',
                'message' => $e->getMessage(),
            ], 500);
        }

        $tempFahrenheit = $this->celsiusToFahrenheit($temp);

        // Pronóstico de 5 días
        $forecast = [];
        for ($i = 1; $i <= 5; $i++) {
            $index = ($i * 8) - 1;
            if (isset($data['list'][$index])) {
                $entry             = $data['list'][$index];
                $entryTemp         = $entry['main']['temp'];
                $entryTempFahr     = $this->celsiusToFahrenheit($entryTemp);
                $entryDesc         = $entry['weather'][0]['description'];

                $forecast[] = [
                    'fecha'                  => $entry['dt_txt'],
                    'temperatura'            => "{$entryTemp} °C",
                    'temperatura_fahrenheit' => round($entryTempFahr, 2) . " °F",
                    'estado'                 => ucfirst($entryDesc),
                    'icono'                  => "http://openweathermap.org/img/wn/{$entry['weather'][0]['icon']}.png",
                    'recomendacion'          => $this->getRoutineRecommendation($entryDesc),
                ];
            }
        }

        return response()->json([
            'ciudad'                       => $city,
            'pais'                         => strtoupper($countryCode),
            'temperatura_actual'           => "{$temp} °C",
            'temperatura_actual_fahrenheit'=> round($tempFahrenheit, 2) . " °F",
            'estado_actual'                => ucfirst($weatherDesc),
            'icono_actual'                 => $iconUrl,
            'recomendacion_actual'         => $this->getRoutineRecommendation($weatherDesc),
            'pronostico_5_dias'            => $forecast,
        ]);
    }

    private function getRoutineRecommendation($weather)
    {
        $entry = RoutineRecommendation::where('weather', strtolower($weather))->first();
        return $entry?->recommendation ?? RoutineHelper::getRecommendation($weather);
    }

    private function celsiusToFahrenheit($celsius)
    {
        return ($celsius * 9/5) + 32;
    }
}
