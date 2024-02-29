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

Route::group(['prefix' => 'v1'], function () {
    Route::get('/google/redirect', [App\Http\Controllers\GoogleLoginController::class, 'redirectToAuth']);
    Route::get('/google/callback', [App\Http\Controllers\GoogleLoginController::class, 'handleAuthCallback']);
});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});