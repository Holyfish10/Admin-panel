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
            <div class="mb-3">@include('layouts.messages')</div>
        </div>

        <h3>Rechten aanmaken</h3>

        <form action="{{action('PermissionController@store')}}" method="POST">
        @csrf
        @method('POST')
          <div class="form-group">
            <label for="name">Rechten naam</label>
              <input type="text" class="form-control mb-3" placeholder="Naam" name="name" value="{{old('name')}}">
            <label for="content">Slug</label>
              <input type="text" class="form-control mb-3" placeholder="Slug" name="slug" value="{{old('slug')}}">
          </div>
          <input type="submit" value="Aanmaken" class="btn btn-info">
          <a href="{{ route('permissions.index') }}" class="btn btn-primary">Ga terug</a>
        </form>
    </div>
</div>
@endsection
