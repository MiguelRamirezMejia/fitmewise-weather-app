<?php
// app/Http/Controllers/LocationController.php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\City;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    // Obtener los países
    public function getCountries()
    {
        return response()->json(Country::select('id', 'name', 'code')->get());
    }

    // Obtener ciudades por país
    public function getCitiesByCountry($countryId, Request $request)
    {
        // Verificar si el ID del país es válido
        $country = Country::find($countryId);
        
        if (!$country) {
            return response()->json(['error' => 'País no encontrado'], 404);
        }

        // Obtener las ciudades asociadas al país
        $cities = City::where('country_id', $countryId)
                      ->select('id', 'name')
                      ->get();

        // Eliminar duplicados
        $cities = $cities->unique('name'); // Esto eliminará los duplicados basados en el nombre de la ciudad

        // Si no hay ciudades para ese país
        if ($cities->isEmpty()) {
            return response()->json(['message' => 'No se encontraron ciudades para este país'], 404);
        }

        // Devolver las ciudades
        return response()->json($cities);
    }
}
