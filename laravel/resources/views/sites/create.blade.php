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
                            <li class="breadcrumb-item active" aria-current="page">Nieuwe website</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container p-5">
        <h3>Website aanmaken</h3>

        <form action="{{action('SiteController@store')}}" method="POST">
        @csrf
          <div class="form-group">
            <label for="title">Title</label>
              <input type="text" class="form-control" placeholder="Titel" name="title">
            <label for="image">Website url</label>
              <input type="text" class="form-control" placeholder="website URL" name="website">
            <label for="content">Omschrijving</label>
              <textarea type="text" class="form-control" id="editor" placeholder="Je omschrijving" name="description"></textarea>
            <label for="image">Image url</label>
              <input type="text" class="form-control" placeholder="image URL" name="image">
          </div>
          <input type="submit" value="Aanmaken" class="btn btn-info">
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
