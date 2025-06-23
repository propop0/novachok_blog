<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Blog\PostController;
use App\Http\Controllers\Api\Blog\BlogCategoryController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
//всы пости
Route::get('blog/posts', [PostController::class, 'index']);
//вивыд окремого посту
Route::get('blog/posts/{id}', [PostController::class, 'show']);
//категорії
Route::get('blog/categories', [BlogCategoryController::class, 'index']);
//crud категорій
Route::get('blog/categories/{id}', [BlogCategoryController::class, 'show']);
Route::put('blog/categories/{id}', [BlogCategoryController::class, 'update']);
Route::post('blog/categories', [BlogCategoryController::class, 'store']);
Route::delete('blog/categories/{id}', [BlogCategoryController::class, 'destroy']);
//пости
Route::get('blog/posts', [PostController::class, 'index']);
Route::get('blog/posts/{id}', [PostController::class, 'show']);
Route::post('blog/posts', [PostController::class, 'store']);
Route::put('blog/posts/{id}', [PostController::class, 'update']);
Route::delete('blog/posts/{id}', [PostController::class, 'destroy']);
