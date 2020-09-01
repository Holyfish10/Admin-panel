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
                                <li class="breadcrumb-item"><a href="{{ route('posts.index') }}">Berichten</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Bericht bewerken</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="container p-5">
            <h3>Nieuwsbericht bewerken</h3>
            <form action="{{action('PostsController@update', $post->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="title">Title</label>
                        <input type="text" class="form-control" placeholder="Titel" name="title" value="{{ $post->title }}">
                    <label for="content">Bericht</label>
                        <textarea type="text" class="form-control" id="editor" placeholder="Je bericht" name="message" value="{{ $post->message }}">{{ $post->message }}</textarea>
                    <label for="image" class="mt-3">Image kiezen</label>
                        <input class="mt-3 d-flex form-control" type="file" name="file">
                </div>
                {{ csrf_field() }}
                <input type="submit" value="Updaten" class="btn btn-info">
                <a href="{{ route('posts.index') }}" class="btn btn-primary">Ga terug</a>
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
