@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">Home</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

<div class="mb-3 w-75 col-12 mx-auto">@include('layouts.messages')</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-6 col-lg-4">
                            <div class="card card-hover">
                                <div class="box bg-cyan text-center">
                                    <h1 class="font-light text-white"><i class="fa fa-user"></i></h1>
                                    <h6 class="text-white">{{$users->count()}} Users</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="card card-hover">
                                <div class="box bg-success text-center">
                                    <h1 class="font-light text-white"><i class="far fa-calendar-check"></i></h1>
                                    <h6 class="text-white">
                                        {{$events->count()}} Afspraken vandaag
                                    </h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="card card-hover">
                                <div class="box bg-warning text-center">
                                    <h1 class="font-light text-white"><i class="far fa-envelope"></i></h1>
                                    <h6 class="text-white">{{$post->count()}} Nieuwsberichten</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="card card-hover">
                                <div class="box bg-danger text-center">
                                    <h1 class="font-light text-white"><i class="fab fa-uikit"></i></h1>
                                    <h6 class="text-white">{{auth()->user()->sites->count()}} Projecten</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="card card-hover">
                                <div class="box bg-primary text-center">
                                    <h1 class="font-light text-white"><i class="fas fa-tasks"></i></h1>
                                    <h6 class="text-white">{{auth()->user()->todo->count()}} To-do's</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="card card-hover">
                                <div class="box bg-info text-center">
                                    <h1 class="font-light text-white"><i class="fas fa-users"></i></h1>
                                    <h6 class="text-white">{{auth()->user()->clients->count()}} Klanten</h6>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            @if(auth()->user()->email == 'jesseboer@hotmail.com')
			<div class="card">
                <div class="card-body">
                    <h4 class="card-title">Laatste nieuws</h4>
                </div>
                <div class="comment-widgets scrollable">
                    @if(count($posts) > 0)
                    @foreach($posts as $post)
                    <div class="d-flex flex-row comment-row">
                        <div class="p-2"><img src="../../assets/images/users/4.jpg" alt="user" width="50" class="rounded-circle"></div>
                        <div class="comment-text active w-100">
                            <h6 class="font-medium">{{$post->user->name}}</h6>
                            <span class="m-b-15 d-block font-bold mb-2">{{ Str::limit($post->title, 30) }} </span>
                            <span class="m-b-15 d-block mb-3">{!! strtolower(substr(strip_tags($post->message), 0, 100)) !!}</span>
                            <div class="comment-footer">
                                <span class="text-muted float-right">{{$post->created_at->format('d-m-Y')}}</span>
                                <a href="{{url('/posts/'.$post->id.'/edit')}}"><button type="button" class="btn btn-cyan btn-sm">Bewerken</button></a>
                                <button type="button" class="btn btn-success btn-sm">Publiceren</button>
                                <form action="{{ action('PostsController@destroy', $post->id) }}" method="POST" style="display: inline;" onclick="return confirm('Weet je zeker dat je dit wilt verwijderen?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Verwijderen</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach

                        <div class="mt-3 row justify-content-center">
                            {{$posts->links()}}
                        </div>
                    @else
                        <p class="text-center">Er zijn nog geen berichten aangemaakt!</p>
                    @endif
                </div>
            </div>
			@endif
             <!-- Card -->
            <div class="card">
                <div class="card-body d-flex">
                    <h5 class="card-title m-b-0 col-11">To-do</h5>
                    <button class="btn btn-success" data-toggle="modal" data-target="#addTodoModel">+</button>

                    <form action="{{ action('TodoController@store') }}" method="POST">
                    @csrf
                    <!-- Modal -->
                        <div class="modal fade" id="addTodoModel" tabindex="-1" aria-labelledby="todoModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">To-do aanmaken</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row justify-content-center">
                                            <input type="text" name="name" placeholder="To-do item" class="form-control col-3 mr-1">
                                            <select name="status" id="" class="form-control col-3">
                                                <option value="0">Open</option>
                                                <option value="1">In bewerking</option>
                                                <option value="2">Gesloten</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Sluiten</button>
                                        <input type="submit" value="Aanmaken" class="btn btn-primary">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Item</th>
                        <th scope="col">Status</th>
                        <th scope="col">Acties</th>
                    </tr>
                    </thead>
                    <tbody>
					@if(count($todo) > 0)
                    @foreach(auth()->user()->todo as $todo)
                    <tr>
                        <td>{{$todo->name}}</td>
                        @if($todo->status == 0)
                            <td style="color: #28b779;">Open</td>
                        @elseif($todo->status == 1)
                            <td class="text-warning">In bewerking</td>
                        @else
                            <td style="color: red;">Gesloten</td>
                        @endif
                        <td>
                            <button class="btn bg-white" data-toggle="modal" data-target="#todoModal">
                                <i class="mdi mdi-pencil" style="color: #2962FF;"></i>
                            </button>

                            <form action="{{ action('TodoController@destroy', $todo->id) }}" method="POST" style="display: inline;" id="todoForm" onclick="return confirm('Weet je zeker dat je dit wilt verwijderen?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" id="removeItem" class="btn bg-white"><i class="mdi mdi-close" style="color: #2962FF;"></i></button>
                            </form>

                            <form action="{{action('TodoController@edit', $todo->id) }}" method="POST">
                            @csrf
                            @method('POST')
                            <!-- Modal -->
                                <div class="modal fade" id="todoModal" tabindex="-1" aria-labelledby="todoModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">To-do bewerken</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-center">
                                                <div class="row justify-content-center">
                                                    <input type="text" name="name" placeholder="To-do item" class="form-control col-3 mr-1" value="{{$todo->name}}">
                                                    <select name="status" id="" class="form-control col-3">
                                                        <option value="{{ $todo->status }}" selected>
                                                            @if($todo->status == 0)
                                                                Open
                                                            @elseif($todo->status == 1)
                                                                In bewerking
                                                            @else
                                                                Gesloten
                                                             @endif
                                                        </option>
                                                        <option value="0">Open</option>
                                                        <option value="1">In bewerking</option>
                                                        <option value="2">Gesloten</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Sluiten</button>
                                                <input type="submit" value="Bewerken" class="btn btn-primary">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </td>
                    </tr>
                    @endforeach
					@else
						<p class="text-center">Er zijn nog geen to-do's aangemaakt!</p>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title m-b-0">News Updates</h4>
                </div>
                <ul class="list-style-none">
                    <li class="d-flex no-block card-body">
                        <i class="fa fa-check-circle w-30px m-t-5"></i>
                        <div>
                            <a href="#" class="m-b-0 font-medium p-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</a>
                            <span class="text-muted">dolor sit amet, consectetur adipiscing</span>
                        </div>
                        <div class="ml-auto">
                            <div class="tetx-right">
                                <h5 class="text-muted m-b-0">20</h5>
                                <span class="text-muted font-16">Jan</span>
                            </div>
                        </div>
                    </li>
                    <li class="d-flex no-block card-body border-top">
                        <i class="fa fa-gift w-30px m-t-5"></i>
                        <div>
                            <a href="#" class="m-b-0 font-medium p-0">Congratulation Maruti, Happy Birthday</a>
                            <span class="text-muted">many many happy returns of the day</span>
                        </div>
                        <div class="ml-auto">
                            <div class="tetx-right">
                                <h5 class="text-muted m-b-0">11</h5>
                                <span class="text-muted font-16">Jan</span>
                            </div>
                        </div>
                    </li>
                    <li class="d-flex no-block card-body border-top">
                        <i class="fa fa-plus w-30px m-t-5"></i>
                        <div>
                            <a href="#" class="m-b-0 font-medium p-0">Maruti is a Responsive Admin theme</a>
                            <span class="text-muted">But already everything was solved. It will ...</span>
                        </div>
                        <div class="ml-auto">
                            <div class="tetx-right">
                                <h5 class="text-muted m-b-0">19</h5>
                                <span class="text-muted font-16">Jan</span>
                            </div>
                        </div>
                    </li>
                    <li class="d-flex no-block card-body border-top">
                        <i class="fa fa-leaf w-30px m-t-5"></i>
                        <div>
                            <a href="#" class="m-b-0 font-medium p-0">Envato approved Maruti Admin template</a>
                            <span class="text-muted">i am very happy to approved by TF</span>
                        </div>
                        <div class="ml-auto">
                            <div class="tetx-right">
                                <h5 class="text-muted m-b-0">20</h5>
                                <span class="text-muted font-16">Jan</span>
                            </div>
                        </div>
                    </li>
                    <li class="d-flex no-block card-body border-top">
                        <i class="fa fa-question-circle w-30px m-t-5"></i>
                        <div>
                            <a href="#" class="m-b-0 font-medium p-0"> I am alwayse here if you have any question</a>
                            <span class="text-muted">we glad that you choose our template</span>
                        </div>
                        <div class="ml-auto">
                            <div class="tetx-right">
                                <h5 class="text-muted m-b-0">15</h5>
                                <span class="text-muted font-16">Jan</span>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="">
                    <div class="row justify-content-center">
                        <div class="col-lg-9">
                            <div class="card-body b-l calender-sidebar">
                                <div class="success">
                                    <div class="response"></div>
                                </div>
                                <div id="calendar"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@section('scripts')

<script>
    $(document).ready(function () {

        var SITEURL = "";
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var calendar = $('#calendar').fullCalendar({
            locale: 'nl',

            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            events: SITEURL + "{{route('home')}}",
            displayEventTime: true,
            editable: true,

            eventRender: function (event, element, view) {
                if (event.allDay === 'true') {
                    event.allDay = true;
                } else {
                    event.allDay = false;
                }
            },
            selectable: true,
            selectHelper: true,
            defaultView: "agendaWeek",
            timeFormat: 'H:mm',

            select: function (start, end, allDay) {
                var title = prompt('Afspraak toevoegen');

                if (title) {
                    var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
                    var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");

                    $.ajax({
                        url: SITEURL + "/create",
                        data: 'title=' + title + '&start=' + start + '&end=' + end,
                        type: "POST",
                        success: function (data) {
                            displayMessage("Succesvol toegevoegd!");
                        }
                    });
                    calendar.fullCalendar('renderEvent',
                        {
                            title: title,
                            start: start,
                            end: end,
                            allDay: allDay
                        },
                        true
                    );
                }
                calendar.fullCalendar('unselect');
            },

            eventDrop: function (event, delta) {
                var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                $.ajax({
                    url: SITEURL + '/update',
                    data: 'title=' + event.title + '&start=' + start + '&end=' + end + '&id=' + event.id,
                    type: "POST",
                    success: function (response) {
                        displayMessage("Succesvol geüpdate");
                    }
                });
            },

            eventResize: function(info) {
                var start = $.fullCalendar.formatDate(info.start, "Y-MM-DD HH:mm:ss");
                var end = $.fullCalendar.formatDate(info.end, "Y-MM-DD HH:mm:ss");

                $.ajax({
                    url: SITEURL + '/update',
                    data: 'title=' + info.title + '&start=' + start + '&end=' + end + '&id=' + info.id,
                    type: "POST",
                    success: function (response) {
                        displayMessage("Succesvol geüpdate");
                    }
                });
            },

            eventClick: function (event) {
                var deleteMsg = confirm("Weet je zeker dat je dit wilt verwijderen?");
                if (deleteMsg) {
                    $.ajax({
                        type: "POST",
                        url: SITEURL + '/delete',
                        data: "&id=" + event.id,
                        success: function (response) {
                            if(parseInt(response) > 0) {
                                $('#calendar').fullCalendar('removeEvents', event.id);
                                displayMessage("Succesvol verwijderd!");
                            }
                        }
                    });
                }
            }
        });
    });

    function displayMessage(message) {
        $(".response").html("<div class='alert alert-success'>"+message+"</div>");
        setInterval(function(e) { $('.success').fadeOut(); }, 1000);
    }

    $(document).on('click', '#removeItem', function(){
        if(confirm === true) {
            $('#todoForm').submit();
        }
    });
</script>
@endsection


@endsection
