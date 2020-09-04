@extends('layouts.app')

@section('bottom.js')
    <script src="{{ asset('js/student/profile.js') }}"></script>
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

            <div class="row">
                <div class="col-md-8 col-lg-9">
                    <form action="{{ route('request.store') }}" method="post" id="form" enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf
                    <!-- Basic Information -->
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Mô tả yêu cầu tìm gia sư</h4>
                            </div>
                            <div class="card-body request-information">
                                <h4 class="card-title">Thông tin cơ bản</h4>
                                <div class="row form-row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="short_description">Tóm tắt yêu cầu <span class="text-danger">*</span></label>
                                            <input required name="short_description" value="{{old('short_description')}}" id="short_description" type="text" placeholder="Ví dụ: Tìm gia sư Tiếng Anh tại Hà Nội" class="form-control">
                                            @error('short_description')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="subject">Môn học</label>
                                            <select required name="subject" id="subject" class="form-control select">
                                                <option value="">Lựa chọn</option>
                                                @foreach($specialities as $speciality)
                                                    <optgroup label="{{$speciality->name}}">
                                                        @foreach($speciality->subjects as $subject)
                                                            <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                                        @endforeach
                                                    </optgroup>]
                                                @endforeach
                                            </select>
                                            @error('subject')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- /Basic Information -->
                        <!-- Pricing -->
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Học phí</h4>
                                <div class="row custom_price_cont" id="custom_price_cont" >
                                    <div class="col-md-6">
                                        <label for="expect_fee">Học phí</label>
                                        <input type="number" required value="{{ old('expect_fee') }}" class="form-control" id="expect_fee" name="expect_fee"  placeholder="200 000">
                                        <small class="form-text text-muted">Học phí tính trên 1 buổi học (VNĐ)</small>
                                        @error('expect_fee')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <h4 class="card-title">Số giờ học/buổi</h4>
                                        <div class="form-group mb-0">
                                            <div id="number-of-hour">
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input" id="one-hour" name="number_of_hour" value="1" required="">
                                                    <label class="custom-control-label" for="one-hour">1h</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input" id="one-point-5" name="number_of_hour" value="1.5" required="">
                                                    <label class="custom-control-label" for="one-point-5">1.5h</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input" id="two-hour" name="number_of_hour" value="2" checked required="">
                                                    <label class="custom-control-label" for="two-hour">2h</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input" id="two-point-5" name="number_of_hour" value="2.5" required="">
                                                    <label class="custom-control-label" for="two-point-5">2.5h</label>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- /Pricing -->

                        <!-- About Me -->
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Thông tin lớp học</h4>
                                <div class="row form-row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="phone">Điện thoại liên hệ</label>
                                            <input name="phone" required value="{{ old('phone') }}" id="phone" type="text" class="form-control">
                                            @error('phone')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-1"></div>
                                    <div class="col-md-6 ">
                                        <label>Hình thức học</label>
                                        <div class="form-group" id="study-method-select">
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" class="custom-control-input" id="home-study" name="learning_method" value="1" required="">
                                                <label class="custom-control-label" for="home-study">Gia sư tại nhà</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" class="custom-control-input" id="online-study" name="learning_method" value="2" required="">
                                                <label class="custom-control-label" for="online-study">Học online</label>
                                            </div>
                                            <div>
                                                @error('learning_method')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <i class="js-errors" style="display: none"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-row custom-study-method" id="custom-study-address" style="display: none" >
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="city">Thành phố</label>
                                            <select id="city" name="city" class="form-control select">
                                                <option value="">Lựa chọn...</option>
                                                @foreach($cities as  $city)
                                                    <option value="{{$city->id}}"> {{$city->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('city')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="district">Quận huyện</label>
                                            <select  name="district" id="district" class="form-control select">
                                            </select>
                                            @error('district')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="address">Địa chỉ cụ thể</label>
                                            <input id="address" name="address" value="{{ old('address') }}" type="text" class="form-control">
                                            @error('address')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /About Me -->

                        <!-- Clinic Info -->
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Thời gian có thể học</h4>
                                <div class="row form-row justify-content-center">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="weekday-calendar schedule">
                                                <div class="day-of-week mon">
                                                    <button type="button" value="mon" class="btn btn-secondary">Thứ 2</button>
                                                    <ul class="custom-checkbox">
                                                        <li><input name="schedule[mon][]" type="checkbox" id="morning-2" value="morning"><label for="morning-2">Sáng</label></li>
                                                        <li><input name="schedule[mon][]" type="checkbox" id="afternoon-2" value="afternoon" ><label for="afternoon-2">Chiều</label></li>
                                                        <li><input name="schedule[mon][]" type="checkbox" id="evening-2" value="evening" ><label for="evening-2">Tối</label></li>
                                                    </ul>
                                                </div>
                                                <div class="day-of-week tue">
                                                    <button type="button" value="tue" class="btn btn-secondary">Thứ 3</button>
                                                    <ul class="custom-checkbox">
                                                        <li><input name="schedule[tue][]" type="checkbox" id="morning-3" value="morning"><label for="morning-3">Sáng</label></li>
                                                        <li><input name="schedule[tue][]" type="checkbox" id="afternoon-3" value="afternoon" ><label for="afternoon-3">Chiều</label></li>
                                                        <li><input name="schedule[tue][]" type="checkbox" id="evening-3" value="evening" ><label for="evening-3">Tối</label></li>
                                                    </ul>
                                                </div>
                                                <div class="day-of-week wed">
                                                    <button type="button" value="wed" class="btn btn-secondary">Thứ 4</button>
                                                    <ul class="custom-checkbox">
                                                        <li><input name="schedule[wed][]" type="checkbox" id="morning-4" value="morning"><label for="morning-4">Sáng</label></li>
                                                        <li><input name="schedule[wed][]" type="checkbox" id="afternoon-4" value="afternoon" ><label for="afternoon-4">Chiều</label></li>
                                                        <li><input name="schedule[wed][]" type="checkbox" id="evening-4" value="evening" ><label for="evening-4">Tối</label></li>
                                                    </ul>
                                                </div>
                                                <div class="day-of-week thur">
                                                    <button type="button" value="thur" class="btn btn-secondary">Thứ 5</button>
                                                    <ul class="custom-checkbox">
                                                        <li><input name="schedule[thur][]" type="checkbox" id="morning-5" value="morning"><label for="morning-5">Sáng</label></li>
                                                        <li><input name="schedule[thur][]" type="checkbox" id="afternoon-5" value="afternoon" ><label for="afternoon-5">Chiều</label></li>
                                                        <li><input name="schedule[thur][]" type="checkbox" id="evening-5" value="evening" ><label for="evening-5">Tối</label></li>
                                                    </ul>
                                                </div>
                                                <div class="day-of-week fri">
                                                    <button type="button" value="fri" class="btn btn-secondary">Thứ 6</button>
                                                    <ul class="custom-checkbox">
                                                        <li><input name="schedule[fri][]" type="checkbox" id="morning-6" value="morning"><label for="morning-6">Sáng</label></li>
                                                        <li><input name="schedule[fri][]" type="checkbox" id="afternoon-6" value="afternoon" ><label for="afternoon-6">Chiều</label></li>
                                                        <li><input name="schedule[fri][]" type="checkbox" id="evening-6" value="evening" ><label for="evening-6">Tối</label></li>
                                                    </ul>
                                                </div>
                                                <div class="day-of-week sat">
                                                    <button type="button" value="sat" class="btn btn-secondary">Thứ 7</button>
                                                    <ul class="custom-checkbox">
                                                        <li><input name="schedule[sat][]" type="checkbox" id="morning-7" value="morning"><label for="morning-7">Sáng</label></li>
                                                        <li><input name="schedule[sat][]" type="checkbox" id="afternoon-7" value="afternoon" ><label for="afternoon-7">Chiều</label></li>
                                                        <li><input name="schedule[sat][]" type="checkbox" id="evening-7" value="evening" ><label for="evening-7">Tối</label></li>
                                                    </ul>
                                                </div>
                                                <div class="day-of-week sun">
                                                    <button type="button" value="sun" class="btn btn-secondary">Chủ Nhật</button>
                                                    <ul class="custom-checkbox">
                                                        <li><input name="schedule[sun][]" type="checkbox" id="morning-8" value="morning"><label for="morning-8">Sáng</label></li>
                                                        <li><input name="schedule[sun][]" type="checkbox" id="afternoon-8" value="afternoon" ><label for="afternoon-8">Chiều</label></li>
                                                        <li><input name="schedule[sun][]" type="checkbox" id="evening-8" value="evening" ><label for="evening-8">Tối</label></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <i class="js-errors" style="display: none"></i>
                                        </div>

                                    </div>
                                    @error('schedule')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- /Clinic Info -->

                        <!-- Contact Details -->
                        <div class="card contact-card">
                            <div class="card-body">
                                <h4 class="card-title">Thông tin thêm</h4>
                                <div class="row form-row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="description">Mô tả chi tiết nội dung muốn học</label>
                                            <textarea required name="description" id="description" class="form-control" rows="3">{{old('description')}}</textarea>
                                            @error('description')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" >
                                            <label>Kiểu gia sư</label>
                                            <div id="type-of-tutor">
                                                <div class="custom-control custom-checkbox custom-control-inline">
                                                    <input name="type_of_tutor[student]" value="1" type="checkbox" class="custom-control-input checkbox" id="sinhvien">
                                                    <label class="custom-control-label" for="sinhvien">Sinh viên</label>
                                                </div>
                                                <div class="custom-control custom-checkbox custom-control-inline">
                                                    <input name="type_of_tutor[teacher]" value="1" type="checkbox" class="custom-control-input checkbox"  id="giaovien">
                                                    <label class="custom-control-label" for="giaovien">Giáo viên</label>
                                                </div>
                                                <i class="js-errors" style="display: none"></i>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" >
                                            <label>Giới tính gia sư</label>
                                            <div id="type-of-tutor">
                                                <div class="custom-control custom-checkbox custom-control-inline">
                                                    <input name="tutor_gender[male]" value="1" type="checkbox" class="custom-control-input checkbox" id="male-tutor" >
                                                    <label class="custom-control-label" for="male-tutor">Nam</label>
                                                </div>
                                                <div class="custom-control custom-checkbox custom-control-inline">
                                                    <input name="tutor_gender[female]" value="1" type="checkbox" class="custom-control-input checkbox"  id="female-tutor" >
                                                    <label class="custom-control-label" for="female-tutor">Nữ</label>
                                                </div>
                                                <i class="js-errors" style="display: none"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="number_of_student" class="control-label">Số học viên</label>
                                            <input id="number_of_student" type="number" name="number_of_student" value="{{old('number_of_student') ?? '1'}}" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Contact Details -->




                        <div class="submit-section submit-btn-bottom">
                            <button id="submit" type="submit" class="btn btn-primary submit-btn">Đăng yêu cầu</button>
                        </div>
                    </form>
                </div>

                <div class="col-md-4 col-lg-3 theiaStickySidebar">

                    <!-- Booking Summary -->
                    <div class="card booking-card">
                        <div class="card-header">
                            <h4 class="card-title">Tìm gia sư thời 4.0</h4>
                        </div>
                        <div class="card-body">


                            <!-- Booking  Info -->

                            <div class="booking-summary">
                                <div class="booking-item-wrap">
                                    <ul class="booking-date">
                                        <li>Bước 1:<span>Đăng yêu cầu</span></li>
                                        <li>Bước 2:<span>Lựa chọn gia sư</span></li>
                                        <li>Bước 3:<span>Kết nối gia sư</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Booking Summary -->

                </div>
            </div>

        </div>

    </div>
    <!-- /Page Content -->

@endsection
