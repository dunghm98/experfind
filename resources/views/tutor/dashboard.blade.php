@extends('layouts.app')

@section('content')
    <!-- Breadcrumb -->
    <div class="breadcrumb-bar">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-12 col-12">
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                        </ol>
                    </nav>
                    <h2 class="breadcrumb-title">Dashboard</h2>
                </div>
            </div>
        </div>
    </div>
    <!-- /Breadcrumb -->

    <!-- Page Content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">

                    <!-- Profile Sidebar -->
                    <div class="profile-sidebar">
                        <div class="widget-profile pro-widget-content">
                            <div class="profile-info-widget">
                                <a href="#" class="booking-doc-img">
{{--                                    @dd(auth()->user())--}}
                                    <img src="{{asset(auth()->user()->avatar ? 'storage/'. auth()->user()->avatar : (auth()->user()->gender == 1 ? 'img/tutors/avatars/default-boy.png':'img/tutors/avatars/default-girl.png' ))}}" alt="User Image">
                                </a>
                                <div class="profile-det-info">
                                    <h3>{{auth()->user()->name}}</h3>

                                    <div class="patient-details">
{{--                                        <h5 class="mb-0">Sinh viên Đại học Ngoại Thương</h5>--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="dashboard-widget">
                            <nav class="dashboard-menu">
                                <ul>
                                    <li class="{{ Request::path() == 'tutor/dashboard' ? 'active' : '' }}">
                                        <a href="{{route('tutor.dashboard')}}">
                                            <i class="fas fa-columns"></i>
                                            <span>Dashboard</span>
                                        </a>
                                    </li>
                                    <li class="{{ Request::path() == 'tutor/dashboard/appointment' ? 'active' : '' }}">
                                        <a href="{{route('tutor.listAppointment')}}">
                                            <i class="fas fa-calendar-check"></i>
                                            <span>Toàn bộ lịch hẹn</span>
                                        </a>
                                    </li>
                                    <li class="{{ Request::path() == 'tutor/student' ? 'active' : '' }}">
                                        <a href="/tutor/student">
                                            <i class="fas fa-user-injured"></i>
                                            <span>Học sinh</span>
                                        </a>
                                    </li>
                                    <li class="{{ Request::path() == 'tutor/dashboard/schedule' ? 'active' : '' }}">
                                        <a href="/tutor/dashboard/schedule">
                                            <i class="fas fa-hourglass-start"></i>
                                            <span>Thời gian biểu</span>
                                        </a>
                                    </li>
                                    <li class="{{ Request::path() == 'tutor/transaction' ? 'active' : '' }}">
                                        <a href="#">
                                            <i class="fas fa-file-invoice"></i>
                                            <span>Hóa đơn</span>
                                        </a>
                                    </li>
                                    <li class="{{ Request::path() == 'tutor/review' ? 'active' : '' }}">
                                        <a href="#">
                                            <i class="fas fa-star"></i>
                                            <span>Đánh giá</span>
                                        </a>
                                    </li>
                                    <li class="{{ Request::path() == 'tutor/message' ? 'active' : '' }}">
                                        <a href="#">
                                            <i class="fas fa-comments"></i>
                                            <span>Tin nhắn</span>
                                            <small class="unread-msg">23</small>
                                        </a>
                                    </li>
                                    <li  class="{{ Request::path() == 'tutor/dashboard/profile' ? 'active' : '' }}">
                                        <a href="{{ route('tutor.showProfile')}}">
                                            <i class="fas fa-user-cog"></i>
                                            <span>Thông tin cá nhân</span>
                                        </a>
                                    </li>
                                    <li class="{{ Request::path() == 'tutor/social' ? 'active' : '' }}">
                                        <a href="/tutor/social">
                                            <i class="fas fa-share-alt"></i>
                                            <span>Mạng xã hội</span>
                                        </a>
                                    </li>
                                    <li class="{{ Request::path() == 'tutor/change-password' ? 'active' : '' }}">
                                        <a href="/tutor/change-password">
                                            <i class="fas fa-lock"></i>
                                            <span>Đổi mật khẩu</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/logout">
                                            <i class="fas fa-sign-out-alt"></i>
                                            <span>Đăng xuất</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <!-- /Profile Sidebar -->
                </div>
                @yield('dashboard-content')
            </div>

        </div>

    </div>
    <!-- /Page Content -->

@endsection
