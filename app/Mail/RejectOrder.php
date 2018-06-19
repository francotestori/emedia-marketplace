<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Lang;

class RejectOrder extends Mailable
{
    use Queueable, SerializesModels;

    private $editor;
    private $url;
    private $message;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($editor = null, $message = null, $url = null)
    {
        $this->editor = $editor;
        $this->message= $message;
        $this->url= $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.reject')
            ->subject(Lang::get('mail.reject.subject'))
            ->with('message', $this->message)
            ->with('url', $this->url)
            ->with('editor', $this->editor);
    }
}
