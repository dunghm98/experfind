@extends('student.dashboard')

@section('bottom.js')
    <script src="{{ asset('js/student/profile.js') }}"></script>
@endsection

@section('student-dashboard-content')


    <?php /** @var \App\User $student */ ?>
    <div class="col-md-7 col-lg-8 col-xl-9">
        <form action="{{ route('student.update', ['user' => $student]) }}" method="post" enctype="multipart/form-data">
            @method('PATCH')
            @csrf
        <div class="card">
            <div class="card-body">
                <!-- Profile Settings Form -->
                    <div class="row form-row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="change-avatar">
                                    <div class="profile-img">
                                        <img id="preview-avatar"
                                             src="{{asset($student->avatar ? 'storage/'. $student->avatar : ($student->gender == 1 ? 'img/tutors/avatars/default-boy.png':'img/tutors/avatars/default-girl.png' ))}}" alt="User Avatar">
                                    </div>
                                    <div class="upload-img">
                                        <div class="change-photo-btn">
                                            <span><i class="fa fa-upload"></i> Upload Photo</span>
                                            <input type="file" name="avatar" class="upload" id="avatar">
                                        </div>
                                        <small class="form-text text-muted">Allowed JPG, GIF or PNG. Max size of 2MB</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Họ Tên <span class="text-danger">*</span></label>
                                <input name="name" type="text" class="form-control" value="{{ old('name', $student->name)}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control" value="{{ old('email', $student->email) }}">
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Điện thoại <span class="text-danger">*</span></label>
                                <input name="phone" value="{{old('phone', $student->phone)}}" type="text" class="form-control">
                                @error('phone')
                                <span class="text-danger">{!! $message !!}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Giới tính</label>
                                <select name="gender" class="form-control select">
                                    <option {{ (int)old('gender', $student->gender) === 1 ? 'selected' : '' }} value="1">Nam</option>
                                    <option {{ (int)old('gender', $student->gender) === 0 ? 'selected' : '' }} value="0">Nữ</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-0">
                                <label>Ngày sinh</label>
                                <div class="cal-icon">
                                    <input type="text" name="dob" value="{{ old('dob', date('d/m/Y', strtotime($student->dob))) }}" class="form-control datetimepicker" placeholder="Chọn ngày">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Môn học quan tâm</label>
                                <select class="form-control select">
                                    <option>Toán</option>
                                    <option>Tiếng Anh</option>
                                    <option>B-</option>
                                    <option>B+</option>
                                    <option>AB-</option>
                                    <option>AB+</option>
                                    <option>O-</option>
                                    <option>O+</option>
                                </select>
                            </div>
                        </div>
                    </div>

                <!-- /Profile Settings Form -->

            </div>
        </div>
        <!-- Contact Details -->
        <div class="card contact-card">
            <div class="card-body">
                <h4 class="card-title">Thông tin liên hệ</h4>
                <div class="row form-row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="city">Thành phố</label>
                            <select id="city" name="city" class="form-control select">
                                <option value="">Lựa chọn...</option>
                                @foreach($cities as $key => $city)
                                    <option {{$student->city_id === $key ? 'selected' : '' }} value="{{$key}}"> {{$city}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div id="test"></div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="district">Quận huyện</label>
                            <select selected-dist="{{ $student->district_id }}" name="district" id="district" class="form-control select">
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="address">Địa chỉ cụ thể</label>
                            <input id="address" name="address" value="{{ old('address', $student->address ) }}" type="text" class="form-control">
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- /Contact Details -->
            <div class="submit-section">
                <button type="submit" class="btn btn-primary submit-btn">Lưu thay đổi</button>
            </div>
        </form>
    </div>
@endsection
