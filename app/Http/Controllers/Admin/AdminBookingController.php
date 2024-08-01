<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

class AdminBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): InertiaResponse
    {
        $bookings = Booking::with('user')->latest()->paginate(10);

        return Inertia::render('Admin/Index', [
            'bookings' => $bookings,
        ]);
    }
}
