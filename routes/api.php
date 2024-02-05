<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/products', [\App\Http\Controllers\API\ProductController::class, 'index'] );
Route::get('/favorites', [\App\Http\Controllers\API\FavoriteController::class, 'index'] );
Route::post('/favorites', [\App\Http\Controllers\API\FavoriteController::class, 'store'] );
Route::delete('/favorites/{favorite}', [\App\Http\Controllers\API\FavoriteController::class, 'destroy'] );


