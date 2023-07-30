<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserRestController;
use App\Http\Controllers\BookRestController;

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

Route::get('/user/all', [UserRestController::class, 'getUsers']);

Route::post('/user', [UserRestController::class, 'insert']);


Route::get('/book/all', [BookRestController::class, 'getBooks']);

Route::post('/book', [BookRestController::class, 'insert']);
