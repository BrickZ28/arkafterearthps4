<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class DinoRequestUpdated extends Mailable
{
    public $qty;
    public $total;
    public $status;
    public $requestor;
    public $dinoName;

    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($qty, $total, $status, $requestor, $dinoName)
    {
        $this->qty = $qty;
        $this->total = $total;
        $this->status = $status;
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
        return $this->markdown('emails.dinoRequestUpdated');
    }
}
