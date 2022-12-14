<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderMail extends Mailable
{
    use Queueable, SerializesModels;
    public $orders;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($orders_id)
    {
        $this->orders = Order::with('orderDetail')->find($orders_id);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {        
        return $this->subject('Order Summary')
                    ->view('email.orderSummary', ['orders' => $this->orders,]);
        
    }
}
