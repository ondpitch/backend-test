<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseTruncation;
use App\Models\User;

uses(DatabaseTruncation::class);

beforeEach(function () {
    // Any setup before each test
    parent::setUp();

    // Migrate and seed the database
    $this->artisan('migrate:fresh --seed');
});

it('can view the registration form', function () {
    $this->browse(function (Browser $browser) {
        $browser->visit('/register')
            ->assertSee('REGISTER');
    });
});

it(
    'can register with valid credentials',
    function () {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                ->type('#name', 'Love')
                ->type('#email', 'lovetgb@example.com')
                ->type('#password', 'secreteee')
                ->type('#password_confirmation', 'secreteee')
                ->press('REGISTER')
                ->waitForText('Dashboard', 10) // Increase the timeout to 10 seconds
                ->assertSee('Dashboard');
        });
    }
);
