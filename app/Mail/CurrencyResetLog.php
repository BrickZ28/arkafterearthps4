<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CurrencyResetLog extends Mailable
{
    use Queueable, SerializesModels;
    public $countOld;
    public $countNew;
    public $status;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($countOld, $status, $countNew)
    {
        $this->countOld = $countOld;
        $this->status = $status;
        $this->countNew = $countNew;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.currencyResetLog');
    }
}
