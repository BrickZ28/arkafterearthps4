<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendPin extends Mailable
{
    public $pin;
    public $gate;
    public $style;
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($pin, $gate, $style)
    {
        $this->pin = $pin;
        $this->gate = $gate;
        $this->style = $style;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.sendpin')
            ->subject('Gate and Pin');
    }
}
