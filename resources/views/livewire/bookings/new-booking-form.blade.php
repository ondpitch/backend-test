<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;
use App\Livewire\Forms\BookingForm;

new class extends Component
{
    public BookingForm $form;

    /**
     * Delete the currently authenticated user.
     */
    public function saveBooking(): void
    {
        $this->validate();

        $booking = $this->form->saveBooking();

        $this->dispatch('saved', 'new-user-form');

        event(new \App\Events\NewBooking($booking));

        $this->reset('form.title', 'form.booking_date');
    }
}; ?>

<section class="space-y-6">
    <x-primary-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'new-user-form')"
        class="ms-3">
        {{ __('New Booking') }}
    </x-primary-button>

    <x-modal name="new-user-form" :show="$errors->isNotEmpty()" focusable>
        <form wire:submit="saveBooking" class="p-6">

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Create new booking') }}
            </h2>

            <div class="mt-6">
                <div>
                    <x-input-label for="title" :value="__('Title')" />
                    <x-text-input wire:model="form.title" id="title" class="block mt-1 w-full" type="text" name="title" required autofocus placeholder="Enter a title or describe" />
                    <x-input-error :messages="$errors->get('form.title')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="booking_date" :value="__('Booking date')" />
                    <x-text-input wire:model="form.booking_date" id="booking_date" class="block mt-1 w-full" type="datetime-local" name="booking_date" required />
                    <x-input-error :messages="$errors->get('form.booking_date')" class="mt-2" />
                </div>
            </div>

            <div class="mt-6 flex gap-2 justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-primary-button>
                    {{ __('Submit') }}
                </x-primary-button>
            </div>
        </form>
    </x-modal>
</section>
