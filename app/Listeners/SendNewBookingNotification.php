<?php

namespace App\Listeners;

use App\Events\NewBooking;
use App\Models\Booking;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendNewBookingNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(NewBooking $event): void
    {
        $booking = $event->booking;

        // send email
        Mail::send(new \App\Mail\NewBooking($booking));
    }
}
