<x-mail::message>
    <h1>Hello Admin</h1>

    A new booking has been record. <br>
    Title: {{ $booking->title }} <br>
    First name: {{ $booking->firstname }} <br>
    Date of booking: {{ $booking->date_of_booking }}

    <x-mail::button :url="$url">
        Button Text
    </x-mail::button>

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
