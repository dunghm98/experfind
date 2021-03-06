@extends('tutor.dashboard')

@section('bottom.js')
    <script src="{{asset('js/tutor/mainDashboard.js')}}"></script>
    @endsection
@section('dashboard-content')
<div class="col-md-7 col-lg-8 col-xl-9">

    <div class="row">
        <div class="col-md-12">
            <div class="card dash-card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 col-lg-4">
                            <div class="dash-widget dct-border-rht">
                                <div class="circle-bar circle-bar1">
                                    <div class="circle-graph1" data-percent="75">
                                        <img src="{{asset('img/icons/students.png')}}" class="icon-dashboard img-fluid" alt="patient">
                                    </div>
                                </div>
                                <div class="dash-widget-info">
                                    <h6>Tổng số học sinh</h6>
                                    <h3>1500</h3>
                                    <p class="text-muted">Tính đến hiện tại</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-lg-4">
                            <div class="dash-widget dct-border-rht">
                                <div class="circle-bar circle-bar2">
                                    <div class="circle-graph2" data-percent="65">
                                        <img src="{{asset('img/icons/today.png')}}" class="icon-dashboard img-fluid" alt="Patient">
                                    </div>
                                </div>
                                <div class="dash-widget-info">
                                    <h6>Học sinh hôm nay</h6>
                                    <h3>16</h3>
                                    <p class="text-muted">06, Nov 2019</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-lg-4">
                            <div class="dash-widget">
                                <div class="circle-bar circle-bar3">
                                    <div class="circle-graph3" data-percent="50">
                                        <img src="{{asset('img/icons/appointment.png')}}" class="icon-dashboard img-fluid" alt="Patient">
                                    </div>
                                </div>
                                <div class="dash-widget-info">
                                    <h6>Lịch hẹn</h6>
                                    <h3>85</h3>
                                    <p class="text-muted">06, Apr 2019</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h4 class="mb-4">Học sinh đang mời dạy</h4>
            <div class="message-box"></div>
            <div class="appointment-tab">

                <!-- Appointment Tab -->
                <ul class="nav nav-tabs nav-tabs-solid nav-tabs-rounded">
                    <li class="nav-item">
                        <a class="nav-link active" href="#upcoming-appointments" data-toggle="tab">Được mời dạy</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#today-appointments" data-toggle="tab">Lớp nhận dạy</a>
                    </li>
                </ul>
                <!-- /Appointment Tab -->

                <div class="tab-content">

                    <!-- Upcoming Appointment Tab -->
                    <div class="tab-pane show active" id="upcoming-appointments">
                        <div class="card card-table mb-0">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-center mb-0">
                                        <thead>
                                        <tr>
                                            <th>Tên học sinh</th>
                                            <th>Ngày book</th>
                                            <th>Môn</th>
                                            <th>Phân loại</th>
                                            <th class="text-center">Học phí chi trả</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($tutor->requests as $key => $studentRequest)
                                            @if($studentRequest->pivot->sender == 0 && $studentRequest->pivot->status !== 2)
                                                <tr class="request-cont" id="request-{{$key}}"  data-tutor="{{$tutor->id}}" data-request="{{ $studentRequest->id }}">
                                                    <td>
                                                        <h2 class="table-avatar">
                                                            <a href="{{route('students.viewProfile', $studentRequest->student->id)}}" class="avatar avatar-sm mr-2">
                                                                <img class="avatar-img rounded-circle" src="{{asset($studentRequest->student->user->avatar ? 'storage/'. $studentRequest->student->user->avatar : ($studentRequest->student->user->gender == 1 ? 'img/tutors/avatars/default-boy.png':'img/tutors/avatars/default-girl.png' ))}}" alt="User Image">
                                                            </a>
                                                            <a href="{{route('students.viewProfile', $studentRequest->student->id)}}">{{$studentRequest->student->user->name}}<span>#ST0016</span></a>
                                                        </h2>
                                                    </td>
                                                    <td>{{date('d/m/Y', strtotime($studentRequest->created_at))}}</td>
                                                    <td>{{$studentRequest->subject->name}}</td>
                                                    <td>Học sinh mới</td>
                                                    <td class="text-center">{{$studentRequest->expect_fee}} VND</td>
                                                    <td class="text-right">
                                                        <div class="table-action">
                                                            <a href="{{route('request.detail', $studentRequest->id)}}" class="btn btn-sm bg-info-light">
                                                                <i class="far fa-eye"></i> Xem
                                                            </a>

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
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Upcoming Appointment Tab -->

                    <!-- Today Appointment Tab -->
                    <div class="tab-pane" id="today-appointments">
                        <div class="card card-table mb-0">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-center mb-0">
                                        <thead>
                                        <tr>
                                            <th>Tên học sinh</th>
                                            <th>Ngày book</th>
                                            <th>Môn</th>
                                            <th>Phân loại</th>
                                            <th class="text-center">Học phí chi trả</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($tutor->requests as $key => $studentRequest)
                                            @if($studentRequest->pivot->sender == 1 && $studentRequest->pivot->status !== 2)
                                                <tr class="request-cont" id="request-{{$key}}"  data-tutor="{{$tutor->id}}" data-request="{{ $studentRequest->id }}">
                                                    <td>
                                                        <h2 class="table-avatar">
                                                            <a href="{{route('students.viewProfile', $studentRequest->student->id)}}" class="avatar avatar-sm mr-2">
                                                                <img class="avatar-img rounded-circle" src="{{asset($studentRequest->student->user->avatar ? 'storage/'. $studentRequest->student->user->avatar : ($studentRequest->student->user->gender == 1 ? 'img/tutors/avatars/default-boy.png':'img/tutors/avatars/default-girl.png' ))}}" alt="User Image">
                                                            </a>
                                                            <a href="{{route('students.viewProfile', $studentRequest->student->id)}}">{{$studentRequest->student->user->name}}<span>#ST0016</span></a>
                                                        </h2>
                                                    </td>
                                                    <td>{{date('d/m/Y', strtotime($studentRequest->created_at))}}</td>
                                                    <td>{{$studentRequest->subject->name}}</td>
                                                    <td>Học sinh mới</td>
                                                    <td class="text-center">{{$studentRequest->expect_fee}} VND</td>
                                                    <td class="text-right">
                                                        <div class="table-action">
                                                            <a href="{{route('request.detail', $studentRequest->id)}}" class="btn btn-sm bg-info-light">
                                                                <i class="far fa-eye"></i> Xem
                                                            </a>
                                                            <a href="#" class="btn btn-sm bg-danger-light btn-decline">
                                                                <i class="fas fa-times"></i> Hủy
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Today Appointment Tab -->

                </div>
            </div>
        </div>
    </div>

</div>
@endsection
