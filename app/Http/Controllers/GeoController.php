<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FindIp;
use App\Services\Weather;
use App\Events\NovaConsulta;


class GeoController extends Controller
{
    public function showWeather(Request $request){

        $FindIp = new FindIp();
        $Weather = new Weather();

        $ipClient = $request->ip();

        $geoData = $FindIp->getInfoIp($ipClient);

        if($geoData->status == "fail"){
            return response()->json([ 'error' => true, 'message' => 'Falha ao obter informações sobre o IP' ]);
        }

        $WeaterLocalData = $Weather->getWeatherCoordinates($geoData->lat, $geoData->lon);

        $formattedResponse = $this->formatResponse($geoData, $WeaterLocalData);
        
        event(new NovaConsulta($formattedResponse));

        return response()->json($formattedResponse);

    }

    public function list($ipUser, $limit){

        $list = Consultas::where('ip', $ipUser)
            ->orderByDesc('id')
            ->limit($limit)
            ->get();

        if(sizeof($list) != 0){
            return response()->json($list);    
        }else{
            return response()->json([ 'error' => true, 'message' => 'Não existem registros com esse ip' ]);
        }


    }

    public function formatResponse($geoData, $WeaterLocalData){
        
        $reponseFormatted = [];

        $reponseFormatted['ip'] = $geoData->query;
        $reponseFormatted['cidade'] = $geoData->city;
        $reponseFormatted['estado'] = $geoData->regionName;
        $reponseFormatted['pais'] = $geoData->country;

        $reponseFormatted["temperatura"] = $WeaterLocalData->current->temp_c . "º C";
        $reponseFormatted["eDia"] = (($WeaterLocalData->current->is_day == 1) ? 'Sim' : 'Nao');
        $reponseFormatted["status"] = $WeaterLocalData->current->condition->text;
        $reponseFormatted["velocidadeVento"] = $WeaterLocalData->current->wind_kph . "Km/h";
        $reponseFormatted["umidadeAr"] = $WeaterLocalData->current->humidity . " %";
        $reponseFormatted["ultimaAtualizacao"] = $WeaterLocalData->current->last_updated;
        

        return $reponseFormatted;
    }
    
}
