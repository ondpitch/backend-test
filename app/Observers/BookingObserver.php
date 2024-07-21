<?php

namespace App\Observers;

use App\Mail\BookingCreated;
use App\Models\Booking;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class BookingObserver
{
    /**
     * Handle the Booking "created" event.
     */
    public function created(Booking $booking): void
    {
        try {
            // Attempt to send email notification
            Mail::to('admin@bookings.com')->send(new BookingCreated($booking));

            // Log the email sent
            Log::info(
                'Meeting scheduled email sent to admin.' .
                    'Name: ' . $booking->owner->name . ' Email: ' . $booking->owner->email .
                    'Meeting Date: ' . $booking->date . ' Meeting Title: ' . $booking->title
            );
        } catch (\Exception $e) {
            // Log the error message
            Log::error('Failed to send meeting scheduled email: ' . $e->getMessage());
        }
    }

    /**
     * Handle the Booking "updated" event.
     */
    public function updated(Booking $booking): void
    {
        //
    }

    /**
     * Handle the Booking "deleted" event.
     */
    public function deleted(Booking $booking): void
    {
        //
    }

    /**
     * Handle the Booking "restored" event.
     */
    public function restored(Booking $booking): void
    {
        //
    }

    /**
     * Handle the Booking "force deleted" event.
     */
    public function forceDeleted(Booking $booking): void
    {
        //
    }
}
