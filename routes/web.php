<?php

use App\Http\Controllers\Admin\AdminBookingController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\MyBookingsController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth', 'admin.redirect'])->group(function () {

    Route::get('/my-bookings', [MyBookingsController::class, 'index'])->name('my.bookings');

    Route::get('/book', [BookingController::class, 'create'])->name('booking.create');
    Route::post('/book', [BookingController::class, 'store'])->name('booking.store');

});

Route::middleware(['auth'])->prefix('admin')->group(function () {

    Route::get('/dashboard', [AdminBookingController::class, 'index'])->name('dashboard');

});

require __DIR__.'/auth.php';
