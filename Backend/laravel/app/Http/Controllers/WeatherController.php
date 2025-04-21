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
        // Verificar los parámetros antes de realizar la solicitud
        Log::info('Ciudad: ' . $city . ', País: ' . $countryCode);

        $apiKey = config('services.openweather.key');
        $query = "{$city},{$countryCode}";

        // Solicitar el clima actual y la previsión de 5 días
        $response = Http::get("https://api.openweathermap.org/data/2.5/forecast", [
            'q' => $query,
            'appid' => $apiKey,
            'units' => 'metric', // Solicitar en unidades métricas (Celsius)
            'lang' => 'es',
        ]);

        // Si la solicitud falla
        if ($response->failed()) {
            Log::error('Error al obtener datos del clima: ' . $response->body());
            return response()->json([
                'error' => 'No se pudo obtener el clima',
                'message' => $response->body(),
            ], 400);
        }

        // Obtener los datos
        $data = $response->json();

        // Verificar si la respuesta contiene los datos esperados
        if (!isset($data['list'][0])) {
            return response()->json([
                'error' => 'No se encontraron datos del clima en la respuesta',
                'response' => $data, // Devolver la respuesta completa para depuración
            ], 400);
        }

        // Extraer datos del clima actual
        try {
            $weather = $data['list'][0]['weather'][0]['main'];
            $temp = $data['list'][0]['main']['temp'];
            $icon = $data['list'][0]['weather'][0]['icon'];
            $iconUrl = "http://openweathermap.org/img/wn/{$icon}.png";
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Datos del clima no disponibles',
                'message' => $e->getMessage(),
            ], 500);
        }

        // Convertir la temperatura actual a Fahrenheit
        $tempFahrenheit = $this->celsiusToFahrenheit($temp);

        // Obtener pronóstico de los próximos 5 días
        $forecast = [];
        for ($i = 1; $i <= 5; $i++) {
            $index = ($i * 8) - 1;
            if (isset($data['list'][$index])) {
                $entry = $data['list'][$index];
                $entryTemp = $entry['main']['temp'];
                $entryTempFahrenheit = $this->celsiusToFahrenheit($entryTemp); // Convertir a Fahrenheit

                $forecast[] = [
                    'fecha' => $entry['dt_txt'],
                    'temperatura' => $entryTemp . " °C",
                    'temperatura_fahrenheit' => round($entryTempFahrenheit, 2) . " °F", // Incluir Fahrenheit
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
            'temperatura_actual_fahrenheit' => round($tempFahrenheit, 2) . " °F", // Incluir Fahrenheit
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

    // Función para convertir Celsius a Fahrenheit
    private function celsiusToFahrenheit($celsius)
    {
        return ($celsius * 9/5) + 32;
    }
}
