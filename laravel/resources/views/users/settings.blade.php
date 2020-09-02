@extends('layouts.app')

@section('content')
<div class="page-wrapper">

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Instellingen</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container p-5">

        <div class="col-12">
            <div class="mb-3">@include('layouts.messages')</div>
        </div>

        <div class="card" style="font-family: Nunito-sans, sans-serif">
            <div class="card-body">
                <h5 class="card-title d-inline mt-5">Account gegevens bewerken</h5>
            </div>
                <form action="{{action('UsersController@editData', $user->id)}}" method="POST" class="w-75 mx-auto p-3 pb-5">
                    @csrf
                    <div class="form-group">
                        <label for="name">Naam</label>
                        <input type="text" class="form-control mb-3" placeholder="Gebruikersnaam" value="{{ $user->name }}" name="name">

                        <label for="email">Email</label>
                        <input type="text" class="form-control mb-3" placeholder="E-mail" value="{{ $user->email }}" name="email">

                        <label for="password">Wachtwoord</label>
                        <input type="password" class="form-control mb-3" placeholder="Wachtwoord" name="password">

                        <label for="password-conformation">Herhaal Wachtwoord</label>
                        <input type="password" class="form-control mb-3" placeholder="Herhaal wachtwoord" name="password_conformation">

                        <div class="form-row justify-content-center">
                            <div class="form-group col-6">
                                <label for="wage">Uurloon ( in € )</label>
                                <input type="number" class="form-control mb-3" placeholder="Uurloon in €" value="{{ $user->wage }}" name="wage">
                            </div>
                            <div class="form-group col-6">
                                <label for="vat">BTW tarief ( standaard 21% )</label>
                                <input type="number" class="form-control mb-3" placeholder="BTW tarief in %" value="{{ $user->vat }}" name="vat">
                            </div>
                        </div>


                        @role('admin')
                        <label for="role">Gebruikers rol</label>
                        <select name="role" id="" class="form-control col-3">

                            @if($currentRole['role_id'] == 1)
                                <option value="{{$currentRole['role_id']}}">Gebruiker</option>
                            @elseif($currentRole['role_id'] == 2)
                                <option value="{{$currentRole['role_id']}}">Developer</option>
                            @else
                                <option value="{{$currentRole['role_id']}}">Administrator</option>
                            @endif

                            @foreach($roles as $role)
                                <option value="{{$role->id}}">{{$role->name}}</option>
                            @endforeach
                        </select>
                        @endrole

        {{--                <label for="tarief">Uur Tarief</label>--}}
        {{--                <input type="text" class="form-control" placeholder="&euro;1.00/u" name="tarief">--}}

        {{--                <label for="btw">Btw</label>--}}
        {{--                <input type="text" class="form-control" placeholder="0.21%" name="btw">--}}

                    </div>
                    <input type="submit" value="update" class="btn btn-info">
                    <a href="{{ url('/') }}" class="btn btn-primary">Ga terug</a>
                </form>
        </div>
    </div>
</div>
@endsection
