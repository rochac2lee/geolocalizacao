<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consultas;
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

        $WeaterLocalData = $Weather->getWeatherCoordinates($geoData->lat, $geoData->lon);

        $formattedResponse = $this->formatResponse($geoData, $WeaterLocalData);
        Consultas::create($formattedResponse);

        return response()->json($formattedResponse);
        
    }

    public function formatResponse($geoData, $WeaterLocalData){
        
        $reponseFormatted = [];

        $reponseFormatted['ip'] = $geoData->query;
        $reponseFormatted['cidade'] = $geoData->city;
        $reponseFormatted['estado'] = $geoData->regionName;
        $reponseFormatted['pais'] = $geoData->country;

        $reponseFormatted["temperatura"] = $WeaterLocalData->current->temp_c . "º C";
        $reponseFormatted["eDia"] = (($WeaterLocalData->current->is_day == 0) ? 'Sim' : 'Nao');
        $reponseFormatted["status"] = $WeaterLocalData->current->condition->text;
        $reponseFormatted["velocidadeVento"] = $WeaterLocalData->current->wind_kph . "Km/h";
        $reponseFormatted["humidadeAr"] = $WeaterLocalData->current->humidity . " %";
        $reponseFormatted["ultimaAtualizacao"] = $WeaterLocalData->current->last_updated;
        

        return $reponseFormatted;
    }
    
}
