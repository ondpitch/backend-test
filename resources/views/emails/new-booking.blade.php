<h2>
    New booking from {{ $booking->user->first_name }}.
</h2>
<h3>Details</h3>
<p>
    <strong>Title:</strong> {{ $booking->title }}<br>
    <strong>User:</strong> {{ $booking->user->first_name }} {{ $booking->user->last_name }}<br>
    <strong>Booking date:</strong> {{ $booking->booking_date->toDayDateTimeString() }}
</p>
