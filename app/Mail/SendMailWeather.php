<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class SendMailWeather extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    public $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $data)
    {
        $this->user = $user;
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->user->email)
        ->subject('Previsão do tempo')
        ->view('emails.email')
        ->with([
            'user' => $this->user,
            'data' => $this->data
        ]);
    }
}
