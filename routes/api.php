<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Blog\PostController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
//всы пости
Route::get('blog/posts', [PostController::class, 'index']);
//вивыд окремого посту
Route::get('blog/posts/{id}', [PostController::class, 'show']);
