<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class DinoRequestCompleted extends Mailable
{
    public $dinoQty;
    public $user;
    public $dinoName;
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($dinoQty, $user, $dinoName)
    {
        $this->dinoQty = $dinoQty;
        $this->user = $user;
        $this->dinoName = $dinoName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.dinoRequestCompleted');
    }
}
