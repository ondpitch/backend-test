<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 flex flex-col gap-4 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="grid md:grid-cols-4 gap-6">
                    <div class="stats-card p-6 border border-gray-400 rounded-2xl shadow-sm">
                        <h5 class="text-base font-light text-gray-900 mb-2">
                            Total Bookings
                        </h5>
                        <h2 class="text-3xl text-gray-900 font-bold mb-2">
                            {{ number_format(\App\Models\Booking::count()) }}
                        </h2>
                    </div>
                </div>
                <div class="mb-6">
                    <a
                        href="{{ route('bookings') }}"
                        class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        @if(Auth::user()->is_admin())
                            {{ __('See All Bookings') }}
                        @else
                            {{ __('See All My Bookings') }}
                        @endif
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
