@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('/clients') }}">Klanten</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Klant bewerken</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid p-5 bg-grey">
    <div class="card w-75 mx-auto" style="margin-left: 20%!important;">
        <div class="card-header card-header-primary">
            <h4 class="card-title text-white">Klant bewerken</h4>
            <p class="card-category text-white-50">Vul de gevens in</p>
        </div>
        <div class="card-body">
            <form action="{{action('ClientController@update', $client->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-row">
                    <div class="col-6 mx-auto mb-3">
                        <p class="h3 col-12 text-center">Kies een klant ...</p>
                        <select class="form-control" name="client_name">
                            <option value="" selected>Kies een klant ...</option>
                            @foreach($clients as $select)
                                <option value="{{$select->name}}">{{$select->id}} - {{$select->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-6">
                        <input type="text" class="form-control" name="company" placeholder="Bedrijf" value="{{ $client->company }}">
                    </div>
                    <div class="col-6">
                        <input type="text" class="form-control" name="name" placeholder="Naam" value="{{ $client->name }}">
                    </div>
                    <div class="col-6 mt-3">
                        <input type="text" class="form-control" name="vat" placeholder="BTW nummer" value="{{ $client->vat }}">
                    </div>
                    <div class="col-3 mt-3">
                        <input type="text" class="form-control" name="email" placeholder="Email" value="{{ $client->email }}">
                    </div>
                    <div class="col-3 mt-3">
                        <input type="text" class="form-control" name="street" placeholder="Straat" value="{{ $client->street }}">
                    </div>
                    <div class="col-3 mt-3">
                        <input type="text" class="form-control" name="zip" placeholder="Postcode" value="{{ $client->zip }}">
                    </div>
                    <div class="col-3 mt-3">
                        <input type="text" class="form-control" name="city" placeholder="Plaats" value="{{ $client->city }}">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Updaten</button>
            </form>
        </div>
    </div>
</div>

@endsection
