<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContactEnquiryController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\FacultyController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
    
Route::resource('home',HomeController::class);
Route::resource('about',AboutController::class);
Route::resource('contact',ContactController::class);
Route::resource('contact-enquiry',ContactEnquiryController::class);
Route::resource('gallery',GalleryController::class);
Route::resource('faculty',FacultyController::class);
