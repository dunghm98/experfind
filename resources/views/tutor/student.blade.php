@extends('tutor.dashboard')
@section('dashboard-content')

    <div class="col-md-7 col-lg-8 col-xl-9">

        <div class="row row-grid">
            @foreach($tutor->getStudentRequest() as $studentRequest)
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <div class="card widget-profile pat-widget-profile">
                        <div class="card-body">
                            <div class="pro-widget-content">
                                <div class="profile-info-widget">
                                    <a href="{{route('students.viewProfile',$studentRequest->student->id)}}" class="booking-doc-img">
                                        <img src="{{asset($studentRequest->student->user->avatar ? 'storage/'. $studentRequest->student->user->avatar : ($studentRequest->student->user->gender == 1 ? 'img/tutors/avatars/default-boy.png':'img/tutors/avatars/default-girl.png' ))}}" alt="User Image">
                                    </a>
                                    <div class="profile-det-info">
                                        <h3><a href="{{route('students.viewProfile',$studentRequest->student->id)}}">{{$studentRequest->student->user->name}}</a></h3>

                                        <div class="patient-details">
                                            <h5><b>Student ID :</b> ST{{$studentRequest->student->id}}</h5>
                                            <h5 class="mb-0"><i class="fas fa-map-marker-alt"></i>{{$studentRequest->student->user->district->name ?? ''}}, {{$studentRequest->student->user->city->name ?? ''}}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="patient-info">
                                <ul>
                                    <li>Điện thoại <span>{{$student->user->phone ?? ''}}</span></li>
                                    <li>Tuổi <span>{{$studentRequest->student->user->getAge()}} tuổi</span></li>
                                    <li>Giới tính <span>{{$studentRequest->student->user->gender == 1 ? 'Nam' : 'Nữ'}}</span></li>
                                    <li>Môn học <span>{{$studentRequest->subject->name}}</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>

    </div>
@endsection
