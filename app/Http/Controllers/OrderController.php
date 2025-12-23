<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function order(){
        $orders = Order::where('user_id', Auth::id())->get();
        return view('user.order', [
            'titlePage' => 'Order',
            'orders' => $orders
        ]);
    }
    public function checkout(Request $request){
        $carts = Cart::where('user_id', auth()->user()->id)->get();
        $orders = Order::create($request->all());
        foreach ($carts as $cart) {
            OrderDetail::create([
                "product_id" => $cart->product_id,
                "order_id" => $orders->id,
                "quantity" => $cart->quantity
            ]);
        }
        DB::table('carts')->where('user_id', auth()->user()->id)->delete();
        return redirect()->back();
    }
}
