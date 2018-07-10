<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProudctOrderReply extends Mailable
{
    use Queueable, SerializesModels;
    private $message;
    private $email;

    /**
     * Create a new message instance.
     *
     * @param $message
     * @param $email
     */
    public function __construct($message,$email)
    {
        $this->message=$message;
        $this->email=$email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('email.product.reply')->with("email",$this->email)->with("message",$this->message);
    }
}
