<?php

use App\Enums\RoleStatus;
use App\Models\Booking;
use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

test('can see all bookings', function () {
    $this->seed();

    $admin = User::where('role', RoleStatus::ADMIN->value)->first();

    $this->actingAs($admin);

    Booking::factory()->count(5)->create();

    $response = $this->get('/admin/dashboard');

    $response->assertInertia(fn (Assert $page) => $page
        ->component('Admin/Index')->has('bookings.data', 5));
});
