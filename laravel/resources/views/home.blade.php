@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Library</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

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
                                        <h6 class="text-white">120 Berichten</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="card card-hover">
                                    <div class="box bg-danger text-center">
                                        <h1 class="font-light text-white"><i class="fab fa-uikit"></i></h1>
                                        <h6 class="text-white">120 Projecten</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="card card-hover">
                                    <div class="box bg-primary text-center">
                                        <h1 class="font-light text-white"><i class="fas fa-tasks"></i></h1>
                                        <h6 class="text-white">120 Dingen te doen</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="card card-hover">
                                    <div class="box bg-info text-center">
                                        <h1 class="font-light text-white"><i class="fas fa-users"></i>/h1>
                                        <h6 class="text-white">120 Klanten</h6>
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
                 <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Latest Posts</h4>
                    </div>
                    <div class="comment-widgets scrollable">
                        <!-- Comment Row -->
                        <div class="d-flex flex-row comment-row m-t-0">
                            <div class="p-2"><img src="../../assets/images/users/1.jpg" alt="user" width="50" class="rounded-circle"></div>
                            <div class="comment-text w-100">
                                <h6 class="font-medium">James Anderson</h6>
                                <span class="m-b-15 d-block">Lorem Ipsum is simply dummy text of the printing and type setting industry. </span>
                                <div class="comment-footer">
                                    <span class="text-muted float-right">April 14, 2016</span>
                                    <button type="button" class="btn btn-cyan btn-sm">Edit</button>
                                    <button type="button" class="btn btn-success btn-sm">Publish</button>
                                    <button type="button" class="btn btn-danger btn-sm">Delete</button>
                                </div>
                            </div>
                        </div>
                        <!-- Comment Row -->
                        <div class="d-flex flex-row comment-row">
                            <div class="p-2"><img src="../../assets/images/users/4.jpg" alt="user" width="50" class="rounded-circle"></div>
                            <div class="comment-text active w-100">
                                <h6 class="font-medium">Michael Jorden</h6>
                                <span class="m-b-15 d-block">Lorem Ipsum is simply dummy text of the printing and type setting industry. </span>
                                <div class="comment-footer">
                                    <span class="text-muted float-right">May 10, 2016</span>
                                    <button type="button" class="btn btn-cyan btn-sm">Edit</button>
                                    <button type="button" class="btn btn-success btn-sm">Publish</button>
                                    <button type="button" class="btn btn-danger btn-sm">Delete</button>
                                </div>
                            </div>
                        </div>
                        <!-- Comment Row -->
                        <div class="d-flex flex-row comment-row">
                            <div class="p-2"><img src="../../assets/images/users/5.jpg" alt="user" width="50" class="rounded-circle"></div>
                            <div class="comment-text w-100">
                                <h6 class="font-medium">Johnathan Doeting</h6>
                                <span class="m-b-15 d-block">Lorem Ipsum is simply dummy text of the printing and type setting industry. </span>
                                <div class="comment-footer">
                                    <span class="text-muted float-right">August 1, 2016</span>
                                    <button type="button" class="btn btn-cyan btn-sm">Edit</button>
                                    <button type="button" class="btn btn-success btn-sm">Publish</button>
                                    <button type="button" class="btn btn-danger btn-sm">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                 <!-- Card -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title m-b-0">Tasks</h5>
                    </div>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Description</th>
                            <th scope="col">Status</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Making The New Suit</td>
                            <td class="text-success">Progress</td>
                            <td>
                                <a href="#" data-toggle="tooltip" data-placement="top" title="Update">
                                    <i class="mdi mdi-check"></i>
                                </a>
                                <a href="#" data-toggle="tooltip" data-placement="top" title="Delete">
                                    </i><i class="mdi mdi-close"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>Luanch My New Site</td>
                            <td class="text-warning">Pending</td>
                            <td>
                                <a href="#" data-toggle="tooltip" data-placement="top" title="Update">
                                    <i class="mdi mdi-check"></i>
                                </a>
                                <a href="#" data-toggle="tooltip" data-placement="top" title="Delete">
                                    </i><i class="mdi mdi-close"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>Maruti Excellant Theme</td>
                            <td class="text-danger">Cancled</td>
                            <td>
                                <a href="#" data-toggle="tooltip" data-placement="top" title="Update">
                                    <i class="mdi mdi-check"></i>
                                </a>
                                <a href="#" data-toggle="tooltip" data-placement="top" title="Delete">
                                    </i><i class="mdi mdi-close"></i>
                                </a>
                            </td>
                        </tr>
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
</div>

<script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('dist/js/jquery.ui.touch-punch-improved.js') }}"></script>
<script src="{{ asset('assets/libs/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('assets/libs/fullcalendar/dist/fullcalendar.min.js') }}"></script>



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
</script>
@endsection
