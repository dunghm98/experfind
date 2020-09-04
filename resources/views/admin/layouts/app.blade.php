<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link href="{{ asset('plugins/fontawesome/css/fontawesome.min.css') }}" rel="stylesheet">
        <link href="{{ asset('plugins/fontawesome/css/all.min.css') }}" rel="stylesheet">

        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.png') }}">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{ asset('admin/assets/css/bootstrap.min.css') }}">

        <!-- Fontawesome CSS -->
        <link rel="stylesheet" href="{{ asset('admin/assets/css/font-awesome.min.css') }}">

        <!-- Feathericon CSS -->
        <link rel="stylesheet" href="{{ asset('admin/assets/css/feathericon.min.css') }}">

        <link rel="stylesheet" href="{{ asset('admin/assets/plugins/morris/morris.css') }}">

        <!-- Main CSS -->
        <link rel="stylesheet" href="{{ asset('admin/assets/css/style.css') }}">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('css/week-day-calendar.css')}}">

        {{--        select2--}}
        <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />


    </head>
    <body>

            <!-- Main Wrapper -->
            <div class="main-wrapper">

                <!-- Header -->
                <div class="header">

                    <!-- Logo -->
                    <div class="header-left">
                        <a href="{{route('showDashBoard')}}" class="logo">
                            <img src="{{ asset('img/experfind.png') }}" alt="Logo">
                        </a>
                        <a href="{{route('showDashBoard')}}" class="logo logo-small">
                            <img src="assets/img/logo-small.png" alt="Logo" width="30" height="30">
                        </a>
                    </div>
                    <!-- /Logo -->

                    <a href="javascript:void(0);" id="toggle_btn">
                        <i class="fe fe-text-align-left"></i>
                    </a>

                    <div class="top-nav-search">
                        <form>
                            <input type="text" class="form-control" placeholder="Search here">
                            <button class="btn" type="submit"><i class="fa fa-search"></i></button>
                        </form>
                    </div>

                    <!-- Mobile Menu Toggle -->
                    <a class="mobile_btn" id="mobile_btn">
                        <i class="fa fa-bars"></i>
                    </a>
                    <!-- /Mobile Menu Toggle -->

                    <!-- Header Right Menu -->
                    <ul class="nav user-menu">

                        <!-- Notifications -->
                        <li class="nav-item dropdown noti-dropdown">
                            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                                <i class="fe fe-bell"></i> <span class="badge badge-pill">3</span>
                            </a>
                            <div class="dropdown-menu notifications">
                                <div class="topnav-dropdown-header">
                                    <span class="notification-title">Notifications</span>
                                    <a href="javascript:void(0)" class="clear-noti"> Clear All </a>
                                </div>
                                <div class="noti-content">
                                    <ul class="notification-list">
                                        <li class="notification-message">
                                            <a href="#">
                                                <div class="media">
												<span class="avatar avatar-sm">
													<img class="avatar-img rounded-circle" alt="User Image" src="assets/img/doctors/doctor-thumb-01.jpg">
												</span>
                                                    <div class="media-body">
                                                        <p class="noti-details"><span class="noti-title">Dr. Ruby Perrin</span> Schedule <span class="noti-title">her appointment</span></p>
                                                        <p class="noti-time"><span class="notification-time">4 mins ago</span></p>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="notification-message">
                                            <a href="#">
                                                <div class="media">
												<span class="avatar avatar-sm">
													<img class="avatar-img rounded-circle" alt="User Image" src="assets/img/patients/patient1.jpg">
												</span>
                                                    <div class="media-body">
                                                        <p class="noti-details"><span class="noti-title">Charlene Reed</span> has booked her appointment to <span class="noti-title">Dr. Ruby Perrin</span></p>
                                                        <p class="noti-time"><span class="notification-time">6 mins ago</span></p>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="notification-message">
                                            <a href="#">
                                                <div class="media">
												<span class="avatar avatar-sm">
													<img class="avatar-img rounded-circle" alt="User Image" src="assets/img/patients/patient2.jpg">
												</span>
                                                    <div class="media-body">
                                                        <p class="noti-details"><span class="noti-title">Travis Trimble</span> sent a amount of $210 for his <span class="noti-title">appointment</span></p>
                                                        <p class="noti-time"><span class="notification-time">8 mins ago</span></p>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="notification-message">
                                            <a href="#">
                                                <div class="media">
												<span class="avatar avatar-sm">
													<img class="avatar-img rounded-circle" alt="User Image" src="assets/img/patients/patient3.jpg">
												</span>
                                                    <div class="media-body">
                                                        <p class="noti-details"><span class="noti-title">Carl Kelly</span> send a message <span class="noti-title"> to his doctor</span></p>
                                                        <p class="noti-time"><span class="notification-time">12 mins ago</span></p>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="topnav-dropdown-footer">
                                    <a href="#">View all Notifications</a>
                                </div>
                            </div>
                        </li>
                        <!-- /Notifications -->

                        <!-- User Menu -->
                        <li class="nav-item dropdown has-arrow">
                            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                                <span class="user-img"><img class="rounded-circle" src="assets/img/profiles/avatar-01.jpg" width="31" alt="Ryan Taylor"></span>
                            </a>
                            <div class="dropdown-menu">
                                <div class="user-header">
                                    <div class="avatar avatar-sm">
                                        <img src="assets/img/profiles/avatar-01.jpg" alt="User Image" class="avatar-img rounded-circle">
                                    </div>
                                    <div class="user-text">
{{--                                        <h6>{{auth()->user()->name}}</h6>--}}
                                        <p class="text-muted mb-0">Administrator</p>
                                    </div>
                                </div>
                                <div>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <br>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </li>
                        <!-- /User Menu -->

                    </ul>
                    <!-- /Header Right Menu -->

                </div>
                <!-- /Header -->

                <!-- Sidebar -->
                <div class="sidebar" id="sidebar">
                    <div class="sidebar-inner slimscroll">
                        <div id="sidebar-menu" class="sidebar-menu">
                            <ul>
                                <li class="menu-title">
                                    <span>Main</span>
                                </li>
                                <li class="{{ Request::path() == 'admin/dashboard' ? 'active' : '' }}">
                                    <a href="{{route('showDashBoard')}}"><i class="fe fe-home"></i> <span>Dashboard</span></a>
                                </li>
                                <li class="{{ Request::path() == 'admin/cities' ? 'active' : '' }}" >
                                    <a href="{{ route('showCities') }}"><i class="fe fe-layout"></i> <span>Thành phố</span></a>
                                </li>
                                <li class="{{ Request::path() == 'admin/districts' ? 'active' : '' }}">
                                    <a href="{{route('showDistricts')}}"><i class="fe fe-users"></i> <span>Quận huyện</span></a>
                                </li>
                                <li class="{{ Request::path() == 'admin/specialities' ? 'active' : '' }}">
                                    <a href="{{route('showSpecialities')}}"><i class="fe fe-user-plus"></i> <span>Chuyên môn</span></a>
                                </li>
                                <li class="{{ Request::path() == 'admin/subjects' ? 'active' : '' }}">
                                    <a href="{{route('showSubjects')}}"><i class="fe fe-user-plus"></i> <span>Môn học</span></a>
                                </li>
                                <li class="{{ Request::path() == 'admin/tutors' ? 'active' : '' }}">
                                    <a href="{{route('showTutors')}}"><i class="fe fe-user-plus"></i> <span>Gia sư</span></a>
                                </li>
                                <li class="{{ Request::path() == 'admin/students' ? 'active' : '' }}">
                                    <a href="{{route('showStudents')}}"><i class="fe fe-user-plus"></i> <span>Học sinh</span></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /Sidebar -->

                @yield('admin-content')

            </div>
            <!-- /Main Wrapper -->
        <!-- jQuery -->
        <script src="{{asset('admin/assets/js/jquery-3.2.1.min.js')}}"></script>

        <!-- Bootstrap Core JS -->
        <script src="{{asset('admin/assets/js/popper.min.js')}}"></script>
        <script src="{{asset('admin/assets/js/bootstrap.min.js')}}"></script>

        <!-- Slimscroll JS -->
        <script src="{{asset('admin/assets/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>

        <script src="{{asset('admin/assets/plugins/raphael/raphael.min.js')}}"></script>
        <script src="{{asset('admin/assets/plugins/morris/morris.min.js')}}"></script>
        <script src="{{asset('admin/assets/js/chart.morris.js')}}"></script>

        <!-- Custom JS -->
        <script  src="{{asset('admin/assets/js/script.js')}}"></script>
            @yield('js_admin')
    </body>
</html>
