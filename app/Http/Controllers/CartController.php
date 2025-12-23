<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Promo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function cart(){
        $carts = Cart::with('products')->where('user_id', Auth::id())->get();
        return view('user.cart', [
            'titlePage' => 'Cart',
            'carts' => $carts
        ]);
    }

    public function store(Request $request){
        try {
            Cart::create($request->all());
            return redirect()->back()->with('success', 'Success to add product to cart');
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'Failed to add product to cart');
        }
    }

    public function discount(Request $request){
        $promo = Promo::where("name", $request->promo)->first();
        if(isset($promo)){
            return redirect()->back()->with('discount', $promo->promo);
        }
        return redirect()->back();
    }

    public function delete(Request $request){
        DB::table('carts')->where('id', $request->get('id'))->delete();
        return redirect()->back();
    }
}
