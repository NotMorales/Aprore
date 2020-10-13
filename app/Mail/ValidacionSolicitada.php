<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ValidacionSolicitada extends Mailable
{
    use Queueable, SerializesModels;
    public $subject = "Nueva validacion de postulantes.";
    public $postulante;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($postulante)
    {
        $this->postulante = $postulante;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.validacion-solicitada');
    }
}
