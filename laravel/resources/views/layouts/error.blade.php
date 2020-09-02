@extends('layouts.app')
@section('content')
<div class="page-wrapper">
    <div class="container p-5">
        <div class="row justify-content-center">

            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <strong>Je voldoet niet aan de juiste instellingen</strong> Je kan deze veranderen in de
                <a href="/users/{{auth()->user()->id}}/settings">gebruikers instellingen</a>
            </div>


        </div>
    </div>
</div>
@endsection
