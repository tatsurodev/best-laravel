<?php

namespace App\Http\Controllers;

use App\Mail\PurchaseSuccessful;
use Cart;
use Mail;
use Stripe\Charge;
use Stripe\Stripe;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('checkout');
    }

    public function pay()
    {
        // dd(request()->all());
        // secret keyのset
        Stripe::setApikey("sk_test_0kv2XRjQF6PtNCmk1i5Xdn8F00DFKxzaax");
        // 受け取ったtokenを使って請求を行う
        $charge = Charge::create([
            'amount' => Cart::total() * 100,
            'currency' => 'usd',
            'description' => 'udemy course practice selling books',
            // request()でstripから返ってきたrequestが取得でき、stripeToken propertyにtokenが格納されている
            'source' => request()->stripeToken,
        ]);
        // cart中身削除
        Cart::destroy();

        // mail送信
        Mail::to(request()->stripeEmail)->send(new PurchaseSuccessful);
        return redirect()->route('index')->withSuccess('Purchase successfull. Wait for our email.');
    }
}
