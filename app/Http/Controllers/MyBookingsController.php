<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class MyBookingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $myBookings = auth()->user()->bookings()
            ->select('name', 'title', 'date', 'email')
            ->paginate(10);

        return Inertia::render('MyBookings', [
            'bookings' => $myBookings,
        ]);

    }
}
