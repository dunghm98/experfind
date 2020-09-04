@extends('student.dashboard')

@section('bottom.js')
    <script src="{{asset('js/student/mainDashboard.js')}}"></script>
@endsection


@section('student-dashboard-content')


    <div class="col-md-7 col-lg-8 col-xl-9">
        <div class="card">
            <div class="card-body pt-0">

                <!-- Tab Menu -->
                <nav class="user-tabs mb-4">
                    <ul class="nav nav-tabs nav-tabs-bottom nav-justified">
                        <li class="nav-item">
                            <a class="nav-link active" href="#pat_appointments" data-toggle="tab">Gia sư nhận dạy</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#pat_appointments_next" data-toggle="tab">Các lớp mời gia sư dạy</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#pat_prescriptions" data-toggle="tab">Các lớp đã đăng</a>
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
                                            <th>Gia sư</th>
                                            <th>Nhận lớp</th>
                                            <th>Status</th>
                                            <th class="text-right">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($student->requests as $request)
                                            @foreach($request->tutors as $key => $tutorApply)
                                                @if($tutorApply->pivot->sender == 1 )
                                                    <tr class="request-cont" id="request-{{$key}}"  data-tutor="{{$tutorApply->id}}" data-request="{{ $request->id }}">
                                                        <td>
                                                            <h2 class="table-avatar">
                                                                <a href="{{route('tutor-profile',$tutorApply->id)}}" class="avatar avatar-sm mr-2">
                                                                    <img class="avatar-img rounded-circle" src="{{asset($tutorApply->user->avatar ? 'storage/'. $tutorApply->user->avatar : ($tutorApply->user->gender == 1 ? 'img/tutors/avatars/default-boy.png':'img/tutors/avatars/default-girl.png' ))}}" alt="User Image">
                                                                </a>
                                                                <a href="{{route('tutor-profile',$tutorApply->id)}}">{{$tutorApply->user->name}} <span>Sinh vien</span></a>
                                                            </h2>
                                                        </td>
                                                        <td>
                                                            {{$request->short_description}}
                                                        </td>
                                                        @if($request->status == 3 && $tutorApply->pivot->status == 3)
                                                            <td><span class="badge badge-pill bg-primary-light">Đã nhận dạy</span></td>
                                                        @endif
                                                        @if($tutorApply->pivot->status == 2)
                                                            <td><span class="badge badge-pill bg-danger-light">Đã từ chối</span></td>
                                                        @endif
                                                        @if($request->status !== 1 && $tutorApply->pivot->status == 0)
                                                            <td><span class="badge badge-pill bg-primary-light">Đang đợi xác nhận</span></td>
                                                        @endif
                                                        <td class="text-right">
                                                            <div class="table-action">
                                                                <a href="#" class="btn btn-sm bg-success-light btn-accept">
                                                                    <i class="fas fa-check"></i> Chấp nhận
                                                                </a>
                                                                <a href="#" class="btn btn-sm bg-danger-light btn-decline">
                                                                    <i class="fas fa-times"></i> Hủy
                                                                </a>
                                                            </div>
                                                        </td>
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
                    <!-- Appointment Tab -->
                    <div id="pat_appointments_next" class="tab-pane fade show">
                        <div class="message-box"></div>
                        <div class="card card-table mb-0">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-center mb-0">
                                        <thead>
                                        <tr>
                                            <th>Gia sư</th>
                                            <th>Nhận lớp</th>
                                            <th>Status</th>
                                            <th class="text-right">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($student->requests as $request)
                                            @foreach($request->tutors as $key => $tutorApply)
                                                @if($tutorApply->pivot->sender == 0 )
                                                    <tr class="request-cont" id="request-{{$key}}"  data-tutor="{{$tutorApply->id}}" data-request="{{ $request->id }}">
                                                        <td>
                                                            <h2 class="table-avatar">
                                                                <a href="{{route('tutor-profile',$tutorApply->id)}}" class="avatar avatar-sm mr-2">
                                                                    <img class="avatar-img rounded-circle" src="{{asset($tutorApply->user->avatar ? 'storage/'. $tutorApply->user->avatar : ($tutorApply->user->gender == 1 ? 'img/tutors/avatars/default-boy.png':'img/tutors/avatars/default-girl.png' ))}}" alt="User Image">
                                                                </a>
                                                                <a href="{{route('tutor-profile',$tutorApply->id)}}">{{$tutorApply->user->name}} <span>Sinh vien</span></a>
                                                            </h2>
                                                        </td>
                                                        <td>
                                                            {{$request->short_description}}
                                                        </td>
                                                        @if($request->status == 3 && $tutorApply->pivot->status == 3)
                                                            <td><span class="badge badge-pill bg-primary-light">Đã nhận dạy</span></td>
                                                        @endif
                                                        @if($tutorApply->pivot->status == 2)
                                                            <td><span class="badge badge-pill bg-danger-light">Đã từ chối</span></td>
                                                        @endif
                                                        @if($request->status !== 1 && $tutorApply->pivot->status == 0)
                                                            <td><span class="badge badge-pill bg-primary-light">Đang đợi xác nhận</span></td>
                                                        @endif
                                                        <td class="text-right">
                                                            <div class="table-action">
                                                                <a href="#" class="btn btn-sm bg-success-light btn-accept">
                                                                    <i class="fas fa-check"></i> Chấp nhận
                                                                </a>
                                                                <a href="#" class="btn btn-sm bg-danger-light btn-decline">
                                                                    <i class="fas fa-times"></i> Hủy
                                                                </a>
                                                            </div>
                                                        </td>
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


@endsection
