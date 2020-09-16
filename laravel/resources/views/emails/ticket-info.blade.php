<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Support Ticket Informatie</title>
</head>
<body>
    <p>
        Bedankt {{ ucfirst(request()->name) }} voor het contact opnemen met onze support. Een support ticket is geopend!.<br>
        Er zal zo snel mogelijk contact opgenomen worden met u, hierbij uw gegevens :
    </p>

    <p>Titel: {{ $ticket->title }}</p>
    <p>Prioriteit: {{ $ticket->priority }}</p>
    <p>Status: {{ $ticket->status }}</p>
    <p>Beschrijving: {{ $ticket->content }}</p>
    <br>
    <p>

    </p>

</body>
</html>
