<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\AttendeeController;
use App\Http\Controllers\Api\LocationController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/login',[AuthController::class,'login'])->name('auth.login');
Route::post('/logout',[AuthController::class,'logout'])->name('auth.logout')->middleware('auth:sanctum');
// Unprotected routes
Route::apiResource('events', EventController::class)
    ->only(['index', 'show']);

// Protected routes
Route::apiResource('events', EventController::class)
    ->except(['index', 'show'])
    ->middleware('auth:sanctum');

// Unprotected routes
Route::apiResource('events.attendees', AttendeeController::class)
    ->only(['index', 'show'])
    ->scoped();
// Protected routes
Route::apiResource('events.attendees', AttendeeController::class)
    ->except(['index', 'show', 'update'])
    ->scoped()
    ->middleware('auth:sanctum');

Route::apiResource('locations',LocationController::class)
    ->only(['index','show']);
    Route::apiResource('locations', AttendeeController::class)
    ->except(['index', 'show']);
    //->middleware('auth:sanctum');
