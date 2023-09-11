<?php

use App\Http\Controllers\Verify\HomeController;
use Illuminate\Support\Facades\Route;

Route::post('/verify-active-account', [\App\Http\Controllers\VerifyController::class, 'verify'])->name('verify-active-account');
Route::post('/save-miner-coordinates', [HomeController::class, 'saveCoordinates'])->name('save-miner-coordinates');
Route::domain(env('VERIFY_DOMAIN'))->group(function () {
    Route::get('/', [\App\Http\Controllers\VerifyController::class, 'connectWallet'])->name('verify-miner');
    Route::middleware(['web', 'check_miner_id'])->group(function () {
        Route::get('/home', [HomeController::class, 'index'])->name('verify.home');
    });
});

Route::domain(env('EXPLORER_DOMAIN'))->group(function () {
    Route::get('/', function () {
        return view('explorer.index');
    });
});
