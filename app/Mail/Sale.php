<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Sale extends Mailable
{
    use Queueable, SerializesModels;

    private $thread;
    private $editor;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($thread = null, $editor = null)
    {
        $this->thread = $thread;
        $this->editor= $editor;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.sale')
                    ->with('thread', $this->thread)
                    ->with('editor', $this->editor);
    }
}
