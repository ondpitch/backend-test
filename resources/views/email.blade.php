<!DOCTYPE html>
<html>

<head>
	<title>Booking Created</title>
</head>

<body>
	<h1>Booking Created</h1>
	<p>A new booking has been created with the following details:</p>
	<ul>
		<li>Title: {{ $booking->title }}</li>
		<li>Date: {{ $booking->date }}</li>
		<li>User FirstName: {{ $booking->owner->name }}</li>
		<li>User Email: {{ $booking->owner->email }}</li>
	</ul>
</body>

</html>
