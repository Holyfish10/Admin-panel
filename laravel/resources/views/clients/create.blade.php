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
                            <li class="breadcrumb-item"><a href="{{ url('/invoices') }}">Facturen</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Factuur aanmaken</li>
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
            <h4 class="card-title text-white">Klant aanmaken</h4>
            <p class="card-category text-white-50">Vul de gevens in</p>
        </div>
        <div class="card-body">
            <form action="{{action('ClientController@store')}}" method="POST">
                @csrf
                <div class="form-row">
                    <div class="col-6">
                        <input type="text" class="form-control" name="company" placeholder="Bedrijfsnaam">
                    </div>
                    <div class="col-6">
                        <input type="text" class="form-control" name="vat" placeholder="KVK nummer">
                    </div>
                    <div class="col-6 mt-3">
                        <input type="text" class="form-control" name="name" placeholder="Naam">
                    </div>
                    <div class="col-6 mt-3">
                        <input type="text" class="form-control" name="lastname" placeholder="Achternaam">
                    </div>
                   <div class="col-6 mt-3">
                       <input type="text" class="form-control" name="email" placeholder="E-mail">
                   </div>
                    <div class="col-6 mt-3">
                        <input type="text" class="form-control" name="telephone" placeholder="Telefoon nummer">
                    </div>
                    <div class="col-6 mt-3">
                        <input type="text" class="form-control" name="street" placeholder="Straat + huisnummer">
                    </div>
                    <div class="col-6 mt-3">
                        <input type="text" class="form-control" name="zipcode" placeholder="Postcode">
                    </div>
                    <div class="col-6 mt-3">
                        <input type="text" class="form-control" name="city" placeholder="Stad">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Aanmaken</button>
            </form>
        </div>
    </div>
</div>
@endsection
