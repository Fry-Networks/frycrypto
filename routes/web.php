<?php

use App\Http\Controllers\Verify\HomeController;
use Illuminate\Support\Facades\Route;


Route::domain(env('VERIFY_DOMAIN'))->group(function () {
    Route::get('/', function () {
        return view('verify.verify');
    });
    Route::get('/home', [HomeController::class, 'index'])->name('verify.home');
});

Route::domain(env('EXPLORER_DOMAIN'))->group(function () {
    Route::get('/', function () {
        return view('explorer.index');
    });
});
