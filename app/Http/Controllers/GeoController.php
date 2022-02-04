<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FindIp;
use App\Services\Weather;

class GeoController extends Controller
{
    public function showForecastTemp(Request $request){

        $FindIp = new FindIp();
        $Weather = new Weather();

        //$ipClient = $request->ip();
        $ipClient = "177.36.251.14";

        $geoData = $FindIp->getInfoIp($ipClient);
        $WeaterLocalData = $Weather->getWeatherIp($ipClient);

        $totalInfo = [];
        array_push($totalInfo, $geoData, $WeaterLocalData);

        return response()->json($totalInfo);
    }

    
}
