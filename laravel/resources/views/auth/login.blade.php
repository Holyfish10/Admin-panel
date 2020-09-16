@extends('layouts.app')

@section('content')
<div class="auth-wrapper d-flex no-block justify-content-center align-items-center bg-dark">
    <div class="auth-box bg-dark border-top border-secondary">
        <div id="loginform">
            <div class="text-center p-t-20 p-b-20">
                <span class="db"><img src="{{asset('assets/images/logo.png') }}" alt="logo" /></span>
            </div>
            <!-- Form -->
            <form class="form-horizontal m-t-20" id="loginform" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="row p-b-30">
                    <div class="col-12">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-success text-white" id="basic-addon1"><i class="ti-user"></i></span>
                            </div>
                            <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" placeholder="E-mail" aria-label="E-mail" aria-describedby="basic-addon1" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-warning text-white" id="basic-addon2"><i class="ti-pencil"></i></span>
                            </div>
                            <input id="password" type="password" name="password" class="form-control form-control-lg @error('password') is-invalid @enderror" placeholder="Wachtwoord" aria-label="Password" aria-describedby="basic-addon1" name="password" required autocomplete="current-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row border-top border-secondary">
                    <div class="col-12">
                        <div class="form-group">
                            <div class="p-t-20">
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}">
                                        <button class="btn btn-info" id="to-recover" type="button"><i class="fa fa-lock m-r-5"></i> Wachtwoord vergeten?</button>
                                    </a>
                                @endif
                                <button class="btn btn-success float-right" type="submit">{{ __('Login') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group d-flex justify-content-center">
                            <label for="modal-button">Neem contact op:</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group d-flex justify-content-center">
                            <button id="modal-button" type="button" class="btn btn-primary" data-toggle="modal" data-target="#contact-modal">
                                contact
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

{{--    contact modal   --}}

<div class="modal fade" id="contact-modal" tabindex="-1" role="dialog" aria-labelledby="contact-modal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email adres</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="example@mail.nl">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Naam</label>
                        <input type="text" class="form-control" id="exampleInputPassword1" placeholder="voornaam + achternaam">
                    </div>
                    <div class="form-group">
                        <label for="text-area">Betreft:</label>
                        <textarea class="form-control" id="text-area" rows="3"></textarea>
                    </div>
                    <a href="/tickets/contact">
                        <button type="submit" class="btn btn-primary">indienen</button>
                    </a>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection
