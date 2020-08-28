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
                                <li class="breadcrumb-item active" aria-current="page">Gebruikers</li>
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

            <div class="col-4 mx-auto">
                <div class="card card-hover">
                    <div class="box bg-primary text-center">
                        <h1 class="font-light text-white"><i class="far fa-envelope"></i></h1>
                        <h6 class="text-white">{{$users->count() }} Gebruikers</h6>
                    </div>
                </div>
            </div>


            @if(count($users) > 0)
                <div class="card" style="font-family: Nunito-sans, sans-serif">
                    <div class="card-body">
                        <h5 class="card-title d-inline mt-5">Gebruikers</h5>
                        <a href="{{ route('users.create') }}" class="btn btn-success float-right">Gebruiker aanmaken</a>
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
                                <th scope="col">Rol</th>
                                <th scope="col">Laatste sessie</th>
                                <th scope="col">Datum</th>
                                <th scope="col">Opties</th>
                            </tr>
                            </thead>
                            <tbody class="customtable">
                            @foreach($users as $user)

                                <tr>
                                    <th>
                                        <label class="customcheckbox">
                                            <input type="checkbox" class="listCheckbox" />
                                            <span class="checkmark"></span>
                                        </label>
                                    </th>
                                    <td>{{$user->name}}</td>
                                    <td><a href="mailto: {{$user->email}}">{{ $user->email }}</a></td>
                                    <td>{{$user->role}}</td>
                                    <td>{{$user->last_login->diffForHumans() ?? ''}}</td>
                                    <td>{{ $user->created_at->format('d-m-Y') }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ url('/users/'.$user->id.'/edit')  }}" class="btn btn-success"><i class="fa fa-pencil-alt"></i></a>
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline;" onclick="return confirm('Weet je zeker dat je deze gebruiker wilt verwijderen?')">
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
                            {{$users->links()}}
                        </div>

                    </div>
                </div>
            @else
                <p class="text-center">Er zijn nog geen gebruikers aangemaakt</p>
            @endif


        </div>
    </div>

@endsection
