<?php

namespace App\Services;
use Illuminate\Support\Facades\Http;

class FindIp{

    public function __construct(){
        $this->endPoint = env('INFOIP_API_URL');
    }

    public function getInfoIp($ip){

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->endPoint . "//" . $ip,
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