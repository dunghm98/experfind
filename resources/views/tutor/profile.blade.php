@extends('tutor.dashboard')

<?php /** @var \App\Tutor $tutor */ ?>

@section('bottom.js')
    <script>
        var oldSpecialities = @json(old('speciality_name', $specialities->pluck('id'))),
            oldSubjects = @json(old('subject_name', $tutor->subjects->pluck('id')));

    </script>
    <script src="{{ asset('js/tutor/profile.js') }}"></script>
    @endsection

@section('dashboard-content')

    <div class="col-md-7 col-lg-8 col-xl-9">
        <form action="{{ route('tutor.updateProfile', $tutor->id) }}" method="post" enctype="multipart/form-data">
            @method('PATCH')
                @csrf
        <!-- Basic Information -->
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Thông tin cơ bản</h4>
                <div class="row form-row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="change-avatar">
                                <div class="profile-img">
                                    <img id="preview-avatar"
                                         src="{{asset($tutor->user->avatar ? 'storage/'. $tutor->user->avatar : ($tutor->user->gender == 1 ? 'img/tutors/avatars/default-boy.png':'img/tutors/avatars/default-girl.png' ))}}" alt="User Avatar">
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
                            <input name="name" type="text" class="form-control" value="{{ old('name', $tutor->user->name)}}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', $tutor->user->email) }}">
                            @error('email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Điện thoại <span class="text-danger">*</span></label>
                            <input name="phone" value="{{old('phone', $tutor->user->phone)}}" type="text" class="form-control">
                            @error('phone')
                                <span class="text-danger">{!! $message !!}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Giới tính</label>
                            <select name="gender" class="form-control select">
                                <option {{ (int)old('gender', $tutor->user->gender) === 1 ? 'selected' : '' }} value="1">Nam</option>
                                <option {{ (int)old('gender', $tutor->user->gender) === 0 ? 'selected' : '' }} value="0">Nữ</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-0">
                            <label>Ngày sinh</label>
                            <div class="cal-icon">
                                <input type="text" name="dob" value="{{ old('dob', date('d/m/Y', strtotime($tutor->user->dob))) }}" class="form-control datetimepicker" placeholder="Chọn ngày">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 ml-2">
                        <div class="form-group mb-0">
                            <label>Bạn đang là</label>
                            <select name="type_of_tutor" class="form-control select">
                                <option {{ (int)old('type_of_tutor', $tutor->type_of_tutor) === 0 ? 'selected' : '' }} value="0">Sinh viên</option>
                                <option {{ (int)old('type_of_tutor', $tutor->type_of_tutor) === 1 ? 'selected' : '' }} value="1">Giáo viên</option>
                                <option {{ (int)old('type_of_tutor', $tutor->type_of_tutor) === 2 ? 'selected' : '' }} value="2">Người đi làm</option>
                            </select>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Basic Information -->

        <!-- About Me -->
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Về bản thân</h4>
                <div class="form-group mb-0">
                    <label>Một vài nét về bản thân để học sinh hiểu rõ bạn hơn</label>
                    <textarea name="introduction" class="form-control" rows="5">{{ old('introduction', $tutor->introduction) }}</textarea>
                </div>
            </div>
        </div>
        <!-- /About Me -->

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
                                    <option {{$tutor->user->city_id === $key ? 'selected' : '' }} value="{{$key}}"> {{$city}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div id="test"></div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="district">Quận huyện</label>
                            <select selected-dist="{{ $tutor->user->district_id }}" name="district" id="district" class="form-control select">
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="address">Địa chỉ cụ thể</label>
                            <input id="address" name="address" value="{{ old('address', $tutor->user->address ) }}" type="text" class="form-control">
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- /Contact Details -->

        <!-- Education -->
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Học vấn</h4>
                <div class="education-info">
                    @forelse($tutor->educations as $key => $edu)
                    <div class="row form-row education-cont">
                        <div class="col-12 col-md-10 col-lg-11">
                            <div class="row form-row">
                                <div class="col-12 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label>Trình độ</label>
                                        <select name="educations[{{$key}}][degree]" class="form-control select">
                                            <option value="0">Lựa chọn...</option>
                                            <option {{((int)old('degree', $edu->degree) === 1) ? 'selected' : ''}} value="1">Cao học</option>
                                            <option {{((int)old('degree', $edu->degree) === 2) ? 'selected' : ''}} value="2">Đại học</option>
                                            <option {{((int)old('degree', $edu->degree) === 3) ? 'selected' : ''}} value="3">Cao đẳng</option>
                                            <option {{((int)old('degree', $edu->degree) === 4) ? 'selected' : ''}} value="4">Khác</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Tên trường</label>
                                        <input value="{{ old('college', $edu->college) }}" name="educations[{{$key}}][college]"
                                               type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-12 col-md-2 col-lg-2">
                                    <div class="form-group">
                                        <label>Năm tốt nghiệp</label>
                                        <input value="{{ old('graduate_year', $edu->graduate_year) }}"
                                               name="educations[{{$key}}][graduate_year]" type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-2 col-lg-1">
                            <label class="d-md-block d-sm-none d-none">&nbsp;</label>
                            <a href="#" class="btn btn-danger trash">
                                <i class="far fa-trash-alt"></i>
                            </a>
                        </div>
                    </div>
                        @empty
                            <div class="row form-row education-cont">
                                <div class="col-12 col-md-10 col-lg-11">
                                    <div class="row form-row">
                                        <div class="col-12 col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label>Trình độ</label>
                                                <select name="educations[0][degree]" class="form-control select">
                                                    <option value="0">Lựa chọn...</option>
                                                    <option  value="1">Cao học</option>
                                                    <option  value="2">Đại học</option>
                                                    <option  value="3">Cao đẳng</option>
                                                    <option  value="4">Khác</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label>Tên trường</label>
                                                <input value="{{ old('college') }}" name="educations[0][college]"
                                                       type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-2 col-lg-2">
                                            <div class="form-group">
                                                <label>Năm tốt nghiệp</label>
                                                <input value="{{ old('graduate_year') }}"
                                                       name="educations[0][graduate_year]" type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-2 col-lg-1">
                                    <label class="d-md-block d-sm-none d-none">&nbsp;</label>
                                    <a href="#" class="btn btn-danger trash">
                                        <i class="far fa-trash-alt"></i>
                                    </a>
                                </div>
                            </div>
                    @endforelse
                </div>
                <div class="add-more">
                    <a href="javascript:void(0);" class="add-education"><i class="fa fa-plus-circle"></i> Add More</a>
                </div>
            </div>
        </div>
        <!-- /Education -->

        <!-- Services and Specialization -->
        <div class="card services-card">
            <div class="card-body">
                <h4 class="card-title">Chuyên môn</h4>
                <div class="row form-row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Kiến thức chuyên môn</label>
                            <select name="speciality_name[]" multiple="multiple" id="speciality_name" class="form-control select">
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Môn học</label>
                            <select name="subject_name[]"
                                    multiple="multiple"
                                    id="subject_name"
                                    class="form-control select">
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Tag kiến thức</label>
                    <input class="input-tags form-control" type="text" data-role="tagsinput" placeholder="Nhập tag" name="tag"
                           value="{{ old('tag', $tutor->tag ?? 'Tiếng Anh lớp 10, Toán cấp 2, Lý cấp 3') }}" id="tag">
                    <small class="form-text text-muted">Note : Gõ và nhấn enter để thêm mới 1 tag kiến thức</small>
                </div>
            </div>
        </div>
        <!-- /Services and Specialization -->

        <!-- Pricing -->
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Học phí</h4>
                <div class="form-group mb-0">
                    <div id="pricing_select">
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="price_free" name="tuition" class="tuition_fee custom-control-input" {{ (int)$tutor->tuition_fee === 0 ? 'checked' : '' }} value="free">
                            <label class="custom-control-label" for="price_free">Miễn phí</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="price_custom" {{ (int)$tutor->tuition_fee !== 0 ? 'checked' : '' }} name="tuition" value="non-fee" class="tuition_fee custom-control-input">
                            <label class="custom-control-label" for="price_custom">Có phí (theo giờ)</label>
                        </div>
                    </div>
                </div>

                <div class="row custom_price_cont" id="custom_price_cont" {{ (int)$tutor->tuition_fee === 0 ? ' style=display:none '   : '' }} >
                    <div class="col-md-4">
                        <input type="text" value="{{ old('tuition_fee', $tutor->tuition_fee ) }}" class="form-control" id="custom_rating_input" name="tuition_fee"  placeholder="200 000">
                        <small class="form-text text-muted">Học phí bạn đưa ra</small>
                    </div>
                </div>

            </div>
        </div>
        <!-- /Pricing -->

        <!-- Experience -->
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Kinh nghiệm giảng dạy</h4>
                <div class="experience-info">
                    @forelse($tutor->experiences as $key => $exp)
                    <div class="row form-row experience-cont">
                        <div class="col-12 col-md-10 col-lg-11">
                            <div class="row form-row">
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="description-exp">Nội dung</label>
                                        <textarea class="form-control" name="experiences[{{$key}}][description]" id="description-exp" cols="30" rows="3">{{ old('description', $exp->description) }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12 col-md-8 col-lg-3">
                                    <div class="form-group">
                                        <label>Thời gian bắt đầu</label>
                                        <input type="text" name="experiences[{{$key}}][start_time]" class="form-control datetimepicker"
                                               value="{{old('start_time', date('d/m/Y', strtotime($exp->start_time)))}}" placeholder="Chọn thời gian">
                                    </div>
                                </div>
                                <div class="col-12 col-md-2 col-lg-3">
                                    <div class="form-group">
                                        <label>Thời gian kết thúc</label>
                                        <input type="text" name="experiences[{{$key}}][end_time]" class="form-control datetimepicker"
                                               value="{{old('start_time', date('d/m/Y', strtotime($exp->end_time)))}}" placeholder="Chọn thời gian">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-2 col-lg-1">
                            <label class="d-md-block d-sm-none d-none">&nbsp;</label>
                            <a href="#" class="btn btn-danger trash">
                                <i class="far fa-trash-alt"></i>
                            </a>
                        </div>
                    </div>
                        @empty
                        <div class="row form-row experience-cont">
                            <div class="col-12 col-md-10 col-lg-11">
                                <div class="row form-row">
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="description-exp">Nội dung</label>
                                            <textarea class="form-control" name="experiences[0][description]" id="description-exp" cols="30" rows="3">
                                            {{ old('description') }}
                                        </textarea>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-8 col-lg-3">
                                        <div class="form-group">
                                            <label>Thời gian bắt đầu</label>
                                            <input type="text" name="experiences[0][start_time]" class="form-control datetimepicker"
                                                   value="{{old('start_time')}}" placeholder="Chọn thời gian">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-2 col-lg-3">
                                        <div class="form-group">
                                            <label>Thời gian kết thúc</label>
                                            <input type="text" name="experiences[0][end_time]" class="form-control datetimepicker"
                                                   value="{{old('end_time')}}" placeholder="Chọn thời gian">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-2 col-lg-1">
                                <label class="d-md-block d-sm-none d-none">&nbsp;</label>
                                <a href="#" class="btn btn-danger trash">
                                    <i class="far fa-trash-alt"></i>
                                </a>
                            </div>
                        </div>
                        @endforelse
                </div>
                <div class="add-more">
                    <a href="javascript:void(0);" class="add-experience"><i class="fa fa-plus-circle"></i> Add More</a>
                </div>
            </div>
        </div>
        <!-- /Experience -->

        <!-- Certificate -->
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Chứng chỉ</h4>
                <div class="certificates-info">
                    @forelse($tutor->certificates as $key => $cert)
                    <div class="row form-row certificates-cont">
                        <div class="col-12 col-md-5">
                            <div class="form-group">
                                <label for="certificate_name">Tên chứng chỉ</label>
                                <input name="certificates[{{$key}}][name]" id="certificate_name" type="text" value="{{ old('certificate_name', $cert->name) }}" class="form-control">
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label for="issued_by">Nơi cấp</label>
                                <input name="certificates[{{$key}}][issued_by]" id="issued_by" type="text" value="{{ old('issued_by', $cert->issued_by) }}" class="form-control">
                            </div>
                        </div>
                        <div class="col-12 col-md-2">
                            <div class="form-group">
                                <label for="year_granted">Năm</label>
                                <input name="certificates[{{$key}}][year_granted]" id="year_granted" type="text" value="{{ old('year_granted', $cert->year_granted) }}" class="form-control">
                            </div>
                        </div>
                        <div class="col-12 col-md-2 col-lg-1">
                            <label class="d-md-block d-sm-none d-none">&nbsp;</label>
                            <a href="#" class="btn btn-danger trash">
                                <i class="far fa-trash-alt"></i>
                            </a>
                        </div>
                    </div>
                        @empty
                        <div class="row form-row certificates-cont">
                            <div class="col-12 col-md-5">
                                <div class="form-group">
                                    <label for="certificate_name">Tên chứng chỉ</label>
                                    <input name="certificates[0][name]" id="certificate_name" type="text" value="{{ old('certificate_name.0.name') }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="form-group">
                                    <label for="issued_by">Nơi cấp</label>
                                    <input name="certificates[0][issued_by]" id="issued_by" type="text" value="{{ old('issued_by.0.by') }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-12 col-md-2">
                                <div class="form-group">
                                    <label for="year_granted">Năm</label>
                                    <input name="certificates[0][year_granted]" id="year_granted" type="text" value="{{ old('year_granted.0.year') }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-12 col-md-2 col-lg-1">
                                <label class="d-md-block d-sm-none d-none">&nbsp;</label>
                                <a href="#" class="btn btn-danger trash">
                                    <i class="far fa-trash-alt"></i>
                                </a>
                            </div>
                        </div>
                    @endforelse
                </div>
                <div class="add-more">
                    <a href="javascript:void(0);" class="add-award"><i class="fa fa-plus-circle"></i> Add More</a>
                </div>
            </div>
        </div>
        <!-- /Certificate -->
        <!-- Authentications -->
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Xác thực thông tin</h4>
                <small class="form-text text-danger">Bạn cần tải lên ảnh của các giấy tờ, bằng cấp hay chứng chỉ để tỉ lệ xét duyệt cao và thời gian duyệt được nhanh nhất</small>
                <div  class="show-message text-info"></div>
                <div class="mt-2 auth-info" id="authentications-info" tutor-id="{{ $tutor->id }}" >
                    @forelse($tutor->authentications as $key => $auth_info)
                        <div class="row form-row auth-cont">
                            <div class="col-12 col-md-4 col-lg-4 show-errors-block">
                                <div class="form-group">
                                    <label for="auth_info_name">Loại giấy tờ</label>
                                    <input id="auth_info_name" name="authentications[{{$key}}][name]" type="text" value="{{ $auth_info->name }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-12 col-md-3 col-lg-3">
                                <label>Ảnh xác minh</label>
                                <div class="custom-file">
                                    <input data-id="{{ $auth_info->id }}" type="file" auth-info class="custom-file-input" name="authentications[{{$key}}][img]" value="{{ $auth_info->img }}" id="auth_info_img">
                                    <label class="custom-file-label"  for="auth_info_img">Choose file</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-3 col-lg-3">
                                <div class="auth-info-img" >
                                    <img class="img-rounded" id="preview-auth-info"
                                         src="{{asset($auth_info->img ? 'storage/'. $auth_info->img : '')}}" alt="User Auth-info">
                                </div>
                            </div>
                            <div class="col-12 col-md-2 col-lg-1">
                                <label class="d-md-block d-sm-none d-none">&nbsp;</label>
                                <a href="#" onclick="deleteAuthInfo('{{ $auth_info->id }}')" class="btn btn-danger trash _delete_auth_info_action">
                                    <i class="far fa-trash-alt"></i>
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="row form-row auth-cont">
                            <div class="col-12 col-md-4 col-lg-4 show-errors-block" >
                                <div class="form-group">
                                    <label for="auth_info_name">Loại giấy tờ</label>
                                    <input type="text" id="auth_info_name" name="authentications[0][name]" class="form-control">
                                </div>
                            </div>
                            <div class="col-12 col-md-3 col-lg-3">
                                <label>Ảnh xác minh</label>
                                <div class="custom-file">
                                    <input  type="file" auth-info name="authentications[0][img]" class="custom-file-input" id="auth_info_img">
                                    <label class="custom-file-label" for="auth_info_img">Choose file</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-3 col-lg-3">
                                <div class="auth-info-img" >
                                    <img class="img-rounded" id="preview-auth-info"
                                         src="{{asset('img/tutors/auth-info/auth-default.png')}}"  alt="User auth info">
                                </div>
                            </div>
                            <div class="col-12 col-md-2 col-lg-1">
                                <label class="d-md-block d-sm-none d-none">&nbsp;</label>
                                <a href="#" class="btn btn-danger trash">
                                    <i class="far fa-trash-alt"></i>
                                </a>
                            </div>
                        </div>
                    @endforelse
                </div>
                <div class="add-more">
                    <a href="javascript:void(0);" class="add-auth-info"><i class="fa fa-plus-circle"></i> Add More</a>
                </div>
            </div>
        </div>
        <!-- /Authentications -->

        <div class="submit-section submit-btn-bottom">
            <button type="submit" class="btn btn-primary submit-btn">Lưu thay đổi</button>
        </div>
        </form>
    </div>
@endsection
