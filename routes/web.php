<?php

use Illuminate\Support\Facades\Route;

//import return type View
use Illuminate\View\View;

Route::get('/', function () {
    return view('welcome');
});

//route resource for products
Route::resource('/nonakademiks', \App\Http\Controllers\NonkadController::class);
Route::resource('/transaknonakademiks', \App\Http\Controllers\transaknonkadController::class);