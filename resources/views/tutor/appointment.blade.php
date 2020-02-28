@extends('tutor.dashboard')

@section('bottom.js')
    <script src="{{asset('js/tutor/mainDashboard.js')}}"></script>
@endsection

@section('dashboard-content')

    <div class="col-md-7 col-lg-8 col-xl-9">
        <div class="appointments">
            <div class="message-box"></div>
        @foreach($tutor->requests as $key => $studentRequest)
            @if($studentRequest->pivot->sender == 0 )
            <!-- Appointment List -->
            <div class="appointment-list request-cont" id="request-{{$key}}"  data-tutor="{{$tutor->id}}" data-request="{{ $studentRequest->id }}">
                <div class="profile-info-widget">
                    <a href="{{route('students.viewProfile', $studentRequest->student->id)}}" class="booking-doc-img">
                        <img class="" src="{{asset($studentRequest->student->user->avatar ? 'storage/'. $studentRequest->student->user->avatar : ($studentRequest->student->user->gender == 1 ? 'img/tutors/avatars/default-boy.png':'img/tutors/avatars/default-girl.png' ))}}" alt="User Image">
                    </a>
                    <div class="profile-det-info">
                        <h3><a href="{{route('students.viewProfile', $studentRequest->student->id)}}">{{$studentRequest->student->user->name}}</a></h3>
                        <div class="patient-details mr-1">
                            <h5><i class="far fa-clock"></i>Ngày sinh: {{date('d/m/Y', strtotime($studentRequest->created_at))}}</h5>
                            <h5><i class="fas fa-map-marker-alt"></i>Địa chỉ: {{$studentRequest->student->user->city->name ?? ''}}</h5>
                        </div>
                    </div>
                    <div class="profile-det-info ml-3 border-left pl-3 request-detail-cont">
                        <h3><a href="{{route('students.viewProfile', $studentRequest->id)}}">{{$studentRequest->short_description }}</a></h3>
                        <div class="patient-details">
                            <h5 class="mb-3 mt-2"><i class="far fa-comment-alt"></i><p class="d-inline-block">Nội dung: {{ $studentRequest->description}}</p></h5>
                            <h5><i class="fas fa-map-marker-alt"></i>Vị trí: {{$studentRequest->city->name ?? ''}}</h5>
                            <h5><i class="fas fa-book"></i>Môn học: {{$studentRequest->subject->name}}</h5>
                            <h5 class=""><i class="fas fa-money-check-alt"></i>Học phí: {{$studentRequest->expect_fee}} VND</h5>
                        </div>
                        @if($studentRequest->pivot->status == 2 )
                            <button class="btn btn-sm bg-warning-light cursor-default">
                                <i class="fas fa-times"></i> Bạn đã hủy yêu cầu này rồi
                            </button>
                        @endif
                        @if($studentRequest->pivot->status == 3 )
                            <button class="btn btn-sm bg-success-light cursor-default">
                                <i class="fas fa-check"></i> Bạn đã xác nhận yêu cầu này rồi
                            </button>
                        @endif
                    </div>
                </div>
                <div></div>
                <div class="appointment-action w-100">
                    <a href="{{route('request.detail', $studentRequest->id)}}" class="btn btn-sm bg-info-light">
                        <i class="far fa-eye"></i> View
                    </a>
                    @if($studentRequest->pivot->status == 2 )
                        <a href="#" class="btn btn-sm bg-danger-light btn-delete">
                            <i class="fas fa-times"></i> Xóa
                        </a>
                    @endif
                    @if($studentRequest->pivot->status == 3 )
                        <a href="#" class="btn btn-sm bg-danger-light btn-delete">
                            <i class="fas fa-times"></i> Xóa
                        </a>
                    @endif
                    @if($studentRequest->pivot->status == 0 )
                        <a href="#" class="btn btn-sm bg-primary-light btn-accept">
                            <i class="fas fa-check"></i> Chấp nhận
                        </a>
                        <a href="#" class="btn btn-sm bg-danger-light btn-decline">
                            <i class="fas fa-times"></i> Hủy
                        </a>
                    @endif

                </div>
            </div>
            <!-- /Appointment List -->
            @endif
        @endforeach

        </div>
    </div>
@endsection
