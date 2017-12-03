<?php

namespace App\Mail\Admin;


use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ErrorOccurred extends Mailable
{
    use Queueable, SerializesModels;

    public $error;

    /**
     * Create a new message instance.
     *
     */
    public function __construct(\Exception $error)
    {
        $this->error = $error;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Хьюстон, у нас проблемы')->markdown('emails.error_occurred');
    }
}
