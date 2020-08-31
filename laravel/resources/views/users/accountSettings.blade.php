@extends('layouts.app')

@section('content')
    <div class="container p-5">
        <h3>Account gegevens veranderen</h3>
        @csrf
        <form action="{{action('UsersController@editData', Auth::user()->id)}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Naam</label>
                <input type="text" class="form-control" placeholder="{{ Auth::user()->name }}" name="name">

                <label for="email">Email</label>
                <input type="text" class="form-control" placeholder="{{ Auth::user()->email }}" name="email">

                <label for="password">Wachtwoord</label>
                <input type="password" class="form-control" placeholder="*********" name="password">

                <label for="password-conformation">Herhaal Wachtwoord</label>
                <input type="password" class="form-control" placeholder="*********" name="password_conformation">

{{--                <label for="tarief">Uur Tarief</label>--}}
{{--                <input type="text" class="form-control" placeholder="&euro;1.00/u" name="tarief">--}}

{{--                <label for="btw">Btw</label>--}}
{{--                <input type="text" class="form-control" placeholder="0.21%" name="btw">--}}

            </div>
            <input type="submit" value="update" class="btn btn-info">
            <a href="{{ route('sites.index') }}" class="btn btn-primary">Ga terug</a>
        </form>
    </div>


@endsection
