<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix('auth')->name('auth.')->group(function () {
    Route::post('register', [\App\Http\Controllers\Auth\RegisteredUserController::class, 'store'])->name('register');
    Route::post('login', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'store'])->name('login');
    Route::middleware(['auth:sanctum'])
        ->post('logout', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
    Route::middleware(['auth:sanctum'])
        ->get('me', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'me'])
        ->name('me');
    Route::middleware(['auth:sanctum'])
        ->post('change-password', [\App\Http\Controllers\Auth\NewPasswordController::class, 'change_password'])
        ->name('change-password');

});

Route::middleware(['auth:sanctum'])->prefix('panel')->name('panel.')->group(function () {
    Route::apiResource('users', \App\Http\Controllers\Panel\UserController::class);
    Route::apiResource('categories', \App\Http\Controllers\Panel\CategoryController::class);
    Route::apiResource('articles', \App\Http\Controllers\Panel\ArticleController::class);
    Route::put('article-star/{article}', [\App\Http\Controllers\Panel\ArticleController::class, 'star'])->name('article-star');
    Route::get('category-parent', [\App\Http\Controllers\Panel\CategoryController::class, 'parent'])
        ->name('parent');
    Route::get('category-all', [\App\Http\Controllers\Panel\CategoryController::class, 'all'])
        ->name('all');
});
