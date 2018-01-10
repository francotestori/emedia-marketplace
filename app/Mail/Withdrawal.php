<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Withdrawal extends Mailable
{
    use Queueable, SerializesModels;

    private $amount;
    private $paypal;
    private $cbu;
    private $alias;
    private $sender;
    private $comment;
    private $url;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($amount = null, $paypal = null, $cbu = null, $alias = null, $sender = null, $comment = null, $url = null)
    {
        $this->amount = $amount;
        $this->paypal = $paypal;
        $this->cbu= $cbu;
        $this->alias = $alias;
        $this->sender = $sender;
        $this->comment = $comment;
        $this->url = $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('transaction.withdrawal')
            ->with(['amount'=> $this->amount,
                    'paypal'=> $this->paypal,
                    'cbu'=> $this->cbu,
                    'alias'=> $this->alias,
                    'sender'=> $this->sender,
                    'comment'=> $this->comment,
                    'url'=> $this->url,
                    ]
            );
    }
}
