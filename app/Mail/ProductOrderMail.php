<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProductOrderMail extends Mailable
{
    use Queueable, SerializesModels;
    private $product;
    private $detail;

    /**
     * Create a new message instance.
     *
     * @param $product
     * @param $data
     */
    public function __construct($product,$detail)
    {
        $this->product=$product;
        $this->detail=$detail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('email.product.order')->with("product",$this->product)->with("details",$this->detail);
    }
}
