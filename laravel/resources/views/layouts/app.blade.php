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
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-bell font-24"></i>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="margin-left: -50px!important;">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </div>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="../../assets/images/users/1.jpg" alt="user" class="rounded-circle" width="31"></a>
                                    <div class="dropdown-menu dropdown-menu-right user-dd animated">
                                        <a class="dropdown-item" href="javascript:void(0)"><i class="ti-user m-r-5 m-l-5"></i> My Profile</a>
                                        <a class="dropdown-item" href="javascript:void(0)"><i class="ti-wallet m-r-5 m-l-5"></i> My Balance</a>
                                        <a class="dropdown-item" href="javascript:void(0)"><i class="ti-email m-r-5 m-l-5"></i> Inbox</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="javascript:void(0)"><i class="ti-settings m-r-5 m-l-5"></i> Account Setting</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                            <i class="fa fa-power-off m-r-5 m-l-5"></i> {{ __('Uitloggen') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                        <div class="dropdown-divider"></div>
                                        <div class="p-l-30 p-10"><a href="javascript:void(0)" class="btn btn-sm btn-success btn-rounded ml-3">View Profile</a></div>
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
                                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Nieuwsberichten </span></a>
                                        <ul aria-expanded="false" class="collapse first-level">
                                            <li class="sidebar-item"><a href="{{ route('posts.index') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Overzicht </span></a></li>
                                            <li class="sidebar-item"><a href="{{ route('posts.create') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Aanmaken </span></a></li>
                                        </ul>
                                    </li>
                                    <!-- Websites -->
                                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Websites </span></a>
                                        <ul aria-expanded="false" class="collapse first-level">
                                            <li class="sidebar-item"><a href="{{ route('sites.index') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Overzicht </span></a></li>
                                            <li class="sidebar-item"><a href="{{ route('sites.create') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Aanmaken </span></a></li>
                                        </ul>
                                    </li>
                                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('timer')}}" aria-expanded="false"><i class="fas fa-stopwatch"></i><span class="hide-menu">Uren tracker</span></a></li>
{{--                                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="charts.html" aria-expanded="false"><i class="mdi mdi-chart-bar"></i><span class="hide-menu">Charts</span></a></li>--}}
{{--                                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="widgets.html" aria-expanded="false"><i class="mdi mdi-chart-bubble"></i><span class="hide-menu">Widgets</span></a></li>--}}
{{--                                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="tables.html" aria-expanded="false"><i class="mdi mdi-border-inside"></i><span class="hide-menu">Tables</span></a></li>--}}
{{--                                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="grid.html" aria-expanded="false"><i class="mdi mdi-blur-linear"></i><span class="hide-menu">Full Width</span></a></li>--}}
{{--                                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Forms </span></a>--}}
{{--                                        <ul aria-expanded="false" class="collapse first-level">--}}
{{--                                            <li class="sidebar-item"><a href="#" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Form Basic </span></a></li>--}}
{{--                                            <li class="sidebar-item"><a href="form-wizard.html" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> Form Wizard </span></a></li>--}}
{{--                                        </ul>--}}
{{--                                    </li>--}}
{{--                                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="pages-buttons.html" aria-expanded="false"><i class="mdi mdi-relative-scale"></i><span class="hide-menu">Buttons</span></a></li>--}}
{{--                                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-face"></i><span class="hide-menu">Icons </span></a>--}}
{{--                                        <ul aria-expanded="false" class="collapse first-level">--}}
{{--                                            <li class="sidebar-item"><a href="icon-material.html" class="sidebar-link"><i class="mdi mdi-emoticon"></i><span class="hide-menu"> Material Icons </span></a></li>--}}
{{--                                            <li class="sidebar-item"><a href="icon-fontawesome.html" class="sidebar-link"><i class="mdi mdi-emoticon-cool"></i><span class="hide-menu"> Font Awesome Icons </span></a></li>--}}
{{--                                        </ul>--}}
{{--                                    </li>--}}
{{--                                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="pages-elements.html" aria-expanded="false"><i class="mdi mdi-pencil"></i><span class="hide-menu">Elements</span></a></li>--}}
{{--                                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-move-resize-variant"></i><span class="hide-menu">Addons </span></a>--}}
{{--                                        <ul aria-expanded="false" class="collapse first-level">--}}
{{--                                            <li class="sidebar-item"><a href="#" class="sidebar-link"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu"> Dashboard-2 </span></a></li>--}}
{{--                                            <li class="sidebar-item"><a href="pages-gallery.html" class="sidebar-link"><i class="mdi mdi-multiplication-box"></i><span class="hide-menu"> Gallery </span></a></li>--}}
{{--                                            <li class="sidebar-item"><a href="pages-calendar.html" class="sidebar-link"><i class="mdi mdi-calendar-check"></i><span class="hide-menu"> Calendar </span></a></li>--}}
{{--                                            <li class="sidebar-item"><a href="pages-invoice.html" class="sidebar-link"><i class="mdi mdi-bulletin-board"></i><span class="hide-menu"> Invoice </span></a></li>--}}
{{--                                            <li class="sidebar-item"><a href="pages-chat.html" class="sidebar-link"><i class="mdi mdi-message-outline"></i><span class="hide-menu"> Chat Option </span></a></li>--}}
{{--                                        </ul>--}}
{{--                                    </li>--}}
{{--                                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-account-key"></i><span class="hide-menu">Authentication </span></a>--}}
{{--                                        <ul aria-expanded="false" class="collapse first-level">--}}
{{--                                            <li class="sidebar-item"><a href="authentication-login.html" class="sidebar-link"><i class="mdi mdi-all-inclusive"></i><span class="hide-menu"> Login </span></a></li>--}}
{{--                                            <li class="sidebar-item"><a href="authentication-register.html" class="sidebar-link"><i class="mdi mdi-all-inclusive"></i><span class="hide-menu"> Register </span></a></li>--}}
{{--                                        </ul>--}}
{{--                                    </li>--}}
{{--                                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-alert"></i><span class="hide-menu">Errors </span></a>--}}
{{--                                        <ul aria-expanded="false" class="collapse first-level">--}}
{{--                                            <li class="sidebar-item"><a href="error-403.html" class="sidebar-link"><i class="mdi mdi-alert-octagon"></i><span class="hide-menu"> Error 403 </span></a></li>--}}
{{--                                            <li class="sidebar-item"><a href="error-404.html" class="sidebar-link"><i class="mdi mdi-alert-octagon"></i><span class="hide-menu"> Error 404 </span></a></li>--}}
{{--                                            <li class="sidebar-item"><a href="error-405.html" class="sidebar-link"><i class="mdi mdi-alert-octagon"></i><span class="hide-menu"> Error 405 </span></a></li>--}}
{{--                                            <li class="sidebar-item"><a href="error-500.html" class="sidebar-link"><i class="mdi mdi-alert-octagon"></i><span class="hide-menu"> Error 500 </span></a></li>--}}
{{--                                        </ul>--}}
{{--                                    </li>--}}
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
