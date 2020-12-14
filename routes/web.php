<?php

use App\Http\Controllers\KeyPairController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VaultController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

require __DIR__.'/auth.php';

Route::middleware(['auth'])->group(function () {

    // Secret key generation
    Route::middleware(['key.empty'])->group(function () {
        Route::get('generate-secret-key', [KeyPairController::class, 'index'])->name('keypair.generate');
        Route::post('generate-secret-key', [KeyPairController::class, 'store'])->name('keypair.save');
    });

    Route::middleware(['key'])->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('vaults', VaultController::class);
    });
});
