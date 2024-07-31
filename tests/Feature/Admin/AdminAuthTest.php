<?php

use App\Enums\RoleStatus;
use App\Models\User;

it('allows an admin user to log in', function () {
    User::factory(['email' => 'admin@bookings.com', 'password' => 'password', 'role' => RoleStatus::ADMIN->value])
        ->create();

    // Attempt to log in as the admin
    $response = $this->post('/login', [
        'email' => 'admin@bookings.com',
        'password' => 'password',
    ]);

    $response->assertStatus(302);

});
