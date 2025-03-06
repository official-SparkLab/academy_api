<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
    
Route::resource('home',HomeController::class);
Route::resource('about',AboutController::class);
Route::resource('contact',ContactController::class);