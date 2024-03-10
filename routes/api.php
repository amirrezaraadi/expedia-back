<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix('auth')->name('auth.')->group(function () {
   Route::post('register' , [ \App\Http\Controllers\Auth\RegisteredUserController::class , 'store'] )->name('register');
   Route::post('login' , [ \App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'store'] )->name('login');
   Route::middleware(['auth:sanctum'])->post('logout' , [ \App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy'] )->name('logout');
});

Route::prefix('panel')->name('panel.')->group(function () {
   Route::apiResource('users' , \App\Http\Controllers\Panel\UserController::class);
});
