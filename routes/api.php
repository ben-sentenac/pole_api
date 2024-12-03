<?php

use App\Http\Controllers\Api\AttendeeController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EventController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/login',[AuthController::class,'login'])->name('auth.login');

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
