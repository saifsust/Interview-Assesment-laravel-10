<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserRestController;
use App\Http\Controllers\BookRestController;
use App\Http\Controllers\IssueController;

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


Route::post('/login', [UserRestController::class, 'login']);

Route::get('/user/all', [UserRestController::class, 'getUsers']);

Route::post('/user', [UserRestController::class, 'insert']);


Route::get('/book/all', [BookRestController::class, 'getBooks']);

Route::post('/book', [BookRestController::class, 'insert']);

Route::post('/book/issue', [IssueController::class, 'issued']);

Route::post('/book/return', [IssueController::class, 'returned']);

Route::get('/book/user/{userId}', [IssueController::class, 'getBookByUserId']);

Route::get('/book/{bookId}', [IssueController::class, 'getUserByBookId']);