<?php

namespace App\Http\Controllers;

use App\Http\Requests\Booking\CreateBookingRequest;
use Illuminate\Http\RedirectResponse;
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
        $user = auth()->user();
        $user->bookings()->create($request->validated());

        return redirect()->route('my.bookings');
    }
}
