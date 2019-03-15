<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PayModLog extends Mailable
{
    use Queueable, SerializesModels;
    public $mods;
    public $status;
    public $totalOlds;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mods, $status, $totalOlds)
    {
        $this->mods = $mods;
        $this->status= $status;
        $this->totalOlds = $totalOlds;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.payModLog');
    }
}
