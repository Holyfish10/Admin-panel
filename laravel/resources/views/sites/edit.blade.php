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
                            <li class="breadcrumb-item"><a href="{{ route('sites.index') }}">Websites</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Website bewerken</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

        <div class="container p-5">
            <h3>Website bewerken</h3>
            <form action="{{action('SiteController@update', $sites->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="title">Title</label>
                        <input type="text" class="form-control" placeholder="Titel" name="title" value="{{ $sites->title }}">
                    <label for="image">Website url</label>
                        <input type="text" class="form-control" placeholder="website URL" name="website" value="{{ $sites->website }}">
                    <label for="content">Bericht</label>
                        <textarea type="text" class="form-control" id="editor" placeholder="Omschrijving" name="description" value="{{ $sites->description }}">{{ $sites->description }}</textarea>
                    <label for="image">Image url</label>
                        <input type="text" class="form-control" placeholder="image URL" name="image" value="{{ $sites->image }}">
                </div>
                {{ csrf_field() }}
                <input type="submit" value="Updaten" class="btn btn-info">
                <a href="{{ route('sites.index') }}" class="btn btn-primary">Ga terug</a>
            </form>
        </div>
    </div>

@section('scripts')
<script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>

    <script>
        CKEDITOR.replace('editor');
    </script>
@endsection

@endsection
