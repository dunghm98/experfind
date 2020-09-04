@extends('layouts.app')

@section('content')
    <!-- Page Content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">

                <!-- Profile Sidebar -->
                <div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">
                    <div class="profile-sidebar">
                        <div class="widget-profile pro-widget-content">
                            <div class="profile-info-widget">
                                <a href="#" class="booking-doc-img">
                                    <img src="{{asset(auth()->user()->avatar ? 'storage/'. auth()->user()->avatar : (auth()->user()->gender == 1 ? 'img/tutors/avatars/default-boy.png':'img/tutors/avatars/default-girl.png' ))}}" alt="User Image">
                                </a>
                                <div class="profile-det-info">
                                    <h3>{{auth()->user()->name}}</h3>
                                    <div class="patient-details">
                                        <h5><i class="fas fa-birthday-cake"></i> {{date('d/m/Y', strtotime(auth()->user()->dob))}}</h5>
                                        <h5 class="mb-0"><i class="fas fa-map-marker-alt"></i> {{ auth()->user()->city->name ?? '' }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
{{--                        {{ dd(Request::path()) }}--}}
                        <div class="dashboard-widget">
                            <nav class="dashboard-menu">
                                <ul>
                                    <li class="{{ Request::path() == 'student/dashboard' ? 'active' : '' }}">
                                        <a href="{{ route('student.dashboard') }}">
                                            <i class="fas fa-columns"></i>
                                            <span>Dashboard</span>
                                        </a>
                                    </li>
                                    <li class="{{ Request::path() == 'student/favorite-tutor' ? 'active' : '' }}">
                                        <a href="/student/favorite-tutor">
                                            <i class="fas fa-bookmark"></i>
                                            <span>Gia sư yêu thích</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fas fa-comments"></i>
                                            <span>Tin nhắn</span>
                                            <small class="unread-msg">23</small>
                                        </a>
                                    </li>
                                    <li class="{{ Request::path() == 'student/profile' ? 'active' : '' }}">
                                        <a href="/student/profile">
                                            <i class="fas fa-user-cog"></i>
                                            <span>Thông tin cá nhân</span>
                                        </a>
                                    </li>
                                    <li class="{{ Request::path() == 'student/change-password' ? 'active' : '' }}">
                                        <a href="/student/change-password">
                                            <i class="fas fa-lock"></i>
                                            <span>Đổi mật khẩu</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <i class="fas fa-sign-out-alt"></i>
                                            <span>Đăng xuất</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <!-- /Profile Sidebar -->

                @yield('student-dashboard-content')
            </div>
        </div>

    </div>
    <!-- /Page Content -->
@endsection
