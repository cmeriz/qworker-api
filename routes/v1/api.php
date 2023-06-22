<?php

use App\Http\Controllers\Api\v1\Auth\AuthController;
use App\Http\Controllers\Api\v1\MyAccount\MyAccountController;
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

Route::prefix('auth')->name('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login'])->name('login');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('auth')->name('auth')->group(function () {
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    });

    Route::prefix('my-account')->name('my-account')->group(function () {
        Route::get('/', [MyAccountController::class, 'index'])->name('index');
    });
});
