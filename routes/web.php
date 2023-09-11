<?php

use App\Http\Controllers\Verify\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::post('/verify-active-account', [\App\Http\Controllers\VerifyController::class, 'verify'])->name('verify-active-account');
Route::post('/save-miner-coordinates', [HomeController::class, 'saveCoordinates'])->name('save-miner-coordinates');
Route::domain(env('VERIFY_DOMAIN'))->group(function () {
    Route::get('/', [\App\Http\Controllers\VerifyController::class, 'connectWallet'])->name('verify-miner');
    Route::middleware(['web', 'check_miner_id'])->group(function () {
        Route::get('/home', [HomeController::class, 'index'])->name('verify.home');
    });

//    admin routes
    Route::middleware(['web','auth'])->group(function (){
        Route::get('admin/dashboard', [\App\Http\Controllers\AdminController::class, 'index'])->name('minerDevices.index');
        Route::get('admin/device/create', [\App\Http\Controllers\AdminController::class, 'create'])->name('minerDevices.create');
        Route::get('admin/device/import', [\App\Http\Controllers\AdminController::class, 'import'])->name('minerDevices.import');
        Route::post('admin/device/import', [\App\Http\Controllers\AdminController::class, 'importProcess'])->name('minerDevices.importFile');
        Route::get('admin/device/edit/{id}', [\App\Http\Controllers\AdminController::class, 'edit'])->name('minerDevices.edit');
        Route::get('admin/device/delete/{id}', [\App\Http\Controllers\AdminController::class, 'delete'])->name('minerDevices.delete');
        Route::post('admin/device/store', [\App\Http\Controllers\AdminController::class, 'store'])->name('minerDevices.store');
        Route::patch('admin/device/update/{id}', [\App\Http\Controllers\AdminController::class, 'update'])->name('minerDevices.update');
    });

    Auth::routes([
        'register' => false, // Registration Routes...
        'reset' => false, // Password Reset Routes...
        'verify' => false, // Email Verification Routes...
    ]);
});

Route::domain(env('EXPLORER_DOMAIN'))->group(function () {
    Route::get('/', function () {
        return view('explorer.index');
    });
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
