<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AcceptOrder extends Mailable
{
    use Queueable, SerializesModels;

    private $editor;
    private $user_id;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($editor = null, $user_id = null)
    {
        $this->editor = $editor;
        $this->user_id= $user_id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.accept')
            ->with('user_id', $this->user_id)
            ->with('editor', $this->editor);
    }
}
