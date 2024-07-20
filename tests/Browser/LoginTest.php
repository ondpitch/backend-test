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
