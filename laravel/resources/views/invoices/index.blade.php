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
                            <li class="breadcrumb-item active" aria-current="page">Facturen</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container p-5">

        <div class="col-12">
            <div class="mb-3">@include('layouts.messages')</div>

            @if ($success = Session::get('success'))

                <div class="alert alert-success">

                    <p>{{ $success }}</p>

                </div>

            @endif

        </div>
        <div class="row">
            <div class="col-4">
                <div class="card card-hover">
                    <div class="box bg-warning text-center">
                        <h1 class="font-light text-white"><i class="far fa-envelope"></i></h1>
                        <h6 class="text-white">{{$invoices->count()}} Facturen</h6>
                    </div>
                </div>
            </div>

            <div class="col-4">
                <div class="card card-hover">
                    <div class="box bg-danger text-center">
                        <h1 class="font-light text-white"><i class="far fa-envelope"></i></h1>
                        <h6 class="text-white">{{$invoices->where('status', '=', 2)->count()}} Openstaande facturen</h6>
                    </div>
                </div>
            </div>

            <div class="col-4">
                <div class="card card-hover">
                    <div class="box bg-success text-center">
                        <h1 class="font-light text-white"><i class="far fa-envelope"></i></h1>
                        <h6 class="text-white">€{{$total}}betaald</h6>
                    </div>
                </div>
            </div>
        </div>


        <div class="card" style="font-family: Nunito-sans, sans-serif">
            <div class="card-body">
                <h5 class="card-title d-inline mt-5">Facturen</h5>
                <div class="float-right">
                    <button class="btn btn-danger delete-all" data-url="">Verwijder selectie</button>
                    <a href="{{ route('invoices.create') }}" class="btn btn-success">Factuur aanmaken</a>
                </div>
            </div>
                @if(count($invoices) > 0)
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
                                <th scope="col">Omschrijving</th>
                                <th scope="col">Aantal</th>
                                <th scope="col">Datum</th>
                                <th scope="col">Totaal</th>
                                <th scope="col">Status</th>
                                <th scope="col">Opties</th>
                            </tr>
                            </thead>
                            <tbody class="customtable">

                            @foreach($invoices as $invoice)

                                @php
                                    $total = ($price * $invoice->amount + ($price / $price * $invoice->tax));

                                    $discount = $total - ($total / $total * $invoice->discount)
                                @endphp

                                <tr>
                                    <th>
                                        <label class="customcheckbox">
                                            <input type="checkbox" class="listCheckbox checkbox" data-id="{{ $invoice->id }}"/>
                                            <span class="checkmark"></span>
                                        </label>
                                    </th>
                                    <td>{{$invoice->id}}</td>
                                    <td style="font-weight: 600;">{{ Str::limit($invoice->description, 15) }}</td>
                                    <td>{{ $invoice->amount }}</td>
                                    <td>{{ $invoice->created_at->format('d-m-Y') }}</td>
                                    @if(empty($invoice->discount))
                                        <td>€{{ number_format($total, 2, '.', '') }}</td>
                                    @else
                                        <td>€{{ $discount }}</td>
                                    @endif
                                    <td>
                                        @if($invoice->status == 0)
                                            <span class="badge badge-success">Betaald</span>
                                        @endif
                                        @if($invoice->status == 1)
                                            <span class="badge badge-info">In afwachting</span>
                                        @endif
                                        @if($invoice->status == 2)
                                            <span class="badge badge-danger">Niet betaald</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="" class="btn btn-light"><i class="mdi mdi-replay"></i></a>
                                            <a href="{{ url('/invoices/'.$invoice->id.'/edit') }}" class="btn btn-primary"><i class="fas fa-pencil-alt"></i></a>
                                            <form action="{{ action('InvoiceController@destroy', $invoice->id) }}" method="POST" style="display: inline;" onclick="return confirm('Weet je zeker dat je dit wilt verwijderen?')">
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
{{--                            {{$inv->links()}}--}}
                        </div>

                    </div>
            @else
            <p class="text-center">Er zijn nog geen facturen aangemaakt</p>
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

                                url: "{{ route('invoices.multiple-delete') }}",

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
