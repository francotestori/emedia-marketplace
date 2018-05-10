<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Purchase extends Mailable
{
    use Queueable, SerializesModels;

    private $thread;
    private $url;
    private $advertiser;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($thread = null, $advertiser = null, $url = null)
    {
        $this->thread = $thread;
        $this->url = $url;
        $this->advertiser = $advertiser;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.purchase')
                    ->with('thread', $this->thread)
                    ->with('url', $this->url)
                    ->with('advertiser', $this->advertiser);
    }
}
