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
            <h4 class="card-title text-white">Factuur opmaken</h4>
            <p class="card-category text-white-50">Vul de gevens in</p>
        </div>
        <div class="card-body">
            <form action="{{action('InvoiceController@store')}}" method="POST">
                @csrf
                <div class="form-row">
                    <div class="col-6 mx-auto mb-3">
                        <p class="h3 col-12 text-center">Kies een klant ...</p>
                        <select class="form-control" name="client_id" id="">
                                <option value="">Kies een klant ...</option>
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}">{{ $client->id  }} - {{ $client->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <p class="h3 col-12">Of maak een bon</p>
                <div class="form-row">
                    <div class="col-6">
                        <select class="form-control" name="status" id="">
                            <option value="" selected>Betaal status... </option>
                            <option value="0">Betaald</option>
                            <option value="1">In afwachting</option>
                            <option value="2">Niet betaald</option>
                        </select>
                    </div>
                    <div class="col-6">
                        <input type="text" class="form-control" name="name" placeholder="Naam">
                    </div>
                    <div class="col-6 mt-3">
                        <input type="text" class="form-control" name="tax" placeholder="BTW">
                    </div>
                    <div class="col-6 mt-3">
                        <input type="text" class="form-control" name="discount" placeholder="korting">
                    </div>
                    <div class="col-6 mt-3">
                        <input type="number" step="0.01" class="form-control" name="total" placeholder="Totaal">
                    </div>
                    <div class="row w-75 mx-auto" id="products">
                        <div class="col-3 mt-3">
                            <input type="text" class="form-control item" name="item[]" placeholder="Product">
                        </div>
                        <div class="col-3 mt-3">
                            <input type="text" class="form-control description" name="description[]" placeholder="Omschrijving">
                        </div>
                        <div class="col-3 mt-3">
                            <input type="text" class="form-control aantal" name="amount[]" placeholder="Aantal">
                        </div>
                        <div class="col-3 mt-3">
                            <div id="inputField" class="btn btn-success mb-0">+</div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Aanmaken</button>
            </form>
        </div>
    </div>
</div>

@section('scripts')
    <script>
        $(document).on('click', '#removeField', function(){
            $(this).parents('.row-product').remove();
        });

        document.getElementById('inputField').addEventListener("click", function(ev){
            $('#products').append('<div class="row w-100 mx-auto row-product" id="products"><div class="col-3 mt-3"><input type="text" class="form-control item" name="item[]" placeholder="Product"></div><div class="col-3 mt-3"><input type="text" class="form-control description" name="description[]" placeholder="Omschrijving"></div><div class="col-3 mt-3"><input type="text" class="form-control aantal" name="amount[]" placeholder="Aantal"></div><div class="col-3 mt-3"><div id="removeField" class="btn btn-danger">-</div></div></div>');
        });
    </script>
@endsection

@endsection
