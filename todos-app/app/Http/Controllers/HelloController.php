<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelloController extends Controller
{
    public function __invoke($first_name, $last_name)
    {
        return view('hello', compact('first_name', 'last_name'));
    }
}
