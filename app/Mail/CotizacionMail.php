<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class CotizacionMail extends Mailable
{
    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        return $this->subject('Nueva solicitud de cotización')
            ->view('emails.cotizacion');
    }
}