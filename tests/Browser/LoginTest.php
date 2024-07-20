<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\User;

uses(DatabaseMigrations::class);

beforeEach(function () {
    // Any setup before each test
});

it('can view the login form', function () {
    $this->browse(function (Browser $browser) {
        $browser->visit('/login')
            ->assertSee('LOG IN');
    });
});

it('can log in with valid credentials', function () {
    $user = User::factory()->create([
        'email' => 'user@example.com',
        'password' => bcrypt('password')
    ]);

    $this->browse(function (Browser $browser) use ($user) {
        $browser->visit('/login')
            ->type('#email', $user->email)
            ->type('#password', 'password')
            ->check('#remember')
            ->press('LOG IN')
            ->waitForLocation('/dashboard')
            ->assertPathIs('/dashboard')
            ->assertSee('Dashboard');
    });
});
