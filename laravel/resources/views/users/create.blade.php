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
                            <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Gebruikers</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Nieuwe gebruiker</li>
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

        <h3>Gebruiker aanmaken</h3>

        <form action="{{action('UsersController@store')}}" method="POST">
        @csrf
        @method('POST')
          <div class="form-group">
            <label for="name">Gebruikersnaam</label>
              <input type="text" class="form-control mb-3" placeholder="Naam" name="name" value="{{old('name')}}">
            <label for="content">E-mail</label>
              <input type="text" class="form-control mb-3" placeholder="E-mail" name="email" value="{{old('email')}}">
            <label for="content">Rol</label>
              <div class="form-group">
                  <select name="role" class="custom-select form-control col-3">
                      <option value="1" selected>Gebruiker</option>
                      <option value="2">Developer</option>
                      <option value="3">Administrator</option>
                  </select>
              </div>
            <label for="password">Wachtwoord</label>
              <input type="password" class="form-control mb-3" placeholder="Wachtwoord" name="password">
            <label for="password_confirm">Wachtwoord herhalen</label>
              <input type="password" class="form-control" placeholder="Wachtwoord herhalen" name="password_confirmation">
          </div>
          <input type="submit" value="Aanmaken" class="btn btn-info">
          <a href="{{ route('users.index') }}" class="btn btn-primary">Ga terug</a>
        </form>
    </div>
</div>
@endsection
