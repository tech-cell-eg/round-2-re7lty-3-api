<?php

use App\Http\Controllers\Blade\PlanController;
use App\Http\Controllers\Blade\ServiceController;
use App\Http\Controllers\Blade\TripController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\AuthAdmin;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\Blade\ReviewController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return redirect()->route('home');
})->middleware(['auth', 'verified'])->name('dashboard');

//setting
Route::middleware('auth')->group(function () {
    Route::get('/settings', function () {
        return view('profile.settings');
    })->name('settings');

    Route::put('/email', [EmailController::class, 'update'])->name('email.update');
    Route::put('/change-password', [ChangePasswordController::class, 'update'])->name('password.change');
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});


Route::middleware('auth')->group(function () {
    Route::get('/my-profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
   });

require __DIR__.'/auth.php';

// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//admin
Route::middleware(['auth',AuthAdmin::class])->group(function () {
    Route::get('/trip', [TripController::class, 'index'])->name('trip.index');

    Route::get('/trip/create', [TripController::class, 'create'])->name('trip.create');
    Route::post('/trip', [TripController::class, 'store'])->name('trip.store');

    Route::get('/trip/{id}/edit', [TripController::class, 'edit'])->name('trip.edit');
    Route::put('/trip/{id}', [TripController::class, 'update'])->name('trip.update');

    Route::delete('/trip/{id}', [TripController::class, 'destroy'])->name('trip.destroy');


    //plan
    Route::get('/plan', [PlanController::class, 'index'])->name('plan.index');

    Route::get('/plan/create', [PlanController::class, 'create'])->name('plan.create');
    Route::post('/plan', [PlanController::class, 'store'])->name('plan.store');

    Route::get('/plan/{id}/edit', [PlanController::class, 'edit'])->name('plan.edit');
    Route::put('/plan/{id}', [PlanController::class, 'update'])->name('plan.update');

    Route::delete('/plan/{id}', [PlanController::class, 'destroy'])->name('plan.destroy');

    //services
    Route::get('/service', [ServiceController::class, 'index'])->name('service.index');

    Route::get('/service/create', [ServiceController::class, 'create'])->name('service.create');
    Route::post('/service', [ServiceController::class, 'store'])->name('service.store');

    Route::get('/service/{id}/edit', [ServiceController::class, 'edit'])->name('service.edit');
    Route::put('/service/{id}', [ServiceController::class, 'update'])->name('service.update');

    Route::delete('/service/{id}', [ServiceController::class, 'destroy'])->name('service.destroy');

    //reviews
    Route::get('/review', [ReviewController::class, 'index'])->name('review.index');

    Route::get('/review/create', [ReviewController::class, 'create'])->name('review.create');
    Route::post('/review', [ReviewController::class, 'store'])->name('review.store');

    Route::get('/review/{id}/edit', [ReviewController::class, 'edit'])->name('review.edit');
    Route::put('/review/{id}', [ReviewController::class, 'update'])->name('review.update');

    Route::delete('/review/{id}', [ReviewController::class, 'destroy'])->name('review.destroy');
});

