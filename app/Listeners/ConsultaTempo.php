<?php

namespace App\Listeners;

use App\Events\NovaConsulta;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Consultas;

class ConsultaTempo
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\NovaConsulta  $event
     * @return void
     */
    public function handle(NovaConsulta $event)
    {
        Consultas::create($event->consultaFormatada);
    }
}
