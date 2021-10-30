<!DOCTYPE html>
<html>
<head>
    <title>Payment confirmation</title>
</head>
<body>
<h2>Dear {$reservation->name},</h2>
<h3>Thank you for your payment. Here are the details of your reservation:</h3>
<p>Location: {$reservation->destination->name}, {$reservation->destination->location}</p>
<p>Arrival: {$reservation->arrival}</p>
<p>Departure: {$reservation->departure}</p>
</body>
</html>
