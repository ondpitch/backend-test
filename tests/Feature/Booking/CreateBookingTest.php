<?php

use App\Enums\RoleStatus;
use App\Models\Booking;
use App\Models\User;
use App\Notifications\BookingCreated;
use Illuminate\Support\Facades\Notification;

test('can create booking', function () {
    User::factory(['email' => 'admin@bookings.com', 'password' => 'password', 'role' => RoleStatus::ADMIN->value])
        ->create();

    $user = User::factory()->create();
    $this->actingAs($user);

    $requestData = [
        'name' => 'John Doe',
        'title' => 'Test Title',
        'date' => now(),
        'email' => 'user@test.com',
    ];

    $response = $this->actingAs($user)->post('/book', $requestData);

    $response->assertRedirect('/my-bookings');
});

test('can see my bookings', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    Booking::factory()->count(3)->create([
        'user_id' => $user->id,
    ]);

    expect($user->bookings)->toHaveCount(3);
});

test('cannot see other users bookings', function () {
    $user1 = User::factory()->create();
    $user2 = User::factory()->create();
    $this->actingAs($user2);

    Booking::factory()->count(3)->create([
        'user_id' => $user2->id,
    ]);

    expect($user2->bookings)->toHaveCount(3);
    expect($user1->bookings)->toHaveCount(0);

});

test('can send email to admin after booking', function () {
    $this->seed();

    Notification::fake();

    $admin = User::where('role', RoleStatus::ADMIN->value)->first();

    $user = User::factory()->create();
    $this->actingAs($user);

    $newBooking = Booking::factory()->create([
        'user_id' => $user->id,
    ]);

    Notification::send([$admin], new BookingCreated($newBooking));

    Notification::assertSentTo($admin, BookingCreated::class);

});
