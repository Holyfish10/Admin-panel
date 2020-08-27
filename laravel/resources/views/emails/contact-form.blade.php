@component('mail::message')

Nieuw bericht van : <strong>{{ $data['name'] }} <span>{{ $data['email'] }}</span> </strong>

<p>Onderwerp: {{ $data['subject'] }} </p>

<strong><p>Bericht: </p></strong>

{{ $data['message'] }}

@endcomponent
