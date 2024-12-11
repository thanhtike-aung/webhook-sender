<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'App\Http\Controllers\ShopController')->name('shop.index');
Route::get('/order', 'App\Http\Controllers\ShopController@orderProduct')->name('product.order');
