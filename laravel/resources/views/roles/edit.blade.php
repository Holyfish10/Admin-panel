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
                            <li class="breadcrumb-item"><a href="{{ route('permissions.index') }}">Rechten</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Nieuwe rechten</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container p-5">

        <div class="col-12">
            @include('layouts.messages')
        </div>

        <div class="card" style="font-family: Nunito-sans, sans-serif">
            <div class="card-body">
                <h5 class="card-title d-inline mt-5">Rechten bewerken</h5>
                <button class="btn btn-danger delete-all float-right ml-2" data-url="">Verwijder selectie</button>
                <button type="button" data-toggle="modal" data-target="#addPerm" class="btn btn-primary float-right">Recht toekennen</button>
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
                        <th scope="col">Opties</th>
                    </tr>
                    </thead>
                    <tbody class="customtable">
                    @foreach($permissions as $permission)
                        <tr>
                            <th>
                                <label class="customcheckbox">
                                    <input type="checkbox" class="listCheckbox checkbox" data-id="{{ $permission->permission_id}}"/>
                                    <span class="checkmark"></span>
                                </label>
                            </th>
                            <td>{{ $permission->id }} - {{$permission->name}}</td>
                            <td>{{$permission->slug}}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ url('/permissions/'.$permission->permission_id.'/edit')  }}" class="btn btn-primary mr-1"><i class="fa fa-pencil-alt"></i></a>
                                    <form action="{{action('RoleController@destroyPermission', $permission->role_id)}}" method="POST" style="display: inline;" onclick="return confirm('Weet je zeker dat je deze rechten wilt verwijderen?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" value="{{$permission->id}}" name="permission" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <!-- Modal add permission -->
                <form action="{{action('RoleController@updateRolePermission', $role->id)}}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="modal fade" id="addPerm" tabindex="-1" role="dialog" aria-labelledby="addPerm" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addPerm">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <select name="permission_id" class="form-control">
                                        @foreach($allPerm as $permission)
                                            <option value="{{$permission->id}}" class="ml-5">{{ $permission->id }} - {{$permission->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Sluiten</button>
                                    <button type="submit" class="update btn btn-primary">Opslaan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
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

                            url: "{{ route('roles.multiple-delete') }}",

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
