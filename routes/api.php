<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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
Route::get('/index', function () {
    return view('/index');
});

Route::post('/products', [ProductController::class, 'store']);
Route::get('/products', [ProductController::class, 'get']);
Route::get('/products/{id}', [ProductController::class, 'getById']);
Route::put('/products/{id}', [ProductController::class, 'updateById']);
Route::delete('/products/{id}', [ProductController::class, 'deleteById']);
