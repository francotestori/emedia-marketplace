<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Welcome extends Mailable
{
    use Queueable, SerializesModels;

    private $activation_code;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($code = null)
    {
        $this->activation_code = $code;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.welcome')
            ->with([
                'activation_code'=> $this->activation_code]
            );

    }
}
