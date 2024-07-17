<?php

namespace App\Livewire\Forms;

use App\Models\Booking;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Validate;
use Livewire\Form;

class BookingForm extends Form
{
    #[Validate('required|string|max:255')]
    public string $title = '';

    #[Validate('required|date|after:today')]
    public string $booking_date = '';

    public function saveBooking(): Booking
    {
        $this->validate();
        return Booking::create([
            'user_id' => auth()->id(),
            'title' => $this->title,
            'booking_date' => $this->booking_date,
        ]);
    }
}
