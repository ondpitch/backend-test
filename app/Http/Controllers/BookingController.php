<?php

namespace App\Http\Controllers;

use App\Enums\RoleStatus;
use App\Http\Requests\Booking\CreateBookingRequest;
use App\Models\User;
use App\Notifications\BookingCreated;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Notification;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

class BookingController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(): InertiaResponse
    {
        return Inertia::render('Booking/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateBookingRequest $request): RedirectResponse
    {
        $admin = User::where('role', RoleStatus::ADMIN->value)->first();

        $user = auth()->user();
        $newBooking = $user->bookings()->create($request->validated());

        Notification::send([$admin], new BookingCreated($newBooking));

        return redirect()->route('my.bookings');
    }
}
