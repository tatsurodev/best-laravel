<?php

namespace App\Http\Controllers;

use Cart;
use App\Product;
use Illuminate\Http\Request;

class ShoppingController extends Controller
{
    public function add_to_cart()
    {
        $pdt = Product::findOrFail(request()->pdt_id);
        $cart = Cart::add([
            'id' => $pdt->id,
            'name' => $pdt->name,
            'qty' => request()->qty,
            'price' => $pdt->price,
            'weight' => $pdt->weight,
        ]);
        // dd(Cart::content());
        return redirect()->route('cart');
    }

    public function cart()
    {
        return view('cart');
    }
}
