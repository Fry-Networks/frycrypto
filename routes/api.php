<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('/verify-active-account', [\App\Http\Controllers\VerifyController::class, 'verify'])->name('verify-active-account');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
