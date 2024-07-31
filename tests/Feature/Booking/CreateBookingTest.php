<?php

use App\Models\Booking;
use App\Models\User;

test('can create booking', function () {

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
