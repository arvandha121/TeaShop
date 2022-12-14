<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function send($id)
    {
        $orders = Order::with('orderDetail')->find($id);

        return view('email.orderSummary', compact('orders'));
    }
}
