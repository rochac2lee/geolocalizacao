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

        $WeaterLocalData = $Weather->getWeatherCoordinates($geoData->lat, $geoData->lon);

        return response()->json($this->formatResponse($geoData, $WeaterLocalData));
    }

    public function formatResponse($geoData, $WeaterLocalData){
        
        $reponseFormatted = [];
        $atualizacao = explode(" ", $WeaterLocalData->current->last_updated);

        $reponseFormatted['cidade'] = $geoData->city;
        $reponseFormatted['estado'] = $geoData->regionName;
        $reponseFormatted['pais'] = $geoData->country;

        $reponseFormatted["temperatura"] = $WeaterLocalData->current->temp_c . "º C";
        $reponseFormatted["eDia"] = (($WeaterLocalData->current->is_day == 0) ? 'Sim' : 'Nao');
        $reponseFormatted["status"] = $WeaterLocalData->current->condition->text;
        $reponseFormatted["velocidadeVento"] = $WeaterLocalData->current->wind_kph . "Km/h";
        $reponseFormatted["humidadeAr"] = $WeaterLocalData->current->humidity . " %";
        $reponseFormatted["ultimaAtualizacao"] = $atualizacao[1];
        

        return $reponseFormatted;
    }
    
}
