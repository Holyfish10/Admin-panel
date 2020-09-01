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
                                <li class="breadcrumb-item active" aria-current="page">Permissies</li>
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

            @if(count($permissions) > 0)
                <div class="card" style="font-family: Nunito-sans, sans-serif">
                    <div class="card-body">
                        <h5 class="card-title d-inline mt-5">Rechten</h5>
                        <button class="btn btn-danger delete-all float-right ml-2" data-url="">Verwijder selectie</button>
                        <a href="{{ route('permissions.create') }}" class="btn btn-primary float-right">Aanmaken</a>
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
                                <th scope="col">Slug</th>
                                <th scope="col">Rol</th>
                                <th scope="col">Datum</th>
                                <th scope="col">Opties</th>
                            </tr>
                            </thead>
                            <tbody class="customtable">
                            @foreach($permissions as $permission)
                                <tr>
                                    <th>
                                        <label class="customcheckbox">
                                            <input type="checkbox" class="listCheckbox checkbox" data-id="{{ $permission->id }}"/>
                                            <span class="checkmark"></span>
                                        </label>
                                    </th>
                                    <td>{{$permission->name}}</td>
                                    <td>{{ $permission->slug }}</td>
                                    <td></td>
                                    <td>{{$permission->created_at->diffForHumans()}}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ url('/permissions/'.$permission->id.'/edit')  }}" class="btn btn-primary mr-1"><i class="fa fa-pencil-alt"></i></a>
                                            <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST" style="display: inline;" onclick="return confirm('Weet je zeker dat je deze rechten wilt verwijderen?')">
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
                            {{$permissions->links()}}
                        </div>

                    </div>
                </div>
            @else
                <p class="text-center">Er zijn nog geen rechten aangemaakt</p>
            @endif


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

                                url: "{{ route('permissions.multiple-delete') }}",

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
