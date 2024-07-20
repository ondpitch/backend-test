<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = auth()->user()->bookings()->latest();
        if (auth()->user()->role->slug === 'admin') $bookings = Booking::latest();
        return Inertia::render('Dashboard', [
            'bookings' => $bookings->filter(request(['start', 'end', 'search']))->get(),
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

        return redirect()->route('dashboard')->with('success', 'Booking created.');
    }

    public function edit(Booking $booking)
    {
        return Inertia::render('Booking/Edit', [
            'booking' => [
                'id' => $booking->id,
                'title' => $booking->title,
                'date' => $booking->date,
            ],
        ]);
    }

    public function update(Request $request, Booking $booking)
    {
        $attributes = $request->validate([
            'title' => ['max:255'],
            'date' => ['date'],
        ]);

        $booking->update($attributes);

        return redirect()->route('dashboard')->with('success', 'Booking updated');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();

        return redirect()->route('dashboard')->with('success', 'Booking deleted');
    }
}
