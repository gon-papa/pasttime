<?php

use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\BlogController;
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
});