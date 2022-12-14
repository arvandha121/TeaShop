<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $user_id = $request->get('user_id');
        $total = $request->get('total');
        $token = Str::random(10);
        
        do {
            $token = Str::random(10);
        } while(Order::find($token));

        $order = new Order;

        $order->user_id = $user_id;
        $order->token = $token;
        $order->total = $total;
        $order->order_date = Carbon::now()->toDateTimeString();
        $order->status = 0;

        $order->save();
        if($order) {

            $OD = new OrderDetail;

            $items = Cart::where('user_id', $user_id)->get();
            // dd($items);
            foreach($items as $item) {
                $OD->insert([
                    'order_id' => $order->id,
                    'menu_id' => $item->menu_id,
                    'token' => $token,
                    'qty' => $item->qty,
                ]);
            }
            $codes = 0;
            $messages = '';
            if($OD) {
                $codes = 200;
                $messages = 'succesffully added order details';
            }
            

            return response()->json([
                'code' => 200,
                'message' => 'order stored successfully',
                'odCode' => $codes,
                'odMsg' => $messages,
                'order_id' => $order->id,
            ]);
        } else {
            return response()->json([
                'code' => 400,
                'message' => 'failed to store order',
            ]);
        }
    }

    public function show($id) 
    {
        $orders = Order::with('orderDetail')->find($id);
        // $orders->orderDetial = OrderDetail::all();
        // dd($orders->orderDetail);
        $qrcode = QrCode::size(250)->generate($orders->token);

        return view('user.order', compact('orders', 'qrcode'));
    }

    public function fetchAll($id)
    {
        $orders = Order::with('orderDetail')
            ->where('user_id', $id)
            ->get();

        return view('user.orders', compact('orders'));
    }

    public function fetchByToken($token)
    {
        $orders = Order::with('orderDetail', 'user', 'orderDetail.menu')
            ->where('token', $token)
            ->get()->first();
        // dd($orders);
        if($orders) {
            return response()->json([
                'code' => 200,
                'orders' => $orders,
            ]);
        } else {
            return response()->json([
                'code' => 400,
                'message' => 'error when trying to fetch data',
            ]);
        }
    }

    public function updateStock($order_id)
    {
        $orders = Order::with('orderDetail', 'orderDetail.menu')->find($order_id);

        // dd($orders);

        foreach($orders->orderDetail as $OD) {
            $menu =new Menu;
            $menu = $OD->menu;
            $menu->stock -= $OD->qty;
            $menu->save();
        }
    }
}
