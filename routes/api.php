<?php

use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ServiceController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//trips
Route::prefix('trips')->name('trips.')->controller(TripController::class)->group(function () {
    Route::get('/', 'index')->name('index');  // Show all trips
    Route::get('/{id}', 'show')->name('show'); // Show trip by ID
    Route::post('/', 'store')->name('store');  // Create a new trip
    Route::put('/{id}', 'update')->name('update'); // Update a trip
    Route::delete('/{id}', 'destroy')->name('destroy'); // Delete a trip
});

//sevices
Route::prefix('services')->name('services.')->controller(ServiceController::class)->group(function () {
    Route::get('/', 'index')->name('index');  // Show all services
    Route::get('/{id}', 'show')->name('show'); // Show service by ID
    Route::post('/', 'store')->name('store');  // Create a new service
    Route::put('/{id}', 'update')->name('update'); // Update a service
    Route::delete('/{id}', 'destroy')->name('destroy'); // Delete a service
});

//plans
//to show all paln
Route::prefix('plans')->name('plans.')->controller(PlanController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/{id}', 'show')->name('show'); // Show plans by ID
    Route::post('/', 'store')->name('store');  // Create a new plans
    Route::put('/{id}', 'update')->name('update'); // Update a plans
    Route::delete('/{id}', 'destroy')->name('destroy'); // Delete a plans
});

//reviews
Route::prefix('reviews')->name('reviews.')->controller(ReviewController::class)->group(function () {
    // Show all reviews
    Route::get('/', 'index')->name('index');
    // Show review by ID
    Route::get('/{id}', 'show')->name('show');
    // Create a new review
    Route::post('/', 'store')->middleware('auth:sanctum')->name('store');
    // Update a review
    Route::put('/{id}', 'update')->middleware('auth:sanctum')->name('update');
    // Delete a review
    Route::delete('/{id}', 'destroy')->middleware('auth:sanctum')->name('destroy');
});

//contact us
Route::prefix('contacts')->name('contacts.')->controller(ContactController::class)->group(function () {
    // Show all contact messages
    Route::get('/', 'index')->name('index');
    // Show a specific contact message by ID
    Route::get('/{id}', 'show')->name('show');
    // Send a new contact message
    Route::post('/', 'store')->middleware('auth:sanctum')->name('store');
    // Delete a contact message
    Route::delete('/{id}', 'destroy')->name('destroy');
});

