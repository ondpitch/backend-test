<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Bookings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg ">
                <div class="grid p-6 text-gray-900">
                    <div class="mb-8 flex justify-between items-center">
                        <span class="text-lg">
                            @if(!Auth::user()->is_admin())
                                {{ __("All your bookings") }}
                            @else
                                {{ __("All bookings") }}
                            @endif
                        </span>
                        @if(!Auth::user()->is_admin())
                            <livewire:bookings.new-booking-form />
                        @endif
                    </div>
                    @if(!Auth::user()->is_admin())
                        <div
                            x-data="{ showSuccessMessage: false }"
                            x-on:saved.window="
                                    showSuccessMessage = true;
                                    setTimeout(() => {
                                        showSuccessMessage = false;
                                    }, 2000);
                                "
                        >
                            <div
                                x-show="showSuccessMessage"
                                class="mb-8 text-green-700 text-sm bg-green-200 p-2 border border-green-900 rounded-lg">
                                Submitted successfully!!!
                            </div>
                        </div>
                    @endif
                    <div>
                        <livewire:bookings.bookings-table />
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
