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
                            <li class="breadcrumb-item active" aria-current="page">Klanten</li>
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

        <div class="row justify-content-center">
            <div class="col-4">
                <div class="card card-hover">
                    <div class="box bg-warning text-center">
                        <h1 class="font-light text-white"><i class="far fa-envelope"></i></h1>
                        <h6 class="text-white">{{$clients->count()}} Klanten</h6>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card card-hover">
                    <div class="box bg-danger text-center">
                        <h1 class="font-light text-white"><i class="far fa-envelope"></i></h1>
                        <h6 class="text-white">{{$test}} Openstaand</h6>
                    </div>
                </div>
            </div>
        </div>

        <div class="card" style="font-family: Nunito-sans, sans-serif">
            <div class="card-body">
                <h5 class="card-title d-inline mt-5">Klanten</h5>
                <div class="float-right">
                    <a href="{{ route('clients.create') }}" class="btn btn-success">Klant aanmaken</a>
                </div>
            </div>
                @if(count($clients) > 0)
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
                                <th scope="col">Bedrijf</th>
                                <th scope="col">Klant</th>
                                <th scope="col">Email</th>
                                <th scope="col">Stad</th>
                                <th scope="col">Status</th>
                                <th scope="col">Opties</th>
                            </tr>
                            </thead>
                            <tbody class="customtable">

                            @foreach($clients as $client)
                                <tr>
                                    <th>
                                        <label class="customcheckbox">
                                            <input type="checkbox" class="listCheckbox checkbox" data-id="{{ $client->id }}"/>
                                            <span class="checkmark"></span>
                                        </label>
                                    </th>
                                    <td>{{$client->company}}</td>
                                    <td>{{$client->name}}</td>
                                    <td><a href="mailto:{{$client->email}}">{{$client->email}}</a></td>
                                    <td>{{ $client->city }}</td>
                                    <td>

                                        @if($client->clients->first()->status == 0)
                                            <span class="badge badge-success">Betaald</span>
                                        @elseif($client->clients->first()->status == 1)
                                            <span class="badge badge-info">In afwachting</span>
                                        @else
                                            <span class="badge badge-danger">Niet betaald</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ action('ClientController@show', $client->id) }}" class="btn btn-info"><i class="fas fa-search"></i></a>
                                            <a href="{{ url('/clients/'.$client->id.'/edit') }}" class="btn btn-primary"><i class="fas fa-pencil-alt"></i></a>
                                            <form action="{{ action('ClientController@destroy', $client->id) }}" method="POST" style="display: inline;" onclick="return confirm('Weet je zeker dat je dit wilt verwijderen?')">
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
                            {{$clients->links()}}
                        </div>

                    </div>
            @else
            <p class="text-center">Er zijn nog geen klanten aangemaakt</p>
        @endif
        </div>

        </div>
    </div>

    @section('scripts')
        <script type="text/javascript">
            $(document).ready(function () {
                $('.delete-all').on('click', function(e) {
                    var idsArr = [];
                    $(".checkbox:checked").each(function() {
                        idsArr.push($(this).attr('data-id'));
                    });

                    if(idsArr.length <=0)
                    {
                        alert("Selecteer een of meer velden om te verwijderen.");
                    }  else {
                        if(confirm("Weet je zeker dat je dit wilt verwijderen?")){

                            var strIds = idsArr.join(",");

                            $.ajax({

                                url: "{{ route('clients.multiple-delete') }}",

                                type: 'DELETE',

                                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},

                                data: 'ids='+strIds,

                                success: function (data) {

                                    if (data['status']==true) {
                                        $(".checkbox:checked").each(function() {
                                            $(this).parents("tr").remove();
                                        });
                                        alert(data['success']);
                                        location.reload();
                                    } else {
                                        alert('Oeps er is iets fout gegaan, probeer het opnieuw!!');
                                    }

                                },

                                error: function (data) {
                                    alert(data.responseText);
                                }

                            });



                        }

                    }

                });
            });

        </script>
        @endsection

@endsection
