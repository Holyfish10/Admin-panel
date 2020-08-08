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
                            <li class="breadcrumb-item"><a href="{{ route('sites.index') }}">Websites</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($sites->title, 10) }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container p-5">

        <div class="mb-3">@include('layouts.messages')</div>

        <img src="{{ $sites->image }}" alt="" style="height: 250px;" class="w-100 mb-4">
        <h4 class="text-center">{{ Str::limit($sites->title, 100) }}</h4>
        <p class="mt-5 mb-5">{!! preg_replace("/<img[^>]+\>/i", "", Str::limit($sites->description, 500)) !!}</p>

        <p class="mb-1"><small>Gepupliceerd: {{ $sites->created_at->format('d-m-Y') }}</small></p>
        <p><small>Auteur: {{ $sites->user->name }}</small></p>

        <a class="btn btn-success" href="/sites/{{$sites->id}}/edit">Bewerken</a>
        <a class="btn btn-info" href="{{ route('sites.index') }}">Ga terug</a>

    </div>
</div>
@endsection
