<?php
// app/Http/Controllers/LocationController.php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\City;

class LocationController extends Controller
{
    public function getCountries()
    {
        return response()->json(Country::select('id', 'name', 'code')->get());
    }

    public function getCitiesByCountry($countryId)
    {
        $cities = City::where('country_id', $countryId)->select('id', 'name')->get();
        return response()->json($cities);
    }
}
