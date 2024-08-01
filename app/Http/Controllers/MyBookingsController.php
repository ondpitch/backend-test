<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

class MyBookingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): InertiaResponse
    {
        $myBookings = auth()->user()->bookings()
            ->select('title', 'date')
            ->paginate(10);

        return Inertia::render('Booking/MyBookings', [
            'bookings' => $myBookings,
        ]);

    }
}
