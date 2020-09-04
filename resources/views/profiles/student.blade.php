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
                            <li class="breadcrumb-item active" aria-current="page">Học sinh</li>
                        </ol>
                    </nav>
                    <h2 class="breadcrumb-title">Thông tin học sinh</h2>
                </div>
            </div>
        </div>
    </div>
    <!-- /Breadcrumb -->

    <!-- Page Content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar dct-dashbd-lft">

                    <!-- Profile Widget -->
                    <div class="card widget-profile pat-widget-profile">
                        <div class="card-body">
                            <div class="pro-widget-content">
                                <div class="profile-info-widget">
                                    <a href="#" class="booking-doc-img">
                                        <img class="img-fluid" src="{{asset($student->user->avatar ? 'storage/'. $student->user->avatar : ($student->user->gender == 1 ? 'img/tutors/avatars/default-boy.png':'img/tutors/avatars/default-girl.png' ))}}" alt="User Image">
                                    </a>
                                    <div class="profile-det-info">
                                        <h3>{{$student->user->name}}</h3>

                                        <div class="patient-details">
                                            <h5><b>Student ID :</b> ST{{$student->id}}</h5>
                                            <h5 class="mb-0"><i class="fas fa-map-marker-alt"></i>{{ $student->user->address ?? '' }}, {{ $student->user->district->name ?? '' }}, {{ $student->user->city->name ?? '' }}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="patient-info">
                                <ul>
                                    <li>Điện thoại <span>{{$student->phone}}</span></li>
                                    <li>Tuổi <span>{{$student->user->getAge()}} Tuổi</span></li>
                                    <li>Giới tính <span>{{$student->user->gender == 1 ? 'Nam' : 'Nữ'}}</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- /Profile Widget -->

                    <!-- Last Booking -->
{{--                    <div class="card">--}}
{{--                        <div class="card-header">--}}
{{--                            <h4 class="card-title">Last Booking</h4>--}}
{{--                        </div>--}}
{{--                        <ul class="list-group list-group-flush">--}}
{{--                            <li class="list-group-item">--}}
{{--                                <div class="media align-items-center">--}}
{{--                                    <div class="mr-3">--}}
{{--                                        <img alt="Image placeholder" src="assets/img/doctors/doctor-thumb-02.jpg" class="avatar  rounded-circle">--}}
{{--                                    </div>--}}
{{--                                    <div class="media-body">--}}
{{--                                        <h5 class="d-block mb-0">Dr. Darren Elder </h5>--}}
{{--                                        <span class="d-block text-sm text-muted">Dentist</span>--}}
{{--                                        <span class="d-block text-sm text-muted">14 Nov 2019 5.00 PM</span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                            <li class="list-group-item">--}}
{{--                                <div class="media align-items-center">--}}
{{--                                    <div class="mr-3">--}}
{{--                                        <img alt="Image placeholder" src="assets/img/doctors/doctor-thumb-02.jpg" class="avatar  rounded-circle">--}}
{{--                                    </div>--}}
{{--                                    <div class="media-body">--}}
{{--                                        <h5 class="d-block mb-0">Dr. Darren Elder </h5>--}}
{{--                                        <span class="d-block text-sm text-muted">Dentist</span>--}}
{{--                                        <span class="d-block text-sm text-muted">12 Nov 2019 11.00 AM</span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
                    <!-- /Last Booking -->

                </div>

                <div class="col-md-7 col-lg-8 col-xl-9">
                    <div class="card">
                        <div class="card-body pt-0">

                            <!-- Tab Menu -->
                            <nav class="user-tabs mb-4">
                                <ul class="nav nav-tabs nav-tabs-bottom nav-justified">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#pat_appointments" data-toggle="tab">Các lớp đã đăng</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#pat_prescriptions" data-toggle="tab">Các lớp nhận thành công</a>
                                    </li>
                                </ul>
                            </nav>
                            <!-- /Tab Menu -->

                            <!-- Tab Content -->
                            <div class="tab-content pt-0">

                                <!-- Appointment Tab -->
                                <div id="pat_appointments" class="tab-pane fade show active">
                                    <div class="message-box"></div>
                                    <div class="card card-table mb-0">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-hover table-center mb-0">
                                                    <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Nội dung lớp học</th>
                                                        <th>Ngày đăng</th>
                                                        <th>Học phí</th>
                                                        <th>Địa chỉ</th>
                                                        <th>Trạng thái</th>
                                                        <th></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($student->requests as $request)
                                                        <tr class="clickable-row" data-href="{{route('request.detail', $request)}}">
                                                            <td>
                                                                {{$request->id}}
                                                            </td>
                                                            <td> {{$request->short_description}}</td>
                                                            <td>{{date('d/m/Y', strtotime($request->created_at))}}</td>
                                                            <td>{{$request->expect_fee}} VND</td>
                                                            <td>{{$request->city->name ?? 'Học online'}}</td>
                                                            <td>
                                                                @if($request->status===0)
                                                                    <span class="badge badge-pill bg-info-light">Đang tìm</span>
                                                                @endif
                                                                @if($request->status===2)
                                                                    <span class="badge badge-pill bg-warning-light">Đấu giá</span>
                                                                @endif
                                                                @if($request->status===3)
                                                                    <span class="badge badge-pill bg-success-light">Đã tìm thấy</span>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Appointment Tab -->

                                <!-- Prescription Tab -->
                                <div class="tab-pane fade" id="pat_prescriptions">
                                    <div class="card card-table mb-0">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <!-- Appointment Tab -->
                                                <div id="pat_appointments" class="tab-pane fade show active">
                                                    <div class="card card-table mb-0">
                                                        <div class="card-body">
                                                            <div class="table-responsive">
                                                                <table class="table table-hover table-center mb-0">
                                                                    <thead>
                                                                    <tr>
                                                                        <th>Gia sư</th>
                                                                        <th>Nhận lớp</th>
                                                                        <th style="width: 15%">Status</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    @foreach($student->requests as $request)
                                                                        @foreach($request->tutors as $key => $tutorApply)
                                                                            @if($request->status == 3 && $tutorApply->pivot->status == 3 )
                                                                                <tr class="request-cont" id="request-{{$key}}"  data-tutor="{{$tutorApply->id}}" data-request="{{ $request->id }}">
                                                                                    <td>
                                                                                        <h2 class="table-avatar">
                                                                                            <a href="{{route('tutor-profile',$tutorApply->id)}}" class="avatar avatar-sm mr-2">
                                                                                                <img class="avatar-img rounded-circle" src="{{asset($tutorApply->user->avatar ? 'storage/'. $tutorApply->user->avatar : ($tutorApply->user->gender == 1 ? 'img/tutors/avatars/default-boy.png':'img/tutors/avatars/default-girl.png' ))}}" alt="User Image">
                                                                                            </a>
                                                                                            <a href="{{route('tutor-profile',$tutorApply->id)}}">{{$tutorApply->user->name}} <span>{{$tutorApply->type_of_tutor == 0 ? 'Sinh viên' : 'Giáo viên'}}</span></a>
                                                                                        </h2>
                                                                                    </td>
                                                                                    <td>
                                                                                        {{$request->short_description}}
                                                                                    </td>
                                                                                        <td><span class="badge badge-pill bg-primary-light">Đã nhận dạy</span></td>
                                                                                </tr>
                                                                            @endif
                                                                        @endforeach
                                                                    @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /Appointment Tab -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Prescription Tab -->

                            </div>
                            <!-- Tab Content -->

                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <!-- /Page Content -->

@endsection
