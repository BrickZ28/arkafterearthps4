<?php

namespace App\Mail;

use App\User;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class DinoRequested extends Mailable
{

    public $user;
    public $total;
    public $dinoName;
    public $qty;


    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $total, $dinoName, $qty)
    {
        $this->user = $user;
        $this->total = $total;
        $this->dinoName = $dinoName;
        $this->qty = $qty;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.DinoRequested');
    }
}
