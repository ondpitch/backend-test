<?php

use App\Http\Middleware\admin;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Booking\BookingCreate;
use App\Livewire\Booking\BookingIndexing;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', Login::class)->name('login');
Route::get('/register', Register::class)->name('register');

Route::get('/logout', function () {
    auth()->logout();
    Notification::make()->title('Bye Bye')->send();
    return redirect('/login');
})->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/bookings', BookingIndexing::class)->name('booking.index');
    Route::get('/booking-create', BookingCreate::class)->name('booking.create');

    Route::get('/admin-dashboard', Dashboard::class)->name('admin.dashboard')->middleware(admin::class);
});
