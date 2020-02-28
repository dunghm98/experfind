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

                    <!-- Prescription Tab -->
                    <div class="tab-pane fade" id="pat_prescriptions">
                        <div class="card card-table mb-0">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-center mb-0">
                                        <thead>
                                        <tr>
                                            <th>Date </th>
                                            <th>Name</th>
                                            <th>Created by </th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>14 Nov 2019</td>
                                            <td>Prescription 1</td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    <a href="doctor-profile.html" class="avatar avatar-sm mr-2">
                                                        <img class="avatar-img rounded-circle" src="assets/img/doctors/doctor-thumb-01.jpg" alt="User Image">
                                                    </a>
                                                    <a href="doctor-profile.html">Dr. Ruby Perrin <span>Dental</span></a>
                                                </h2>
                                            </td>
                                            <td class="text-right">
                                                <div class="table-action">
                                                    <a href="javascript:void(0);" class="btn btn-sm bg-primary-light">
                                                        <i class="fas fa-print"></i> Print
                                                    </a>
                                                    <a href="javascript:void(0);" class="btn btn-sm bg-info-light">
                                                        <i class="far fa-eye"></i> View
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>13 Nov 2019</td>
                                            <td>Prescription 2</td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    <a href="doctor-profile.html" class="avatar avatar-sm mr-2">
                                                        <img class="avatar-img rounded-circle" src="assets/img/doctors/doctor-thumb-02.jpg" alt="User Image">
                                                    </a>
                                                    <a href="doctor-profile.html">Dr. Darren Elder <span>Dental</span></a>
                                                </h2>
                                            </td>
                                            <td class="text-right">
                                                <div class="table-action">
                                                    <a href="javascript:void(0);" class="btn btn-sm bg-primary-light">
                                                        <i class="fas fa-print"></i> Print
                                                    </a>
                                                    <a href="javascript:void(0);" class="btn btn-sm bg-info-light">
                                                        <i class="far fa-eye"></i> View
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>12 Nov 2019</td>
                                            <td>Prescription 3</td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    <a href="doctor-profile.html" class="avatar avatar-sm mr-2">
                                                        <img class="avatar-img rounded-circle" src="assets/img/doctors/doctor-thumb-03.jpg" alt="User Image">
                                                    </a>
                                                    <a href="doctor-profile.html">Dr. Deborah Angel <span>Cardiology</span></a>
                                                </h2>
                                            </td>
                                            <td class="text-right">
                                                <div class="table-action">
                                                    <a href="javascript:void(0);" class="btn btn-sm bg-primary-light">
                                                        <i class="fas fa-print"></i> Print
                                                    </a>
                                                    <a href="javascript:void(0);" class="btn btn-sm bg-info-light">
                                                        <i class="far fa-eye"></i> View
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>11 Nov 2019</td>
                                            <td>Prescription 4</td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    <a href="doctor-profile.html" class="avatar avatar-sm mr-2">
                                                        <img class="avatar-img rounded-circle" src="assets/img/doctors/doctor-thumb-04.jpg" alt="User Image">
                                                    </a>
                                                    <a href="doctor-profile.html">Dr. Sofia Brient <span>Urology</span></a>
                                                </h2>
                                            </td>
                                            <td class="text-right">
                                                <div class="table-action">
                                                    <a href="javascript:void(0);" class="btn btn-sm bg-primary-light">
                                                        <i class="fas fa-print"></i> Print
                                                    </a>
                                                    <a href="javascript:void(0);" class="btn btn-sm bg-info-light">
                                                        <i class="far fa-eye"></i> View
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>10 Nov 2019</td>
                                            <td>Prescription 5</td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    <a href="doctor-profile.html" class="avatar avatar-sm mr-2">
                                                        <img class="avatar-img rounded-circle" src="assets/img/doctors/doctor-thumb-05.jpg" alt="User Image">
                                                    </a>
                                                    <a href="doctor-profile.html">Dr. Marvin Campbell <span>Dental</span></a>
                                                </h2>
                                            </td>
                                            <td class="text-right">
                                                <div class="table-action">
                                                    <a href="javascript:void(0);" class="btn btn-sm bg-primary-light">
                                                        <i class="fas fa-print"></i> Print
                                                    </a>
                                                    <a href="javascript:void(0);" class="btn btn-sm bg-info-light">
                                                        <i class="far fa-eye"></i> View
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>9 Nov 2019</td>
                                            <td>Prescription 6</td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    <a href="doctor-profile.html" class="avatar avatar-sm mr-2">
                                                        <img class="avatar-img rounded-circle" src="assets/img/doctors/doctor-thumb-06.jpg" alt="User Image">
                                                    </a>
                                                    <a href="doctor-profile.html">Dr. Katharine Berthold <span>Orthopaedics</span></a>
                                                </h2>
                                            </td>
                                            <td class="text-right">
                                                <div class="table-action">
                                                    <a href="javascript:void(0);" class="btn btn-sm bg-primary-light">
                                                        <i class="fas fa-print"></i> Print
                                                    </a>
                                                    <a href="javascript:void(0);" class="btn btn-sm bg-info-light">
                                                        <i class="far fa-eye"></i> View
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>8 Nov 2019</td>
                                            <td>Prescription 7</td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    <a href="doctor-profile.html" class="avatar avatar-sm mr-2">
                                                        <img class="avatar-img rounded-circle" src="assets/img/doctors/doctor-thumb-07.jpg" alt="User Image">
                                                    </a>
                                                    <a href="doctor-profile.html">Dr. Linda Tobin <span>Neurology</span></a>
                                                </h2>
                                            </td>
                                            <td class="text-right">
                                                <div class="table-action">
                                                    <a href="javascript:void(0);" class="btn btn-sm bg-primary-light">
                                                        <i class="fas fa-print"></i> Print
                                                    </a>
                                                    <a href="javascript:void(0);" class="btn btn-sm bg-info-light">
                                                        <i class="far fa-eye"></i> View
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>7 Nov 2019</td>
                                            <td>Prescription 8</td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    <a href="doctor-profile.html" class="avatar avatar-sm mr-2">
                                                        <img class="avatar-img rounded-circle" src="assets/img/doctors/doctor-thumb-08.jpg" alt="User Image">
                                                    </a>
                                                    <a href="doctor-profile.html">Dr. Paul Richard <span>Dermatology</span></a>
                                                </h2>
                                            </td>
                                            <td class="text-right">
                                                <div class="table-action">
                                                    <a href="javascript:void(0);" class="btn btn-sm bg-primary-light">
                                                        <i class="fas fa-print"></i> Print
                                                    </a>
                                                    <a href="javascript:void(0);" class="btn btn-sm bg-info-light">
                                                        <i class="far fa-eye"></i> View
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>6 Nov 2019</td>
                                            <td>Prescription 9</td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    <a href="doctor-profile.html" class="avatar avatar-sm mr-2">
                                                        <img class="avatar-img rounded-circle" src="assets/img/doctors/doctor-thumb-09.jpg" alt="User Image">
                                                    </a>
                                                    <a href="doctor-profile.html">Dr. John Gibbs <span>Dental</span></a>
                                                </h2>
                                            </td>
                                            <td class="text-right">
                                                <div class="table-action">
                                                    <a href="javascript:void(0);" class="btn btn-sm bg-primary-light">
                                                        <i class="fas fa-print"></i> Print
                                                    </a>
                                                    <a href="javascript:void(0);" class="btn btn-sm bg-info-light">
                                                        <i class="far fa-eye"></i> View
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>5 Nov 2019</td>
                                            <td>Prescription 10</td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    <a href="doctor-profile.html" class="avatar avatar-sm mr-2">
                                                        <img class="avatar-img rounded-circle" src="assets/img/doctors/doctor-thumb-10.jpg" alt="User Image">
                                                    </a>
                                                    <a href="doctor-profile.html">Dr. Olga Barlow <span>Dental</span></a>
                                                </h2>
                                            </td>
                                            <td class="text-right">
                                                <div class="table-action">
                                                    <a href="javascript:void(0);" class="btn btn-sm bg-primary-light">
                                                        <i class="fas fa-print"></i> Print
                                                    </a>
                                                    <a href="javascript:void(0);" class="btn btn-sm bg-info-light">
                                                        <i class="far fa-eye"></i> View
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Prescription Tab -->

                    <!-- Medical Records Tab -->
                    <div id="pat_medical_records" class="tab-pane fade">
                        <div class="card card-table mb-0">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-center mb-0">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Date </th>
                                            <th>Description</th>
                                            <th>Attachment</th>
                                            <th>Created</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td><a href="javascript:void(0);">#MR-0010</a></td>
                                            <td>14 Nov 2019</td>
                                            <td>Dental Filling</td>
                                            <td><a href="#">dental-test.pdf</a></td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    <a href="doctor-profile.html" class="avatar avatar-sm mr-2">
                                                        <img class="avatar-img rounded-circle" src="assets/img/doctors/doctor-thumb-01.jpg" alt="User Image">
                                                    </a>
                                                    <a href="doctor-profile.html">Dr. Ruby Perrin <span>Dental</span></a>
                                                </h2>
                                            </td>
                                            <td class="text-right">
                                                <div class="table-action">
                                                    <a href="javascript:void(0);" class="btn btn-sm bg-info-light">
                                                        <i class="far fa-eye"></i> View
                                                    </a>
                                                    <a href="javascript:void(0);" class="btn btn-sm bg-primary-light">
                                                        <i class="fas fa-print"></i> Print
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><a href="javascript:void(0);">#MR-0009</a></td>
                                            <td>13 Nov 2019</td>
                                            <td>Teeth Cleaning</td>
                                            <td><a href="#">dental-test.pdf</a></td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    <a href="doctor-profile.html" class="avatar avatar-sm mr-2">
                                                        <img class="avatar-img rounded-circle" src="assets/img/doctors/doctor-thumb-02.jpg" alt="User Image">
                                                    </a>
                                                    <a href="doctor-profile.html">Dr. Darren Elder <span>Dental</span></a>
                                                </h2>
                                            </td>
                                            <td class="text-right">
                                                <div class="table-action">
                                                    <a href="javascript:void(0);" class="btn btn-sm bg-info-light">
                                                        <i class="far fa-eye"></i> View
                                                    </a>
                                                    <a href="javascript:void(0);" class="btn btn-sm bg-primary-light">
                                                        <i class="fas fa-print"></i> Print
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><a href="javascript:void(0);">#MR-0008</a></td>
                                            <td>12 Nov 2019</td>
                                            <td>General Checkup</td>
                                            <td><a href="#">cardio-test.pdf</a></td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    <a href="doctor-profile.html" class="avatar avatar-sm mr-2">
                                                        <img class="avatar-img rounded-circle" src="assets/img/doctors/doctor-thumb-03.jpg" alt="User Image">
                                                    </a>
                                                    <a href="doctor-profile.html">Dr. Deborah Angel <span>Cardiology</span></a>
                                                </h2>
                                            </td>
                                            <td class="text-right">
                                                <div class="table-action">
                                                    <a href="javascript:void(0);" class="btn btn-sm bg-info-light">
                                                        <i class="far fa-eye"></i> View
                                                    </a>
                                                    <a href="javascript:void(0);" class="btn btn-sm bg-primary-light">
                                                        <i class="fas fa-print"></i> Print
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><a href="javascript:void(0);">#MR-0007</a></td>
                                            <td>11 Nov 2019</td>
                                            <td>General Test</td>
                                            <td><a href="#">general-test.pdf</a></td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    <a href="doctor-profile.html" class="avatar avatar-sm mr-2">
                                                        <img class="avatar-img rounded-circle" src="assets/img/doctors/doctor-thumb-04.jpg" alt="User Image">
                                                    </a>
                                                    <a href="doctor-profile.html">Dr. Sofia Brient <span>Urology</span></a>
                                                </h2>
                                            </td>
                                            <td class="text-right">
                                                <div class="table-action">
                                                    <a href="javascript:void(0);" class="btn btn-sm bg-info-light">
                                                        <i class="far fa-eye"></i> View
                                                    </a>
                                                    <a href="javascript:void(0);" class="btn btn-sm bg-primary-light">
                                                        <i class="fas fa-print"></i> Print
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><a href="javascript:void(0);">#MR-0006</a></td>
                                            <td>10 Nov 2019</td>
                                            <td>Eye Test</td>
                                            <td><a href="#">eye-test.pdf</a></td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    <a href="doctor-profile.html" class="avatar avatar-sm mr-2">
                                                        <img class="avatar-img rounded-circle" src="assets/img/doctors/doctor-thumb-05.jpg" alt="User Image">
                                                    </a>
                                                    <a href="doctor-profile.html">Dr. Marvin Campbell <span>Ophthalmology</span></a>
                                                </h2>
                                            </td>
                                            <td class="text-right">
                                                <div class="table-action">
                                                    <a href="javascript:void(0);" class="btn btn-sm bg-info-light">
                                                        <i class="far fa-eye"></i> View
                                                    </a>
                                                    <a href="javascript:void(0);" class="btn btn-sm bg-primary-light">
                                                        <i class="fas fa-print"></i> Print
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><a href="javascript:void(0);">#MR-0005</a></td>
                                            <td>9 Nov 2019</td>
                                            <td>Leg Pain</td>
                                            <td><a href="#">ortho-test.pdf</a></td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    <a href="doctor-profile.html" class="avatar avatar-sm mr-2">
                                                        <img class="avatar-img rounded-circle" src="assets/img/doctors/doctor-thumb-06.jpg" alt="User Image">
                                                    </a>
                                                    <a href="doctor-profile.html">Dr. Katharine Berthold <span>Orthopaedics</span></a>
                                                </h2>
                                            </td>
                                            <td class="text-right">
                                                <div class="table-action">
                                                    <a href="javascript:void(0);" class="btn btn-sm bg-info-light">
                                                        <i class="far fa-eye"></i> View
                                                    </a>
                                                    <a href="javascript:void(0);" class="btn btn-sm bg-primary-light">
                                                        <i class="fas fa-print"></i> Print
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><a href="javascript:void(0);">#MR-0004</a></td>
                                            <td>8 Nov 2019</td>
                                            <td>Head pain</td>
                                            <td><a href="#">neuro-test.pdf</a></td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    <a href="doctor-profile.html" class="avatar avatar-sm mr-2">
                                                        <img class="avatar-img rounded-circle" src="assets/img/doctors/doctor-thumb-07.jpg" alt="User Image">
                                                    </a>
                                                    <a href="doctor-profile.html">Dr. Linda Tobin <span>Neurology</span></a>
                                                </h2>
                                            </td>
                                            <td class="text-right">
                                                <div class="table-action">
                                                    <a href="javascript:void(0);" class="btn btn-sm bg-info-light">
                                                        <i class="far fa-eye"></i> View
                                                    </a>
                                                    <a href="javascript:void(0);" class="btn btn-sm bg-primary-light">
                                                        <i class="fas fa-print"></i> Print
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><a href="javascript:void(0);">#MR-0003</a></td>
                                            <td>7 Nov 2019</td>
                                            <td>Skin Alergy</td>
                                            <td><a href="#">alergy-test.pdf</a></td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    <a href="doctor-profile.html" class="avatar avatar-sm mr-2">
                                                        <img class="avatar-img rounded-circle" src="assets/img/doctors/doctor-thumb-08.jpg" alt="User Image">
                                                    </a>
                                                    <a href="doctor-profile.html">Dr. Paul Richard <span>Dermatology</span></a>
                                                </h2>
                                            </td>
                                            <td class="text-right">
                                                <div class="table-action">
                                                    <a href="javascript:void(0);" class="btn btn-sm bg-info-light">
                                                        <i class="far fa-eye"></i> View
                                                    </a>
                                                    <a href="javascript:void(0);" class="btn btn-sm bg-primary-light">
                                                        <i class="fas fa-print"></i> Print
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><a href="javascript:void(0);">#MR-0002</a></td>
                                            <td>6 Nov 2019</td>
                                            <td>Dental Removing</td>
                                            <td><a href="#">dental-test.pdf</a></td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    <a href="doctor-profile.html" class="avatar avatar-sm mr-2">
                                                        <img class="avatar-img rounded-circle" src="assets/img/doctors/doctor-thumb-09.jpg" alt="User Image">
                                                    </a>
                                                    <a href="doctor-profile.html">Dr. John Gibbs <span>Dental</span></a>
                                                </h2>
                                            </td>
                                            <td class="text-right">
                                                <div class="table-action">
                                                    <a href="javascript:void(0);" class="btn btn-sm bg-info-light">
                                                        <i class="far fa-eye"></i> View
                                                    </a>
                                                    <a href="javascript:void(0);" class="btn btn-sm bg-primary-light">
                                                        <i class="fas fa-print"></i> Print
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><a href="javascript:void(0);">#MR-0001</a></td>
                                            <td>5 Nov 2019</td>
                                            <td>Dental Filling</td>
                                            <td><a href="#">dental-test.pdf</a></td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    <a href="doctor-profile.html" class="avatar avatar-sm mr-2">
                                                        <img class="avatar-img rounded-circle" src="assets/img/doctors/doctor-thumb-10.jpg" alt="User Image">
                                                    </a>
                                                    <a href="doctor-profile.html">Dr. Olga Barlow <span>Dental</span></a>
                                                </h2>
                                            </td>
                                            <td class="text-right">
                                                <div class="table-action">
                                                    <a href="javascript:void(0);" class="btn btn-sm bg-info-light">
                                                        <i class="far fa-eye"></i> View
                                                    </a>
                                                    <a href="javascript:void(0);" class="btn btn-sm bg-primary-light">
                                                        <i class="fas fa-print"></i> Print
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Medical Records Tab -->

                    <!-- Billing Tab -->
                    <div id="pat_billing" class="tab-pane fade">
                        <div class="card card-table mb-0">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-center mb-0">
                                        <thead>
                                        <tr>
                                            <th>Invoice No</th>
                                            <th>Doctor</th>
                                            <th>Amount</th>
                                            <th>Paid On</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>
                                                <a href="invoice-view.html">#INV-0010</a>
                                            </td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    <a href="doctor-profile.html" class="avatar avatar-sm mr-2">
                                                        <img class="avatar-img rounded-circle" src="assets/img/doctors/doctor-thumb-01.jpg" alt="User Image">
                                                    </a>
                                                    <a href="doctor-profile.html">Ruby Perrin <span>Dental</span></a>
                                                </h2>
                                            </td>
                                            <td>$450</td>
                                            <td>14 Nov 2019</td>
                                            <td class="text-right">
                                                <div class="table-action">
                                                    <a href="invoice-view.html" class="btn btn-sm bg-info-light">
                                                        <i class="far fa-eye"></i> View
                                                    </a>
                                                    <a href="javascript:void(0);" class="btn btn-sm bg-primary-light">
                                                        <i class="fas fa-print"></i> Print
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="invoice-view.html">#INV-0009</a>
                                            </td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    <a href="doctor-profile.html" class="avatar avatar-sm mr-2">
                                                        <img class="avatar-img rounded-circle" src="assets/img/doctors/doctor-thumb-02.jpg" alt="User Image">
                                                    </a>
                                                    <a href="doctor-profile.html">Dr. Darren Elder <span>Dental</span></a>
                                                </h2>
                                            </td>
                                            <td>$300</td>
                                            <td>13 Nov 2019</td>
                                            <td class="text-right">
                                                <div class="table-action">
                                                    <a href="invoice-view.html" class="btn btn-sm bg-info-light">
                                                        <i class="far fa-eye"></i> View
                                                    </a>
                                                    <a href="javascript:void(0);" class="btn btn-sm bg-primary-light">
                                                        <i class="fas fa-print"></i> Print
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="invoice-view.html">#INV-0008</a>
                                            </td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    <a href="doctor-profile.html" class="avatar avatar-sm mr-2">
                                                        <img class="avatar-img rounded-circle" src="assets/img/doctors/doctor-thumb-03.jpg" alt="User Image">
                                                    </a>
                                                    <a href="doctor-profile.html">Dr. Deborah Angel <span>Cardiology</span></a>
                                                </h2>
                                            </td>
                                            <td>$150</td>
                                            <td>12 Nov 2019</td>
                                            <td class="text-right">
                                                <div class="table-action">
                                                    <a href="invoice-view.html" class="btn btn-sm bg-info-light">
                                                        <i class="far fa-eye"></i> View
                                                    </a>
                                                    <a href="javascript:void(0);" class="btn btn-sm bg-primary-light">
                                                        <i class="fas fa-print"></i> Print
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="invoice-view.html">#INV-0007</a>
                                            </td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    <a href="doctor-profile.html" class="avatar avatar-sm mr-2">
                                                        <img class="avatar-img rounded-circle" src="assets/img/doctors/doctor-thumb-04.jpg" alt="User Image">
                                                    </a>
                                                    <a href="doctor-profile.html">Dr. Sofia Brient <span>Urology</span></a>
                                                </h2>
                                            </td>
                                            <td>$50</td>
                                            <td>11 Nov 2019</td>
                                            <td class="text-right">
                                                <div class="table-action">
                                                    <a href="invoice-view.html" class="btn btn-sm bg-info-light">
                                                        <i class="far fa-eye"></i> View
                                                    </a>
                                                    <a href="javascript:void(0);" class="btn btn-sm bg-primary-light">
                                                        <i class="fas fa-print"></i> Print
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="invoice-view.html">#INV-0006</a>
                                            </td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    <a href="doctor-profile.html" class="avatar avatar-sm mr-2">
                                                        <img class="avatar-img rounded-circle" src="assets/img/doctors/doctor-thumb-05.jpg" alt="User Image">
                                                    </a>
                                                    <a href="doctor-profile.html">Dr. Marvin Campbell <span>Ophthalmology</span></a>
                                                </h2>
                                            </td>
                                            <td>$600</td>
                                            <td>10 Nov 2019</td>
                                            <td class="text-right">
                                                <div class="table-action">
                                                    <a href="invoice-view.html" class="btn btn-sm bg-info-light">
                                                        <i class="far fa-eye"></i> View
                                                    </a>
                                                    <a href="javascript:void(0);" class="btn btn-sm bg-primary-light">
                                                        <i class="fas fa-print"></i> Print
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="invoice-view.html">#INV-0005</a>
                                            </td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    <a href="doctor-profile.html" class="avatar avatar-sm mr-2">
                                                        <img class="avatar-img rounded-circle" src="assets/img/doctors/doctor-thumb-06.jpg" alt="User Image">
                                                    </a>
                                                    <a href="doctor-profile.html">Dr. Katharine Berthold <span>Orthopaedics</span></a>
                                                </h2>
                                            </td>
                                            <td>$200</td>
                                            <td>9 Nov 2019</td>
                                            <td class="text-right">
                                                <div class="table-action">
                                                    <a href="invoice-view.html" class="btn btn-sm bg-info-light">
                                                        <i class="far fa-eye"></i> View
                                                    </a>
                                                    <a href="javascript:void(0);" class="btn btn-sm bg-primary-light">
                                                        <i class="fas fa-print"></i> Print
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="invoice-view.html">#INV-0004</a>
                                            </td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    <a href="doctor-profile.html" class="avatar avatar-sm mr-2">
                                                        <img class="avatar-img rounded-circle" src="assets/img/doctors/doctor-thumb-07.jpg" alt="User Image">
                                                    </a>
                                                    <a href="doctor-profile.html">Dr. Linda Tobin <span>Neurology</span></a>
                                                </h2>
                                            </td>
                                            <td>$100</td>
                                            <td>8 Nov 2019</td>
                                            <td class="text-right">
                                                <div class="table-action">
                                                    <a href="invoice-view.html" class="btn btn-sm bg-info-light">
                                                        <i class="far fa-eye"></i> View
                                                    </a>
                                                    <a href="javascript:void(0);" class="btn btn-sm bg-primary-light">
                                                        <i class="fas fa-print"></i> Print
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="invoice-view.html">#INV-0003</a>
                                            </td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    <a href="doctor-profile.html" class="avatar avatar-sm mr-2">
                                                        <img class="avatar-img rounded-circle" src="assets/img/doctors/doctor-thumb-08.jpg" alt="User Image">
                                                    </a>
                                                    <a href="doctor-profile.html">Dr. Paul Richard <span>Dermatology</span></a>
                                                </h2>
                                            </td>
                                            <td>$250</td>
                                            <td>7 Nov 2019</td>
                                            <td class="text-right">
                                                <div class="table-action">
                                                    <a href="invoice-view.html" class="btn btn-sm bg-info-light">
                                                        <i class="far fa-eye"></i> View
                                                    </a>
                                                    <a href="javascript:void(0);" class="btn btn-sm bg-primary-light">
                                                        <i class="fas fa-print"></i> Print
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="invoice-view.html">#INV-0002</a>
                                            </td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    <a href="doctor-profile.html" class="avatar avatar-sm mr-2">
                                                        <img class="avatar-img rounded-circle" src="assets/img/doctors/doctor-thumb-09.jpg" alt="User Image">
                                                    </a>
                                                    <a href="doctor-profile.html">Dr. John Gibbs <span>Dental</span></a>
                                                </h2>
                                            </td>
                                            <td>$175</td>
                                            <td>6 Nov 2019</td>
                                            <td class="text-right">
                                                <div class="table-action">
                                                    <a href="invoice-view.html" class="btn btn-sm bg-info-light">
                                                        <i class="far fa-eye"></i> View
                                                    </a>
                                                    <a href="javascript:void(0);" class="btn btn-sm bg-primary-light">
                                                        <i class="fas fa-print"></i> Print
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="invoice-view.html">#INV-0001</a>
                                            </td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    <a href="doctor-profile.html" class="avatar avatar-sm mr-2">
                                                        <img class="avatar-img rounded-circle" src="assets/img/doctors/doctor-thumb-10.jpg" alt="User Image">
                                                    </a>
                                                    <a href="doctor-profile.html">Dr. Olga Barlow <span>#0010</span></a>
                                                </h2>
                                            </td>
                                            <td>$550</td>
                                            <td>5 Nov 2019</td>
                                            <td class="text-right">
                                                <div class="table-action">
                                                    <a href="invoice-view.html" class="btn btn-sm bg-info-light">
                                                        <i class="far fa-eye"></i> View
                                                    </a>
                                                    <a href="javascript:void(0);" class="btn btn-sm bg-primary-light">
                                                        <i class="fas fa-print"></i> Print
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Billing Tab -->

                </div>
                <!-- Tab Content -->

            </div>
        </div>
    </div>


@endsection
