<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Support Ticket Status</title>
</head>
<body>
    <p>
        Beste {{ ucfirst($ticket->name) }},
    </p>
    <p>
        Uw support ticket met ticket ID #{{ $ticket->ticket_id }} is gemarkeerd als opgelost en is gesloten.
    </p>
</body>
</html>
