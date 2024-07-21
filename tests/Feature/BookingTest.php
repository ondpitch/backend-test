<?php

use App\Models\User;
use App\Models\Booking;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\actingAs;

uses(RefreshDatabase::class)->group('BookingController');

it('can view the dashboard with bookings', function () {
    $user = User::factory()->create();
    Booking::factory()->for($user, 'owner')->count(3)->create();

    actingAs($user)
        ->get(route('dashboard'))
        ->assertStatus(200)
        ->assertInertia(
            fn ($page) => $page
                ->component('Dashboard')
                ->has('bookings', 3)
        );
});

it('can create a new booking', function () {
    $user = User::factory()->create();
    $bookingData = [
        'title' => 'Test Booking',
        'date' => '2024-01-01',
    ];

    actingAs($user)
        ->post(route('bookings.store'), $bookingData)
        ->assertRedirect(route('dashboard'))
        ->assertSessionHas('success', 'Booking created.');

    $this->assertDatabaseHas('bookings', $bookingData + ['user_id' => $user->id]);
});

it('can update a booking', function () {
    $user = User::factory()->create();
    $booking = Booking::factory()->for($user, 'owner')->create();
    $updatedData = [
        'title' => 'Updated Booking Title',
        'date' => '2024-01-02',
    ];

    actingAs($user)
        ->patch(route('bookings.update', $booking), $updatedData)
        ->assertRedirect(route('dashboard'))
        ->assertSessionHas('success', 'Booking updated');

    $this->assertDatabaseHas('bookings', $updatedData + ['id' => $booking->id]);
});

it('can delete a booking', function () {
    $user = User::factory()->create();
    $booking = Booking::factory()->for($user, 'owner')->create();

    actingAs($user)
        ->delete(route('bookings.destroy', $booking))
        ->assertRedirect(route('dashboard'))
        ->assertSessionHas('success', 'Booking deleted');

    $this->assertDatabaseMissing('bookings', ['id' => $booking->id]);
});
