<?php

use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;
use App\Models\Booking;
use Livewire\WithPagination;

new class extends Component
{
    use WithPagination;

    public function with(): array
    {
        if (Auth::user()->is_admin()) {
            return [
                'bookings' => Booking::orderBy('created_at', 'desc')->paginate(10),
            ];
        }
        return [
            'bookings' => Booking::where('user_id', Auth::id())->orderBy('created_at', 'desc')->paginate(10),
        ];
    }

    public function refresh()
    {
        if (Auth::user()->is_admin()) {
            $this->bookings = Booking::orderBy('created_at', 'desc')->paginate(10);
        } else {
            $this->bookings = Booking::where('user_id', Auth::id())->orderBy('created_at', 'desc')->paginate(10);
        }
    }

}; ?>

<section
    x-on:saved.window="$wire.refresh;"
>
    <div class="overflow-hidden rounded-lg border border-gray-200 shadow-sm">
        <table class="w-full border-collapse bg-white text-left text-sm text-gray-500">
            <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-4 font-medium text-gray-900">Title</th>
                @if(Auth::user()->is_admin())
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">User</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">Email</th>
                @endif
                <th scope="col" class="px-6 py-4 font-medium text-gray-900">Booking date</th>
                <th scope="col" class="px-6 py-4 font-medium text-gray-900">Created On</th>
{{--                <th scope="col" class="px-6 py-4 font-medium text-gray-900"></th>--}}
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 border-t border-gray-100">
                @if($bookings->isEmpty())
                    <tr>
                        <td class="px-6 py-4 text-center" colspan="4">No bookings at the moment</td>
                    </tr>
                @endif
                @foreach($bookings as $booking)
                    <tr class="hover:bg-gray-50">
                        <th class="px-6 py-4 font-medium text-gray-900">{{ $booking->title }}</th>
                        @if(Auth::user()->is_admin())
                            <td class="px-6 py-4">{{ $booking->user->first_name }} {{ $booking->user->last_name }}</td>
                            <td class="px-6 py-4">{{ $booking->user->email }}</td>
                        @endif
                        <td class="px-6 py-4">{{ $booking->booking_date->toDayDateTimeString() }}</td>
                        <td class="px-6 py-4">{{ $booking->created_at->toDayDateTimeString() }}</td>
{{--                        <td class="flex justify-end gap-4 px-6 py-4 font-medium">--}}
{{--                            <a href="" class="text-primary-700">Edit</a>--}}
{{--                        </td>--}}
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="my-4 px-4">
            {!! $bookings->links() !!}
        </div>
    </div>
</section>
