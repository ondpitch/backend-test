<?php

namespace App\Actions;

use App\Enums\RoleStatus;
use App\Models\User;
use App\Notifications\BookingCreated;
use Illuminate\Support\Facades\Notification;

class CreateBooking
{
    public function execute($data)
    {

        $admin = User::where('role', RoleStatus::ADMIN->value)->first();

        $user = auth()->user();
        $newBooking = $user->bookings()->create($data);

        Notification::send([$admin], new BookingCreated($newBooking));
    }
}
