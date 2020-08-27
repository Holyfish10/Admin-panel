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
                                <li class="breadcrumb-item active" aria-current="page">Tickets</li>
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

            <div class="row">
                <div class="col-4 mx-auto">
                    <div class="card card-hover">
                        <div class="box bg-warning text-center">
                            <h1 class="font-light text-white"><i class="far fa-envelope"></i></h1>
                            <h6 class="text-white">{{$tickets->count()}} Tickets</h6>
                        </div>
                    </div>
                </div>

            <div class="col-4 mx-auto">
                <div class="card card-hover">
                    <div class="box bg-success text-center">
                        <h1 class="font-light text-white"><i class="far fa-envelope"></i></h1>
                        <h6 class="text-white">{{$tickets->open}} Open</h6>
                    </div>
                </div>
            </div>
            </div>

            @if(count($tickets) > 0)
                <div class="card" style="font-family: Nunito-sans, sans-serif">
                    <div class="card-body">
                        <h5 class="card-title d-inline mt-5">Nieuwsberichten</h5>
                        <a href="{{ route('tickets.create') }}" class="btn btn-success float-right">Bericht aanmaken</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>
                                    <label class="customcheckbox m-b-20">
                                        <input type="checkbox" id="mainCheckbox" />
                                        <span class="checkmark"></span>
                                    </label>
                                </th>
                                <th scope="col">Naam</th>
                                <th scope="col">Email</th>
                                <th scope="col">Telefoon</th>
                                <th scope="col">Prioriteit</th>
                                <th scope="col">Status</th>
                                <th scope="col">Titel</th>
                                <th scope="col">Bericht</th>
                                <th scope="col">Datum</th>
                                <th scope="col">Opties</th>
                            </tr>
                            </thead>
                            <tbody class="customtable">
                            @foreach($tickets as $ticket)

                                <tr>
                                    <th>
                                        <label class="customcheckbox">
                                            <input type="checkbox" class="listCheckbox" />
                                            <span class="checkmark"></span>
                                        </label>
                                    </th>
                                    <td>{{$ticket->name}}</td>
                                    <td><a href="mailto: {{$ticket->email}}">{{ $ticket->email }}</a></td>
                                    <td><a href="callto: {{$ticket->phone}}">{{$ticket->phone}}</a></td>
                                    @if($ticket->priority == 'Laag')
                                        <td><div class="badge badge-pill badge-primary ml-3">{{$ticket->priority}}</div></td>
                                    @elseif($ticket->priority == 'Gemiddeld')
                                        <td><div class="badge badge-pill badge-warning ml-3">{{$ticket->priority}}</div></td>
                                    @else
                                        <td><div class="badge badge-pill badge-danger ml-3">{{$ticket->priority}}</div></td>
                                    @endif
                                    @if($ticket->status == 'Open')
                                        <td><div class="badge badge-success">{{$ticket->status}}</div></td>
                                    @elseif($ticket->status == 'Gesloten')
                                        <td><div class="badge badge-dark">{{$ticket->status}}</div></td>
                                    @else
                                        <td><div class="badge badge-info">{{$ticket->status}}</div></td>
                                    @endif
                                    <td>{{ Str::limit($ticket->title, 15) }}</td>
                                    <td>{!! strtolower(substr(strip_tags($ticket->content), 0, 50)) !!}</td>
                                    <td>{{ $ticket->created_at->format('d-m-Y') }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('tickets.show', $ticket->ticket_id) }}" class="btn btn-primary"><i class="fas fa-pencil-alt"></i></a>
                                            <form action="{{ route('ticket.close', $ticket->ticket_id) }}" method="POST" style="display: inline;" onclick="return confirm('Weet je zeker dat je de ticket wilt sluiten?')">
                                                @csrf
                                                @method('POST')
                                                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <div class="mt-3 ml-3">
                            {{$tickets->links()}}
                        </div>

                    </div>
                </div>
            @else
                <p class="text-center">Er zijn nog geen tickets aangemaakt</p>
            @endif


        </div>
    </div>

@endsection
