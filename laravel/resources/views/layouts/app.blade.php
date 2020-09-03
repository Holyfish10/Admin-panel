<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon.png') }} ">

    <!-- Custom CSS -->
    <link href="{{ asset('css/style.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/extra-libs/multicheck/multicheck.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('assets/libs/flot/css/float-chart.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/libs/fullcalendar/dist/fullcalendar.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/extra-libs/calendar/calendar.css') }}" rel="stylesheet" />

</head>
<body>
    <div id="app">
        <main>
            <div id="main-wrapper">
                @guest

                    <!-- Login you moron -->

                @else
                <header class="topbar" data-navbarbg="skin5">
                    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                        <div class="navbar-header" data-logobg="skin5">
                            <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                            <a class="navbar-brand" href="{{ route('home') }}">
                                <b class="logo-icon p-l-10">
                                    <img src="../../assets/images/logo-icon.png" alt="homepage" class="light-logo" />
                                </b>
                                <span class="logo-text">
                                 <img src="../../assets/images/logo-text.png" alt="homepage" class="light-logo" />
                            </span>
                            </a>
                            <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
                        </div>
                        <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                            <ul class="navbar-nav float-left mr-auto">
                                <li class="nav-item d-none d-md-block"><a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a></li>
                                <li class="nav-item search-box"> <a class="nav-link waves-effect waves-dark" href="javascript:void(0)"><i class="ti-search"></i></a>
                                    <form class="app-search position-absolute">
                                        <input type="text" class="form-control" placeholder="Search &amp; enter"> <a class="srh-btn"><i class="ti-close"></i></a>
                                    </form>
                                </li>
                            </ul>

                            <ul class="navbar-nav float-right">
                                @if(auth()->user()->can('ticket-index'))
                                <li class="nav-item">
                                    <a class="nav-link dropdown-toggle waves-effect waves-dark" href="{{ url('/tickets') }}"> <i class="mdi mdi-bell font-24"></i><span style="margin-top: 1.5em!important; position: absolute; margin-left: -0.8em;" class="badge badge-success badge-sm">{{\App\Ticket::where('status', '=', 'Open')->count()}}</span></a>
                                </li>
                                @endif
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle text-muted pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="../../assets/images/users/1.jpg" alt="user" class="rounded-circle" width="31"></a>
                                    <div class="dropdown-menu dropdown-menu-right user-dd animated">
                                        <a class="dropdown-item" href="{{ route('users.settings', auth()->user()->id) }}"><i class="ti-user m-r-5 m-l-5"></i> Mijn profiel</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                            <i class="fa fa-power-off m-r-5 m-l-5"></i> {{ __('Uitloggen') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                                <!-- ============================================================== -->
                                <!-- User profile and search -->
                                <!-- ============================================================== -->
                            </ul>
                        </div>
                    </nav>
                </header>

                    <aside class="left-sidebar" data-sidebarbg="skin5">
                        <!-- Sidebar scroll-->
                        <div class="scroll-sidebar">
                            <!-- Sidebar navigation-->
                            <nav class="sidebar-nav">
                                <ul id="sidebarnav" class="p-t-30 in">

                                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('home')}}" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a></li>
                                    <!-- Posts -->
                                    @role('admin')
                                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Nieuwsberichten </span></a>
                                        <ul aria-expanded="false" class="collapse first-level">
                                            <li class="sidebar-item"><a href="{{ route('posts.index') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Overzicht </span></a></li>
                                            <li class="sidebar-item"><a href="{{ route('posts.create') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Aanmaken </span></a></li>
                                        </ul>
                                    </li>
									@endrole
                                    <!-- Websites -->
                                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-sitemap"></i><span class="hide-menu">Websites </span></a>
                                        <ul aria-expanded="false" class="collapse first-level">
                                            <li class="sidebar-item"><a href="{{ route('sites.index') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Overzicht </span></a></li>
                                            <li class="sidebar-item"><a href="{{ route('sites.create') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Aanmaken </span></a></li>
                                        </ul>
                                    </li>
                                    <!-- Facturen -->
                                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-newspaper"></i><span class="hide-menu">Facturen </span></a>
                                        <ul aria-expanded="false" class="collapse first-level">
                                            <li class="sidebar-item"><a href="{{ route('invoices.index') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Overzicht </span></a></li>
                                            <li class="sidebar-item"><a href="{{ route('invoices.create') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Aanmaken </span></a></li>
                                        </ul>
                                    </li>
                                    <!-- Timer -->
                                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('timer')}}" aria-expanded="false"><i class="fas fa-stopwatch"></i><span class="hide-menu">Uren tracker</span></a></li>
                                    <!-- Klanten -->
                                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-account-box"></i><span class="hide-menu">Klanten </span></a>
                                        <ul aria-expanded="false" class="collapse first-level">
                                            <li class="sidebar-item"><a href="{{ route('clients.index') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Overzicht </span></a></li>
                                            <li class="sidebar-item"><a href="{{ route('clients.create') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Aanmaken </span></a></li>
                                        </ul>
                                    </li>
                                    <!-- tickets -->
                                    @if(auth()->user()->can('ticket-index'))
                                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fas fa-ticket-alt"></i><span class="hide-menu">Tickets </span></a>
                                        <ul aria-expanded="false" class="collapse first-level">
                                            <li class="sidebar-item"><a href="{{ url('/tickets') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Overzicht </span></a></li>
                                        </ul>
                                    </li>
                                    @endif
                                    <!-- users -->
                                    @if(auth()->user()->can('user-index'))
                                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fas fa-users"></i><span class="hide-menu">Gebruikers </span></a>
                                        <ul aria-expanded="false" class="collapse first-level">
                                            <li class="sidebar-item"><a href="{{ url('/users') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Overzicht </span></a></li>
                                            @role('admin')
                                            <li class="sidebar-item"><a href="{{ url('/users/addpermission') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Rechten toevoegen </span></a></li>
                                            @endrole
                                        </ul>
                                    </li>
                                    @endif
                                    @role('admin')
                                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="far fa-bell-slash"></i><span class="hide-menu">Rechten </span></a>
                                        <ul aria-expanded="false" class="collapse first-level">
                                            <li class="sidebar-item"><a href="{{ url('/permissions') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Overzicht </span></a></li>
                                        </ul>
                                    </li>
                                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="far fa-address-book"></i><span class="hide-menu">Rollen </span></a>
                                        <ul aria-expanded="false" class="collapse first-level">
                                            <li class="sidebar-item"><a href="{{ url('/roles') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Overzicht </span></a></li>
                                        </ul>
                                    </li>
                                    @endrole
                                </ul>
                            </nav>
                            <!-- End Sidebar navigation -->
                        </div>
                        <!-- End Sidebar scroll-->
                    </aside>
                @endguest

                @yield('content')

                <footer class="footer text-center">
                    All Rights Reserved by AdminUI <a href="">AdminUI</a>.
                </footer>
            </div>
        </main>
    </div>

        <!-- Scripts -->
        <script src="{{asset('/js/app.js')}}"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="{{ asset('assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js') }}"></script>
        <script src="{{ asset('assets/extra-libs/sparkline/sparkline.js') }}"></script>
        <!--Wave Effects -->
        <script src="{{ asset('dist/js/waves.js') }}"></script>
        <!--Menu sidebar -->
        <script src="{{ asset('dist/js/sidebarmenu.js') }}"></script>
        <!--Custom JavaScript -->
        <script src="{{ asset('dist/js/custom.min.js') }}"></script>
        <!-- Charts js Files -->
        <script src="{{ asset('assets/libs/flot/excanvas.js') }}"></script>
        <script src="{{ asset('assets/libs/flot/jquery.flot.js') }}"></script>
        <script src="{{ asset('assets/libs/flot/jquery.flot.pie.js') }}"></script>
        <script src="{{ asset('assets/libs/flot/jquery.flot.time.js') }}"></script>
        <script src="{{ asset('assets/libs/flot/jquery.flot.stack.js') }}"></script>
        <script src="{{ asset('assets/libs/flot/jquery.flot.crosshair.js') }}"></script>
        <script src="{{ asset('assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js') }}"></script>
        <script src="{{ asset('dist/js/pages/chart/chart-page-init.js') }} "></script>
        <!-- this page js -->
        <script src="{{ asset('dist/js/jquery.ui.touch-punch-improved.js') }}"></script>
        <script src="{{ asset('dist/js/jquery-ui.min.js') }}"></script>
        <script src="{{ asset('assets/libs/moment/min/moment.min.js') }}"></script>
        <script src="{{ asset('assets/libs/fullcalendar/dist/fullcalendar.min.js') }}"></script>
        <script src="{{ asset('assets/libs/fullcalendar/dist/locale/nl.js') }}"></script>
        <script src="{{ asset('dist/js/pages/calendar/cal-init.js') }}"></script>

        <script src="{{ asset('assets/extra-libs/multicheck/datatable-checkbox-init.js') }}"></script>
        <script src="{{ asset('assets/extra-libs/multicheck/jquery.multicheck.js') }}"></script>
        <script src="{{ asset('assets/extra-libs/DataTables/datatables.min.js') }}"></script>


        @yield('scripts')


</body>
</html>
