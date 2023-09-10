<?php

use App\Http\Controllers\Algorand\AlgodController;
use App\Http\Controllers\Algorand\IndexerController;
use App\Http\Controllers\Algorand\KmdController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/algod', [AlgodController::class, 'index']);
Route::get('/kmd', [KmdController::class, 'index']);
Route::get('/indexer', [IndexerController::class, 'index']);
Route::get('/transactions', [IndexerController::class, 'transactions']);


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
