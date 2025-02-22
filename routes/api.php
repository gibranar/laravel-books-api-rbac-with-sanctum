<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/books', [BookController::class, 'index'])->middleware('permission:read book');
    Route::post('/books', [BookController::class, 'store'])->middleware('permission:create book');
    Route::get('/books/{id}', [BookController::class, 'show'])->middleware('permission:read book');
    Route::put('/books/{id}', [BookController::class, 'update'])->middleware('permission:update book');
    Route::delete('/books/{id}', [BookController::class, 'destroy'])->middleware('permission:delete book');
});
