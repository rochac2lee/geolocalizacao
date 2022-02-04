<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\FindIp;
use App\Services\Weather;
use App\Models\User;
use App\Http\Controllers\GeoController;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailWeather;

class SendEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'SendEmail:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        

        $FindIp = new FindIp();
        $Weather = new Weather();
        $GeoController = new GeoController();

        $users = User::all();

        foreach($users as $user){
            $destination = $user->email;

            if($destination){
                
                $geoData = $FindIp->getInfoIp($user->last_ip);
                $WeaterLocalData = $Weather->getWeatherCoordinates($geoData->lat, $geoData->lon);
        
                $formattedResponse = $GeoController->formatResponse($geoData, $WeaterLocalData);

                Mail::to($destination)
                    ->send(new SendMailWeather($user, $formattedResponse));
                
            }

        } 

    }
}
