<?php

use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\BlogController;
use App\Http\Controllers\api\ImageController;
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

Route::post('/login', [UserController::class, 'login']);
Route::get('/logout', [UserController::class, 'logout']);

Route::middleware('auth:sanctum')->group(function(){
    Route::get('/user', [UserController::class, 'show']);
    Route::get('/admin/blogs/index', [BlogController::class, 'index']);
    Route::post('/admin/blogs/store', [BlogController::class, 'store']);
    Route::get('/admin/blogs/show/{id}', [BlogController::class, 'show']);
    Route::get('/admin/blogs/edit/{id}', [BlogController::class, 'edit']);
    Route::post('/admin/blogs/update/{id}', [BlogController::class, 'update']);
    Route::delete('/admin/blogs/delete/{id}', [BlogController::class, 'delete']);
    Route::get('/admin/images', [ImageController::class, 'index']);
    Route::post('/admin/blog/image', [ImageController::class, 'store']);
    Route::delete('/admin/blog/image', [ImageController::class, 'destroy']);
});