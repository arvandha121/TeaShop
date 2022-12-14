<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required | integer',
            'menu_id' => 'required | integer',
            'qty' => 'required | integer',
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => 'error add to cart',
            ]);
        } else {
            $cart = new Cart;
            $cart->user_id = $request->get('user_id');
            $cart->menu_id = $request->get('menu_id');
            $cart->qty = $request->get('qty');

            $cart->save();

            return response()->json([
                'status' => 200,
                'success' => 'Added successfully',
            ]);
        }
    }

    public function fetchById(Request $request)
    {
        $carts = Cart::with('user', 'menu')
            ->where('user_id', $request->get('user_id'))
            ->get();
        // dd($carts);
        return response()->json([
            'carts' => $carts,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $cart_id = $request->get('cart_id');
        $item = Cart::find($cart_id);

        $item->delete();

        if($item) {
            return response()->json(
                [
                    'code' => 200,
                    'message' => 'item deleted successfully',
                ]
            );
        } else {
            return response()->json(
                [
                    'code' => 400,
                    'message' => 'error when deleting item',
                ]
            );
        }
    }

    public function massDestroy(Request $request)
    {
        $user_id = $request->get('user_id');
        $items = Cart::where('user_id', $user_id)->delete();

        if($items) {
            return response()->json(
                [
                    'code' => 200,
                    'message' => 'item deleted successfully',
                ]
            );
        } else {
            return response()->json(
                [
                    'code' => 400,
                    'message' => 'error when deleting item',
                ]
            );
        }
    }

    public function checkAuth() 
    {
        return response()->json(
            [
                'status' => auth()->check(),
            ]
        ); 
    }
}
