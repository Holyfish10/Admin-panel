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
                            <li class="breadcrumb-item active" aria-current="page">Nieuw bericht</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container p-5">
        <h3>Nieuwsbericht aanmaken</h3>

        <form action="{{action('PostsController@store')}}" method="POST">
        @csrf
          <div class="form-group">
            <label for="title">Title</label>
              <input type="text" class="form-control" placeholder="Titel" name="title">
            <label for="content">Bericht</label>
              <textarea type="text" class="form-control" id="editor" placeholder="Je bericht" name="message"></textarea>
            <label for="image">Image url</label>
              <input type="text" class="form-control" placeholder="image URL" name="image">
          </div>
          {{ csrf_field() }}
          <input type="submit" value="Aanmaken" class="btn btn-info">
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
