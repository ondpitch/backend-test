<?php

namespace Tests\Feature\Dashboard;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Livewire\Volt\Volt;
use Tests\TestCase;

class BookingTest extends TestCase
{
    use RefreshDatabase;

    public function test_booking_cannot_be_created_if_title_or_date_not_provided_validation_error(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $component = Volt::test('bookings.new-booking-form')
            ->set('form.title', '')
            ->set('form.booking_date', '')
            ->call('saveBooking');

        $component
            ->assertHasErrors([ 'form.title', 'form.booking_date']);

    }

    public function test_booking_cannot_be_created_if_date_is_in_the_past(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $pastDate = Carbon::now()->subDay()->format('Y-m-d');

        $component = Volt::test('bookings.new-booking-form')
            ->set('form.title', 'Test Title')
            ->set('form.booking_date', $pastDate)
            ->call('saveBooking');

        $component
            ->assertHasErrors([ 'form.booking_date' => 'after:today']);

    }

    public function test_booking_can_be_created(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $component = Volt::test('bookings.new-booking-form')
            ->set('form.title', 'New Title')
            ->set('form.booking_date', now()->addMinutes(30))
            ->call('saveBooking');

        $component
            ->assertHasNoErrors('form.title')
            ->assertHasNoErrors('form.booking_date');

    }
}
