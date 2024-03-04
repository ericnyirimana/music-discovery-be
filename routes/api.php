<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\AlbumController;

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

Route::prefix('v1')->group(function () {
    Route::get('/google/redirect', [App\Http\Controllers\GoogleLoginController::class, 'redirectToAuth']);
    Route::get('/google/callback', [App\Http\Controllers\GoogleLoginController::class, 'handleAuthCallback']);
    Route::resource('artists', ArtistController::class)->middleware('auth:sanctum');
    Route::resource('albums', AlbumController::class)->middleware('auth:sanctum');
});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});