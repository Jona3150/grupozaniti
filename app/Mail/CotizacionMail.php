<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class CotizacionMail extends Mailable
{
    public $data;
    public $image; 

    public function __construct($data, $image = null)
    {
        $this->data = $data;
        $this->image = $image; 
    }

    public function build()
    {
        $email = $this->subject('Nueva solicitud de cotización')
            ->view('emails.cotizacion')
            ->with('data', $this->data);

        // 
        if ($this->image) {
            $email->attach(
                $this->image->getRealPath(),
                [
                    'as' => $this->image->getClientOriginalName(),
                    'mime' => $this->image->getMimeType(),
                ]
            );
        }

        return $email;
    }
}