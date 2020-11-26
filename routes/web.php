<?php

use App\Http\Controllers\KeyPairController;
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
    Route::get('generate-secret-key', [KeyPairController::class, 'show'])->name('keypair.generate');
    Route::post('generate-secret-key', [KeyPairController::class, 'store']);

    Route::middleware(['key'])->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        });
    });
});
