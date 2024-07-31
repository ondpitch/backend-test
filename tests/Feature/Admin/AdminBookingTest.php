<?php

use App\Enums\RoleStatus;
use App\Models\Booking;
use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

test('can see all bookings', function () {
    $admin = User::factory(['email' => 'admin@bookings.com', 'password' => 'password', 'role' => RoleStatus::ADMIN->value])
        ->create();

    $this->actingAs($admin);

    Booking::factory()->count(5)->create();

    $response = $this->get('/admin/dashboard');

    $response->assertInertia(fn (Assert $page) => $page
        ->component('Admin/Index')->has('bookings.data', 5));
});
