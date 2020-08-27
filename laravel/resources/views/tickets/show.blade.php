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
                                <li class="breadcrumb-item"><a href="{{ url('/tickets') }}">Tickets</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{$tickets->ticket_id}}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

<div class="container mt-5">
  <div class="mb-3">@include('layouts.messages')</div>
  <div class="card">
    <div class="card-header bg-secondary">
      <div class="row text-white text-center d-flex align-items-center border-solid">
        <div class="col-md-3">
          <h5 class="text-bold">Ticket id</h5>
          #{{$tickets->ticket_id}}
        </div>
        <div class="col-md-3">
          <h5 class="text-bold">Status</h5>
          {{$tickets->status}}
        </div>
        <div class="col-md-3">
          <h5 class="text-bold">Aangemaakt op</h5>
          {{$tickets->created_at->diffForHumans()}}
        </div>
        <div class="col-md-3">
          <h5 class="text-bold">Prioriteit</h5>
          {{$tickets->priority}}
        </div>
      </div>
    </div>

    <div class="card-body">
      <div class="row justify-content-center">
        <div class="col-8">
          <strong>{{$tickets->name}}</strong>
          <p>{{$tickets->created_at->diffForHumans()}}</p>
        </div>
        <div class="col-8">
          <p><strong>{{$tickets->title}}</strong></p>
          <p>{!! $tickets->content !!}</p>
        </div>
      </div>
    </div>

    <hr>
 </div>

     <a href="/tickets" class="btn btn-primary">Terug</a>
     <form action="{{ route('ticket.close', $tickets->ticket_id) }}" method="POST" style="display: inline;" onclick="return confirm('Weet je zeker dat je de ticket wilt sluiten?')">
         @csrf
         @method('POST')
         <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
     </form>

</div>
@endsection
