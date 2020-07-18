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
                            <li class="breadcrumb-item active" aria-current="page">Berichten</li>
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

        <div class="col-5 mx-auto">
            <div class="card card-hover">
                <div class="box bg-warning text-center">
                    <h1 class="font-light text-white"><i class="far fa-envelope"></i></h1>
                    <h6 class="text-white">{{$post->count()}} Nieuwsberichten</h6>
                </div>
            </div>
        </div>

        <style>*{font-family: "Nunito-sans", sans-serif}</style>

        @if(count($posts) > 0)
        <div class="card">
            <div class="card-body">
                <h5 class="card-title  d-inline mt-5">Nieuwsberichten</h5>
                <a href="{{ route('posts.create') }}" class="btn btn-success float-right">Bericht aanmaken</a>
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
                        <th scope="col">Titel</th>
                        <th scope="col">Bericht</th>
                        <th scope="col">Gepubliceerd</th>
                        <th scope="col">Auteur</th>
                        <th scope="col">Opties</th>
                    </tr>
                    </thead>
                    <tbody class="customtable">
                    @foreach($posts as $post)
                        <tr>
                            <th>
                                <label class="customcheckbox">
                                    <input type="checkbox" class="listCheckbox" />
                                    <span class="checkmark"></span>
                                </label>
                            </th>
                            <td style="font-weight: 600;">{{ Str::limit($post->title, 15) }}</td>
                            <td>{!! strtolower(substr(strip_tags($post->message), 0, 100)) !!}</td>
                            <td>{{ $post->created_at->format('d-m-Y') }}</td>
                            <td>{{ $post->user->name }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="" class="btn btn-light"><i class="mdi mdi-replay"></i></a>
                                    <a href="{{ url('/posts/'.$post->id.'/edit') }}" class="btn btn-primary"><i class="fas fa-pencil-alt"></i></a>
                                    <form action="{{ action('PostsController@destroy', $post->id) }}" method="POST" style="display: inline;" onclick="return confirm('Weet je zeker dat je dit wilt verwijderen?')">
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
                    {{$posts->links()}}
                </div>

            </div>
        </div>
            @else
            <p class="text-center">Er zijn nog geen berichten aangemaakt</p>
        @endif


    </div>
</div>

@endsection
