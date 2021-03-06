<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PlaybackController;
use App\Http\Controllers\TrackController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::name('tracks.')->prefix('tracks')->group(function () {
    Route::get('/', [TrackController::class, 'index'])->name('index');
    Route::get('/{track:id}', [TrackController::class, 'show'])->name('show');
    Route::post('/', [TrackController::class, 'store'])->name('store');
    Route::put('/{track:id}', [TrackController::class, 'update'])->name('update');
    Route::delete('/{track:id}', [TrackController::class, 'destroy'])
           ->name('destroy');
});

Route::name('playbacks.')->prefix('playbacks')->group(function () {
    Route::post('/', [PlaybackController::class, 'store'])->name('store')->middleware('auth.basic');
    Route::delete('/{playback:id}', [PlaybackController::class, 'destroy'])->name('destroy');
});

Route::name('users.')->prefix('users')->group(function () {
    Route::get('/me', [UserController::class, 'get'])->middleware('auth:sanctum')->name('get');
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::post('/', [UserController::class, 'store'])->name('store');
    Route::get('/{user:id}', [UserController::class, 'show'])->name('show');
    Route::put('/{user:id}', [UserController::class, 'update'])->name('update');
    Route::delete('/{user:id}', [UserController::class, 'destroy'])->name('destroy');
});

Route::name('auth.')->prefix('auth')->group(function () {
    Route::post('token', [AuthController::class, 'requestToken'])->name('token');
    Route::delete('token', [AuthController::class, 'unauthenticate'])->name('unauthenticate')->middleware('auth:sanctum');
});
