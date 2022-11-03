<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use \App\Http\Controllers\ClassController;
use App\Http\Controllers\ProductController;
use \App\Http\Controllers\StudentController;

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

Route::post('/admin/login', [AdminController::class, 'login']);

Route::group([
    'middleware' => [
        'auth:admin'
    ],
], function (){
    Route::post('/products', [ProductController::class, 'store']);
    Route::get('/products', [ProductController::class, 'get']);
    Route::get('/products/{id}', [ProductController::class, 'getById']);
    Route::put('/products/{id}', [ProductController::class, 'updateById']);
    Route::delete('/products/{id}', [ProductController::class, 'deleteById']);

    Route::post('/student', [StudentController::class, 'store']);
    Route::get('/student', [StudentController::class, 'get']);
    Route::get('/student/{id}', [StudentController::class, 'getById']);

    Route::post('/class', [ClassController::class, 'store']);
    Route::get('/class', [ClassController::class, 'get']);
    Route::get('/class/{id}', [ClassController::class, 'getById']);
});
