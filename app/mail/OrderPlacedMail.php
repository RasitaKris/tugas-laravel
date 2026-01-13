<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderPlacedMail extends Mailable
{
    use Queueable, SerializesModels;

    public Order $order;

    // Create a new message instance.
  
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

   // Build the message.
 
    public function build()
    {
        return $this
            ->subject('Konfirmasi Order & Informasi Pembayaran')
            ->view('emails.order-placed');
    }
}
