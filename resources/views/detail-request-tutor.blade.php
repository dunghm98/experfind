@extends('layouts.app')

@section('bottom.js')
    <script src="{{ asset('js/tutor/askForTeach.js') }}"></script>
@endsection

@section('content')
    <!-- Breadcrumb -->
    <div class="breadcrumb-bar">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-12 col-12">
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index-2.html">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Profile Settings</li>
                        </ol>
                    </nav>
                    <h2 class="breadcrumb-title">Đăng yêu cầu tìm gia s</h2>
                </div>
            </div>
        </div>
    </div>
    <!-- /Breadcrumb -->
    <!-- Page Content -->
    <div class="content">
        <div class="container">

            <!-- Doctor Widget -->
            <div id="message-box"></div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{$request->short_description}}</h4>
                </div>
                <div class="card-body">
                    <div class="title-student">
                        <a href="{{route('students.viewProfile',$request->student)}}" class="avatar avatar-sm mr-2">
                            <img id="preview-avatar"
                                 src="{{asset($request->student->user->avatar ? 'storage/'. $request->student->user->avatar : ($request->student->user->gender == 1 ? 'img/tutors/avatars/default-boy.png':'img/tutors/avatars/default-girl.png' ))}}" alt="User Avatar">
                        </a>
                        <a href="{{route('students.viewProfile',$request->student)}}">{{$request->student->user->name}}</a>
                        <i class="m-lg-2 fa fa-calendar"></i><span>Ngày đăng: </span><span>{{$request->created_at}}</span>
                        <i class="m-lg-2 fa fa-map-marker"></i><span>Địa chỉ: </span><span>{{$request->student->user->city->name ?? ''}}</span>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-10">
                            <!-- Services List -->
                            <div class="service-list">
                                <h4>Thông tin cơ bản</h4>
                                <ul class="clearfix">
                                    <li>
                                        <span>Trạng thái: </span>
                                        @if($request->status===0)
                                            <span class="badge badge-pill bg-info-light">Đang tìm</span>
                                        @endif
                                        @if($request->status===2)
                                            <span class="badge badge-pill bg-warning-light">Đấu giá</span>
                                        @endif
                                        @if($request->status===3)
                                            <span class="badge badge-pill bg-success-light">Đã tìm thấy</span>
                                        @endif
                                    </li>
                                    <li>
                                        <span>Môn học: </span><a href="">{{$request->subject->name}}</a>
                                    </li>
                                    <li>
                                        <span>Hình thức học: </span>
                                            @if($request->learning_method===1)
                                                <span class="badge badge-pill bg-info-light">Offline (Gia sư tại nhà)</span>
                                            @endif
                                            @if($request->learning_method===2)
                                                <span class="badge badge-pill bg-success-light">Học online</span>
                                            @endif
                                            @if($request->learning_method===3)
                                                    <span class="badge badge-pill bg-info-light">Offline (Gia sư tại nhà)</span>
                                                    <span class="badge badge-pill bg-success-light">Học online</span>
                                            @endif
                                    </li>
                                    <li>
                                        <span>Tìm gia sư: </span>
                                        @if($request->type_of_tutor===1)
                                            <span class="badge badge-pill bg-info-light">Sinh viên</span>
                                        @endif
                                        @if($request->type_of_tutor===2)
                                            <span class="badge badge-pill bg-success-light">Giáo viên</span>
                                        @endif
                                        @if($request->type_of_tutor===3)
                                            <span class="badge badge-pill bg-info-light">Sinh viên,</span>
                                            <span class="badge badge-pill bg-success-light">Giáo viên</span>
                                        @endif
{{--                                        gender--}}
                                        @if($request->tutor_gender===1)
                                            <span class="badge badge-pill bg-info-light">Nam</span>
                                        @endif
                                        @if($request->tutor_gender===2)
                                            <span class="badge badge-pill bg-success-light">Nữ</span>
                                        @endif
                                        @if($request->tutor_gender===3)
                                            <span class="badge badge-pill bg-info-light">Nam,</span>
                                            <span class="badge badge-pill bg-success-light">Nữ</span>
                                        @endif
                                    </li>
                                    <li>Số học viên: {{$request->number_of_student ?? "1"}}</li>
                                    <li>Số giờ học/buổi: {{$request->number_of_hour}}h</li>
                                </ul>
                            </div>
                            <!-- /Services List -->
                        </div>
                        <div class="col-md-2">
                            @if (auth()->check())
                                @can('view', auth()->user()->tutor)
                                    @if($request->status !==3)
                                        <div class=" mb-3"><button tutor-data="{{auth()->user()->tutor->id ?? 0}}" id="ask-for-teach" request-data="{{$request->id}}" class="btn btn-primary">Nhận dạy</button></div>
                                    @else
                                        <div class=" mb-3"><button class="btn btn-dark">Lớp đã được nhận</button></div>
                                    @endif

                                @endcan
                            @endif
                            <small>Đã có <span id="number-tutor-apply">{{count($request->tutors)}}</span>/5 yêu cầu dạy</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- /Doctor Widget -->

            <!-- Doctor Details Tab -->
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 col-lg-9">

                            <!-- About Details -->
                            <div class="widget about-widget">
                                <h4 class="widget-title">Nội dung chi tiết</h4>
                                <p>{{$request->description}}</p>
                            </div>
                            <!-- /About Details -->
{{--{{dd($request->schedule->checkSchedule('mon','morning'))}}--}}
{{--                        {{dd($request->schedule)}}--}}

                        <!-- schedule Details -->
                            <div class="widget education-widget">
                                <h4 class="widget-title">Lịch học dự kiến</h4>
                                <div class="row form-row justify-content-center">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="weekday-calendar schedule view-only">
                                                <div class="day-of-week mon">
                                                    <button type="button" value="mon" class="btn btn-secondary">Thứ 2</button>
                                                    <ul class="custom-checkbox">
                                                        <li>
                                                            <input name="schedule[mon][]" type="checkbox" id="morning-2" value="morning"
                                                                {{$request->schedule->checkSchedule('mon','morning')==true ? 'checked' : ''}}>
                                                            <label for="morning-2">Sáng</label>
                                                        </li>
                                                        <li>
                                                            <input name="schedule[mon][]" type="checkbox" id="afternoon-2" value="afternoon"
                                                            {{$request->schedule->checkSchedule('mon','afternoon')==true ? 'checked' : ''}}>
                                                            <label for="afternoon-2">Chiều</label></li>
                                                        <li>
                                                            <input name="schedule[mon][]" type="checkbox" id="evening-2" value="evening"
                                                            {{$request->schedule->checkSchedule('mon','evening')==true ? 'checked' : ''}}>
                                                            <label for="evening-2">Tối</label></li>
                                                    </ul>
                                                </div>
                                                <div class="day-of-week tue">
                                                    <button type="button" value="tue" class="btn btn-secondary">Thứ 3</button>
                                                    <ul class="custom-checkbox">
                                                        <li>
                                                            <input name="schedule[tue][]" type="checkbox" id="morning-3" value="morning"
                                                            {{$request->schedule->checkSchedule('tue','morning')==true ? 'checked' : ''}}>
                                                            <label for="morning-3">Sáng</label></li>
                                                        <li>
                                                            <input name="schedule[tue][]" type="checkbox" id="afternoon-3" value="afternoon"
                                                            {{$request->schedule->checkSchedule('tue','afternoon')==true ? 'checked' : ''}}>
                                                            <label for="afternoon-3">Chiều</label></li>
                                                        <li>
                                                            <input name="schedule[tue][]" type="checkbox" id="evening-3" value="evening"
                                                            {{$request->schedule->checkSchedule('tue','evening')==true ? 'checked' : ''}}>
                                                            <label for="evening-3">Tối</label></li>
                                                    </ul>
                                                </div>
                                                <div class="day-of-week wed">
                                                    <button type="button" value="wed" class="btn btn-secondary">Thứ 4</button>
                                                    <ul class="custom-checkbox">
                                                        <li>
                                                            <input name="schedule[wed][]" type="checkbox" id="morning-4" value="morning"
                                                            {{$request->schedule->checkSchedule('wed','morning')==true ? 'checked' : ''}}>
                                                            <label for="morning-4">Sáng</label></li>
                                                        <li>
                                                            <input name="schedule[wed][]" type="checkbox" id="afternoon-4" value="afternoon"
                                                            {{$request->schedule->checkSchedule('wed','afternoon')==true ? 'checked' : ''}}>
                                                            <label for="afternoon-4">Chiều</label></li>
                                                        <li>
                                                            <input name="schedule[wed][]" type="checkbox" id="evening-4" value="evening"
                                                            {{$request->schedule->checkSchedule('wed','evening')==true ? 'checked' : ''}}>
                                                            <label for="evening-4">Tối</label></li>
                                                    </ul>
                                                </div>
                                                <div class="day-of-week thur">
                                                    <button type="button" value="thur" class="btn btn-secondary">Thứ 5</button>
                                                    <ul class="custom-checkbox">
                                                        <li>
                                                            <input name="schedule[thur][]" type="checkbox" id="morning-5" value="morning"
                                                            {{$request->schedule->checkSchedule('thur','morning')==true ? 'checked' : ''}}>
                                                            <label for="morning-5">Sáng</label></li>
                                                        <li>
                                                            <input name="schedule[thur][]" type="checkbox" id="afternoon-5" value="afternoon"
                                                            {{$request->schedule->checkSchedule('thur','afternoon')==true ? 'checked' : ''}}>
                                                            <label for="afternoon-5">Chiều</label></li>
                                                        <li>
                                                            <input name="schedule[thur][]" type="checkbox" id="evening-5" value="evening"
                                                            {{$request->schedule->checkSchedule('thur','evening')==true ? 'checked' : ''}}>
                                                            <label for="evening-5">Tối</label></li>
                                                    </ul>
                                                </div>
                                                <div class="day-of-week fri">
                                                    <button type="button" value="fri" class="btn btn-secondary">Thứ 6</button>
                                                    <ul class="custom-checkbox">
                                                        <li>
                                                            <input name="schedule[fri][]" type="checkbox" id="morning-6" value="morning"
                                                            {{$request->schedule->checkSchedule('fri','morning')==true ? 'checked' : ''}}>
                                                            <label for="morning-6">Sáng</label></li>
                                                        <li>
                                                            <input name="schedule[fri][]" type="checkbox" id="afternoon-6" value="afternoon"
                                                            {{$request->schedule->checkSchedule('fri','afternoon')==true ? 'checked' : ''}}>
                                                            <label for="afternoon-6">Chiều</label></li>
                                                        <li>
                                                            <input name="schedule[fri][]" type="checkbox" id="evening-6" value="evening"
                                                            {{$request->schedule->checkSchedule('fri','evening')==true ? 'checked' : ''}}>
                                                            <label for="evening-6">Tối</label></li>
                                                    </ul>
                                                </div>
                                                <div class="day-of-week sat">
                                                    <button type="button" value="sat" class="btn btn-secondary">Thứ 7</button>
                                                    <ul class="custom-checkbox">
                                                        <li>
                                                            <input name="schedule[sat][]" type="checkbox" id="morning-7" value="morning"
                                                            {{$request->schedule->checkSchedule('sat','morning')==true ? 'checked' : ''}}>
                                                            <label for="morning-7">Sáng</label></li>
                                                        <li>
                                                            <input name="schedule[sat][]" type="checkbox" id="afternoon-7" value="afternoon"
                                                            {{$request->schedule->checkSchedule('sat','afternoon')==true ? 'checked' : ''}}>
                                                            <label for="afternoon-7">Chiều</label></li>
                                                        <li>
                                                            <input name="schedule[sat][]" type="checkbox" id="evening-7" value="evening"
                                                            {{$request->schedule->checkSchedule('sat','evening')==true ? 'checked' : ''}}>
                                                            <label for="evening-7">Tối</label></li>
                                                    </ul>
                                                </div>
                                                <div class="day-of-week sun">
                                                    <button type="button" value="sun" class="btn btn-secondary">Chủ Nhật</button>
                                                    <ul class="custom-checkbox">
                                                        <li>
                                                            <input name="schedule[sun][]" type="checkbox" id="morning-8" value="morning"
                                                            {{$request->schedule->checkSchedule('sun','morning')==true ? 'checked' : ''}}>
                                                            <label for="morning-8">Sáng</label></li>
                                                        <li>
                                                            <input name="schedule[sun][]" type="checkbox" id="afternoon-8" value="afternoon"
                                                            {{$request->schedule->checkSchedule('sun','afternoon')==true ? 'checked' : ''}}>
                                                            <label for="afternoon-8">Chiều</label></li>
                                                        <li>
                                                            <input name="schedule[sun][]" type="checkbox" id="evening-8" value="evening"
                                                            {{$request->schedule->checkSchedule('sun','evening')==true ? 'checked' : ''}}>
                                                            <label for="evening-8">Tối</label></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    @error('schedule')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <!-- /schedule Details -->

                            <!-- Location Details -->
                            <div class="widget experience-widget">
                                <h4 class="widget-title">Địa chỉ học</h4>
                                @if($request->learning_method == 2)
                                    <div>Học online</div>
                                @elseif($request->learning_method == 1)
                                <div class="location">
                                    {{$request->address ?? ''}}, {{$request->district->name ?? ''}}, {{$request->city->name ?? ''}}
                                </div>
                                @endif
                            </div>
                            <!-- /Location Details -->

                        </div>
                    </div>

                </div>
            </div>
            <!-- /Doctor Details Tab -->

        </div>
    </div>
    <!-- /Page Content -->

@endsection
