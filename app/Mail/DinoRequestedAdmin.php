<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class DinoRequestedAdmin extends Mailable
{
    public $total;
    public $qty;
    public $dinoName;
    public $requestor;

    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($qty, $total, $requestor, $dinoName)
    {
        $this->total = $total;
        $this->qty = $qty;
        $this->requestor = $requestor;
        $this->dinoName = $dinoName;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.DinoRequestedAdmin');
    }
}
