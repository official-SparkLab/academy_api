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
use App\Http\Controllers\ResultSectionController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\ChatbotController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
    
Route::resource('home',HomeController::class);
Route::resource('about',AboutController::class);
Route::resource('contact',ContactController::class);
Route::resource('contact-enquiry',ContactEnquiryController::class);
Route::resource('gallery',GalleryController::class);
Route::resource('faculty',FacultyController::class);
Route::resource('course',CourseController::class);
Route::resource('result-section',ResultSectionController::class);
Route::resource('result',ResultController::class);
Route::resource('chatbot',ChatbotController::class);

Route::resource('signup',SignupController::class);

