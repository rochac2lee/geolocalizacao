<?php

namespace App\Services;
use Illuminate\Support\Facades\Http;

class Weather{

    public function __construct(){
        $this->endPoint = env('WEATHER_API_URL');
        $this->apiKey = env('WEATHER_API_KEY');
    }

    public function getWeatherIp($ip){

        $url = "$this->endPoint/current.json?key=$this->apiKey&q=$ip&lang=pt";

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $response = json_decode($response);

        return $response;
        
    }

}