<?php

it('allows an admin user to log in', function () {
    $this->seed();

    // Attempt to log in as the admin
    $response = $this->post('/login', [
        'email' => 'admin@bookings.com',
        'password' => 'password',
    ]);

    $response->assertStatus(302);

});
