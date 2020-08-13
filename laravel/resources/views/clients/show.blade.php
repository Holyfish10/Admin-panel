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
                            <li class="breadcrumb-item"><a href="{{ url('clients') }}">Klanten</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Factuur</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container p-5">
        <div class="row justify-content-center">
            <div class="col-4">
                <div class="card card-hover">
                    <div class="box bg-warning text-center">
                        <h1 class="font-light text-white"><i class="far fa-envelope"></i></h1>
                        <h6 class="text-white">{{ $clients->invoices->count() }} Facturen</h6>
                    </div>
                </div>
            </div>
        </div>

        <div class="card" style="font-family: Nunito-sans, sans-serif">
            <div class="card-body">
                <h5 class="card-title d-inline mt-5">Klanten facturen</h5>
                <div class="float-right">
                    <a href="{{ route('invoices.create') }}" class="btn btn-success">Factuur aanmaken</a>
                </div>
            </div>

            @if(count($clients->invoices) > 0)
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>
                                <label class="customcheckbox m-b-20 checkbox">
                                    <input type="checkbox" id="mainCheckbox" />
                                    <span class="checkmark"></span>
                                </label>
                            </th>
                            <th scope="col">#</th>
                            <th scope="col">Bedrijf</th>
                            <th scope="col">Verkoper</th>
                            <th scope="col">Datum</th>
                            <th scope="col">Status</th>
                            <th scope="col">Opties</th>
                        </tr>
                        </thead>
                        <tbody class="customtable">

                        @foreach($clients->invoices as $client)
                            <tr>
                                <th>
                                    <label class="customcheckbox">
                                        <input type="checkbox" class="listCheckbox checkbox" data-id=""/>
                                        <span class="checkmark"></span>
                                    </label>
                                </th>
                                <td>{{$client->id}}</td>
                                <td>{{$client->client->company}}</td>
                                <td>{{$client->user->name}}</td>
                                <td>{{$client->created_at->format('d-m-Y')}}</td>
                                <td>
                                    @if($client->status == 0)
                                        <span class="badge badge-success">Betaald</span>
                                    @endif
                                    @if($client->status == 1)
                                        <span class="badge badge-info">In afwachting</span>
                                    @endif
                                    @if($client->status == 2)
                                        <span class="badge badge-danger">Niet betaald</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ action('InvoiceController@downloadPDF', $client->id) }}" class="btn btn-light"><i class="far fa-file-pdf"></i></a>
                                        <a href="{{ action('InvoiceController@show', $client->id) }}" class="btn btn-info"><i class="fas fa-search"></i></a>
                                        <a href="{{ url('/invoices/'.$client->id.'/edit') }}" class="btn btn-primary"><i class="fas fa-pencil-alt"></i></a>
                                        <form action="{{ action('InvoiceController@destroy', $client->id) }}" method="POST" style="display: inline;" onclick="return confirm('Weet je zeker dat je dit wilt verwijderen?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <div class="mt-3 ml-3">

                    </div>

                </div>
            @else
                <p class="text-center">Er zijn nog geen facturen aangemaakt voor deze klant</p>
            @endif
        </div>
    </div>
</div>
@endsection
