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
        $cartItem = Cart::add([
            'id' => $pdt->id,
            'name' => $pdt->name,
            'qty' => request()->qty,
            'price' => $pdt->price,
            'weight' => $pdt->weight,
        ]);
        // dd(Cart::content());

        // cartitemとmodelを関連付けてdbから直接product情報を取得できるようにする
        // cartItemInstance->model->propertyName
        Cart::associate($cartItem->rowId, Product::class);
        return redirect()->route('cart');
    }

    public function cart()
    {
        // Cart::destroy();
        return view('cart');
    }
}
