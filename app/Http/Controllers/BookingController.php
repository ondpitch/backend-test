<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = auth()->user()->bookings;
        if (auth()->user()->role->slug === 'admin') $bookings = Booking::all();
        return Inertia::render('Dashboard', [
            'bookings' => $bookings,
        ]);
    }

    public function create()
    {
        return Inertia::render('Booking/Create');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'title' => ['required', 'max:255'],
            'date' => ['required', 'date'],
        ]);

        $attributes['user_id'] = auth()->user()->id;

        $booking = Booking::create($attributes);

        return redirect()->route('dashboard', $booking)->with('success', 'Booking created.');
    }

    public function edit(Booking $booking)
    {
        return Inertia::render('Bookings/creaate', [
            'booking' => [
                'title' => $booking->name,
                'date' => $booking->date,
            ],
        ]);
    }

    public function update(Request $request, Booking $booking)
    {
        $request->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email'],
            'phone' => ['required', 'max:255'],
            'date' => ['required', 'date'],
            'time' => ['required', 'date_format:H:i'],
        ]);

        $booking->update($request->all());

        return redirect()->route('bookings.edit', $booking);
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();

        return redirect()->route('dashboard');
    }
}
