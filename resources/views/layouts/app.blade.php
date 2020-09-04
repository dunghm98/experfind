<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @routes()

    <title>{{ config('app.name', 'Experfind') }}</title>

    <!-- Scripts -->
    <!-- jQuery -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Favicons -->
    <link type="image/x-icon" href="{{ asset('img/favicon.png') }}" rel="icon">
    <!-- Fonts -->
    <!-- Fontawesome CSS -->
    <link href="{{ asset('plugins/fontawesome/css/fontawesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/fontawesome/css/all.min.css') }}" rel="stylesheet">

{{--    For search--}}
<!-- Datetimepicker CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap-datetimepicker.min.css') }}">

    <!-- Select2 CSS -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">

    <!-- Fancybox CSS -->
    <link rel="stylesheet" href="{{ asset('plugins/fancybox/jquery.fancybox.min.css') }}">
    <!-- Bootstrap CSS Tag input -->
    <link rel="stylesheet" href="{{asset('plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css')}}">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Main CSS -->

    <link rel="stylesheet" href="{{asset('css/week-day-calendar.css')}}">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.rawgit.com/kottenator/jquery-circle-progress/1.2.0/dist/circle-progress.js"></script>
</head>
@yield('booking-modal-css')
<body>
    <div class="main-wrapper" id="app">
        <!-- Header -->
        <header class="header">
            <nav class="navbar navbar-expand-lg header-nav">
                <div class="navbar-header">
                    <a id="mobile_btn" href="javascript:void(0);">
							<span class="bar-icon">
								<span></span>
								<span></span>
								<span></span>
							</span>
                    </a>
                    <a href="{{ url('/') }}" class="navbar-brand logo">
                        <img src="{{ asset('img/experfind.png') }}" class="img-fluid" alt="Logo">
                    </a>
                </div>
                <div class="main-menu-wrapper">
                    <div class="menu-header">
                        <a href="{{ url('/') }}" class="menu-logo">
                            <img src="{{ asset('img/experfind.png') }}" class="img-fluid" alt="Logo">
                        </a>
                        <a id="menu_close" class="menu-close" href="javascript:void(0);">
                            <i class="fas fa-times"></i>
                        </a>
                    </div>
                    <ul class="main-nav">
                        <li class="{{ Request::path() == '/' ? 'active' : '' }}">
                            <a href="/">Trang Chủ</a>
                        </li>
                        <li class="has-submenu {{ Request::path() == 'search' ||  Request::route()->getName() == 'tutor-profile' ? 'active' : '' }}" >
                            <a href="{{route('list-tutor')}}">Gia Sư <i class="fas fa-chevron-down"></i></a>
                            <ul class="submenu">
                                <li><a href="{{route('list-tutor')}}">Danh sách gia sư</a></li>
                                @if (auth()->check())
                                    @can('view', auth()->user()->tutor)
                                        <li><a href="{{route('tutor.showProfile')}}">Dashboard</a></li>
                                    @endcan
                                @endif
                            </ul>
                        </li>
                        <li class="has-submenu {{ Request::route()->getName() == 'request.list' || Request::route()->getName() == 'request.detail' ? 'active' : '' }}">
                            <a href="{{ route('request.list') }}">Học sinh<i class="fas fa-chevron-down"></i></a>
                            <ul class="submenu">
                                <li><a href="{{ route('request.list') }}">Lớp mới đang tìm gia sư</a></li>
                                @if (auth()->check())
                                    @can('view', auth()->user()->student)
                                        <li><a href="{{ route('students.getProfile') }}">Dashboard</a></li>
                                    @endcan
                                @endif
                            </ul>
                        </li>
                        @if (auth()->check())
                            @can('view', auth()->user()->student)
                                <li class="has-submenu {{Request::route()->getName() == 'request.create' ? 'active' : '' }}">
                                    <a href="{{route('request.create')}}" >Đăng yêu cầu tìm gia sư</a>
                                </li>
                            @endcan
                        @endif

                    </ul>
                </div>
                <ul class="nav header-navbar-rht">
                    <li class="nav-item contact-item">
                        <div class="header-contact-img">
                            <i class="fa fa-book-reader"></i>
                        </div>
                        <div class="header-contact-detail">
{{--                            <p class="contact-header">Hi</p>--}}
                        </div>
                    </li>

                    <!-- Authentication Links -->
                    @guest

                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link header-login" href="{{ route('login') }}">Đăng ký / Đăng nhập </a>
                          </li>
                        @endif
                    @else
{{--                        <li class="nav-item dropdown">--}}
{{--                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>--}}
{{--                                {{ Auth::user()->name }} <span class="caret"></span>--}}
{{--                            </a>--}}
{{--                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">--}}
{{--                                <a class="dropdown-item" href="{{ route('logout') }}"--}}
{{--                                   onclick="event.preventDefault();--}}
{{--                                                     document.getElementById('logout-form').submit();">--}}
{{--                                    {{ __('Logout') }}--}}
{{--                                </a>--}}
{{--                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">--}}
{{--                                    @csrf--}}
{{--                                </form>--}}
{{--                            </div>--}}
{{--                        </li>--}}
                        <!-- User Menu -->
                        <li class="nav-item dropdown has-arrow logged-item">
                            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
								<span class="user-img">
									<img class="rounded-circle" src="{{asset(Auth::user()->avatar ? 'storage/'. Auth::user()->avatar : (Auth::user()->gender == 1 ? 'img/tutors/avatars/default-boy.png':'img/tutors/avatars/default-girl.png' ))}}" width="31" alt="{{ Auth::user()->name }}">
								</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <div class="user-header">
                                    <div class="avatar avatar-sm">
                                        <img src="{{asset(Auth::user()->avatar ? 'storage/'. Auth::user()->avatar : (Auth::user()->gender == 1 ? 'img/tutors/avatars/default-boy.png':'img/tutors/avatars/default-girl.png' ))}}" alt="User Image" class="avatar-img rounded-circle">
                                    </div>
                                    <div class="user-text">
                                        <h6>{{ Auth::user()->name }}</h6>
                                        <p class="text-muted mb-0">{{Auth::user()->isTutor()? 'Gia sư' : 'Học sinh'}}</p>
                                    </div>
                                </div>
                                @can('view', auth()->user()->student)
                                    <a class="dropdown-item" href="{{ route('student.dashboard') }}">Dashboard</a>
                                    <a class="dropdown-item" href="{{ route('students.getProfile') }}">Trang cá nhân</a>
                                @endcan
                                @can('view', auth()->user()->tutor)
                                    <a class="dropdown-item" href="{{ route('tutor.dashboard') }}">Dashboard</a>
                                    <a class="dropdown-item" href="{{ route('tutor.showProfile') }}">Trang cá nhân</a>
                                @endcan


                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Đăng xuất') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        <!-- /User Menu -->
                    @endguest
                </ul>
            </nav>
        </header>
        <!-- /Header -->

        <main class="py-4">
            @yield('content')
        </main>
        @include('footer')
    </div>
    @yield('call-modal')

    <!-- Scripts -->


    <!-- Bootstrap Core JS -->
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

    <!-- Slick JS -->
    <script src="{{ asset('js/slick.js') }}"></script>


    <script>
        $(".clickable-row").click(function(){
            window.location = $(this).data("href");
            // console.log($(this).data("href"));
        });
    </script>


    <!-- Select2 JS -->
    <script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>

    <!-- Datetimepicker JS -->
    <script src="{{ asset('js/moment.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datetimepicker.min.js') }}"></script>

    <!-- Fancybox JS -->
    <script src="{{ asset('plugins/fancybox/jquery.fancybox.min.js') }}"></script>
    <!-- Dropzone JS -->
    <script src="{{ asset('plugins/dropzone/dropzone.min.js') }}"></script>

    <!-- Bootstrap Tagsinput JS -->
    <script src="{{ asset('plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.js') }}"></script>

    <!-- Profile Settings JS -->
    <script src="{{ asset('js/profile-settings.js') }}"></script>
    <!-- Sticky Sidebar JS -->
    <script src="{{ asset('plugins/theia-sticky-sidebar/ResizeSensor.js') }}"></script>
    <script src="{{ asset('plugins/theia-sticky-sidebar/theia-sticky-sidebar.js') }}"></script>
    <!-- Custom JS -->
    <script src="{{ asset('js/script.js') }}"></script>

    @yield('bottom.js')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
    </script>
</body>
</html>
