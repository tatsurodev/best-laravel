<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'FrontEndController@index')->name('index');

Route::get('/product/{product}', 'FrontEndController@singleProduct')->name('product.single');

Route::post('/cart/add', 'ShoppingController@add_to_cart')->name('cart.add');

Route::get('/cart', 'ShoppingController@cart')->name('cart');

Route::resource('products', 'ProductController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
