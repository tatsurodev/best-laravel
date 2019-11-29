<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    public function index()
    {
        return view('index', [
            'products' => Product::paginate(3),
        ]);
    }

    public function singleProduct(Product $product)
    {
        return view('single', ['product' => $product]);
    }
}
