<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\LibraryController;

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

Route::post('/login', [UserController::class, 'login']);

Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::post('/category', [LibraryController::class, 'addCategory']);
    Route::post('/book', [LibraryController::class, 'addBook']);
});

Route::middleware(['auth:sanctum', 'siswa'])->group(function () {
    Route::post('/borrow', [LibraryController::class, 'borrowBook']);
    // Route::post('/return', [LibraryController::class, 'returnBook']);
    Route::get('/books', [LibraryController::class, 'getBooks']);
});

Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::post('/admin/register_admin', [UserController::class, 'register_admin']);
    Route::post('/admin/register_siswa', [UserController::class, 'register_siswa']);
    Route::post('/logout', [UserController::class, 'logout']);
});
