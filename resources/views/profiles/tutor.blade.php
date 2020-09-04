@section('bottom.js')
    <script src="{{ asset('js/dialog-box.js') }}"></script>
@endsection

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
                            <li class="breadcrumb-item active" aria-current="page">Gia sư</li>
                        </ol>
                    </nav>
                    <h2 class="breadcrumb-title">Thông tin gia sư</h2>
                </div>
            </div>
        </div>
    </div>
    <!-- /Breadcrumb -->

    <!-- Page Content -->
    <div class="content">
        <div class="container">

            <!-- Doctor Widget -->
            <div class="card">
                <div class="card-body">
                    <div class="doctor-widget">
                        <div class="doc-info-left">
                            <div class="doctor-img">
                                <img class="img-fluid" src="{{asset($tutor->user->avatar ? 'storage/'. $tutor->user->avatar : ($tutor->user->gender == 1 ? 'img/tutors/avatars/default-boy.png':'img/tutors/avatars/default-girl.png' ))}}" alt="User Image">
                            </div>
                            <div class="doc-info-cont">
                                <h4 class="doc-name" tutor-data="{{$tutor->id}}">{{$tutor->user->name}}</h4>
                                    <?php
                                    foreach ($tutor->subjects as $subject) {
                                        $subjectArray[] = $subject->name;
                                        }
                                    ?>
                                <p class="doc-speciality">Gia sư {{isset($subjectArray) ? implode(", ",$subjectArray) : ''}}</p>
                                <p class="doc-department"><img src="{{asset('img/specialities/teacher.png')}}" class="img-fluid" alt="Speciality">{{$tutor->type_of_tutor == 0 ? 'Sinh viên' : 'Giáo viên'}}</p>
                                <div class="rating">
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star"></i>
                                    <span class="d-inline-block average-rating">(35)</span>
                                </div>
                                <div class="clinic-services">
                                    @foreach($tutor->subjects as $subject)
                                        <span>{{$subject->name}}</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="doc-info-right">
                            <div class="clini-infos">
                                <ul>
                                    <li><i class="far fa-thumbs-up"></i> 99%</li>
                                    <li><i class="far fa-comment"></i> 35 Đánh giá</li>
                                    <li><i class="fas fa-map-marker-alt"></i> {{$tutor->user->district->name ?? ''}}, {{$tutor->user->city->name ?? ''}}</li>
                                    <li><i class="far fa-money-bill-alt"></i> {{$tutor->tuition_fee}} VND / giờ </li>
                                </ul>
                            </div>
                            <div class="doctor-action">
                                <a href="javascript:void(0)" class="btn btn-white fav-btn">
                                    <i class="far fa-bookmark"></i>
                                </a>
                                <a href="chat.html" class="btn btn-white msg-btn">
                                    <i class="far fa-comment-alt"></i>
                                </a>
                                <a href="javascript:void(0)" class="btn btn-white call-btn" data-toggle="modal" data-target="#voice_call">
                                    <i class="fas fa-phone"></i>
                                </a>
                                <a href="javascript:void(0)" class="btn btn-white call-btn" data-toggle="modal" data-target="#video_call">
                                    <i class="fas fa-video"></i>
                                </a>
                            </div>
                            <div class="clinic-booking">
                                <a href="javascript:void(0)" class="btn apt-btn book-btn" data-toggle="modal" data-target="#book-tutor">Mời dạy</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- /Doctor Widget -->

            <!-- Doctor Details Tab -->
            <div class="card">
                <div class="card-body pt-0">

                    <!-- Tab Menu -->
                    <nav class="user-tabs mb-4">
                        <ul class="nav nav-tabs nav-tabs-bottom nav-justified">
                            <li class="nav-item">
                                <a class="nav-link active" href="#doc_overview" data-toggle="tab">Tổng quan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#doc_locations" data-toggle="tab">Vị trí</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#doc_reviews" data-toggle="tab">Đánh giá</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#doc_business_hours" data-toggle="tab">Thời gian dạy</a>
                            </li>
                        </ul>
                    </nav>
                    <!-- /Tab Menu -->

                    <!-- Tab Content -->
                    <div class="tab-content pt-0">

                        <!-- Overview Content -->
                        <div role="tabpanel" id="doc_overview" class="tab-pane fade show active">
                            <div class="row">
                                <div class="col-md-12 col-lg-9">

                                    <!-- About Details -->
                                    <div class="widget about-widget">
                                        <h4 class="widget-title">Giới thiệu bản thân</h4>
                                        <p>{{$tutor->introduction}}</p>
                                    </div>
                                    <!-- /About Details -->

                                    <!-- Education Details -->
                                    <div class="widget education-widget">
                                        <h4 class="widget-title">Học vấn</h4>
                                        <div class="experience-box">
                                            <ul class="experience-list">
                                                @foreach($tutor->educations as $edu)
                                                <li>
                                                    <div class="experience-user">
                                                        <div class="before-circle"></div>
                                                    </div>
                                                    <div class="experience-content">
                                                        <div class="timeline-content">
                                                            <a href="#/" class="name">{{$edu->college}}</a>
                                                            <div>
                                                                @switch($edu->degree)
                                                                    @case(1)
                                                                        Cao học
                                                                        @break
                                                                    @case(2)
                                                                        Đại học
                                                                        @break
                                                                    @case(3)
                                                                        Cao đẳng
                                                                        @break
                                                                    @case(4)
                                                                        Khác
                                                                        @break
                                                                @endswitch
                                                            </div>
                                                            <span class="time">{{$edu->graduate_year}}</span>
                                                        </div>
                                                    </div>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- /Education Details -->

                                    <!-- Experience Details -->
                                    <div class="widget experience-widget">
                                        <h4 class="widget-title">Kinh nghiệm giảng dạy và làm việc</h4>
                                        <div class="experience-box">
                                            <ul class="experience-list">
                                                @foreach($tutor->experiences as $exp)
                                                <li>
                                                    <div class="experience-user">
                                                        <div class="before-circle"></div>
                                                    </div>
                                                    <div class="experience-content">
                                                        <div class="timeline-content">
                                                            <a href="#/" class="name">{{$exp->description}}</a>
                                                            <span class="time">{{date('d/m/Y', strtotime($exp->start_time))}} - {{date('d/m/Y', strtotime($exp->end_time))}}</span>
                                                        </div>
                                                    </div>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- /Experience Details -->

                                    <!-- Certificates Details -->
                                    <div class="widget awards-widget">
                                        <h4 class="widget-title">Chứng chỉ</h4>
                                        <div class="experience-box">
                                            <ul class="experience-list">
                                                @foreach($tutor->certificates as $cert)
                                                <li>
                                                    <div class="experience-user">
                                                        <div class="before-circle"></div>
                                                    </div>
                                                    <div class="experience-content">
                                                        <div class="timeline-content">
                                                            <p class="exp-year">{{$cert->year_granted}}</p>
                                                            <h4 class="exp-title">{{$cert->name}}</h4>
                                                            <p>Issued by <strong>{{$cert->issued_by}}</strong> </p>
                                                        </div>
                                                    </div>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- /Awards Details -->

                                    <!-- Services List -->
                                    <div class="service-list">
                                        <h4>Môn học</h4>
                                        <ul class="clearfix">
                                            @foreach($tutor->subjects as $subject)
                                                <li>{{$subject->name}}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <!-- /Services List -->
                                    <!-- Specializations List -->
                                    <div class="service-list">
                                        <h4>Chuyên môn</h4>
                                        <ul class="clearfix">
                                            @foreach($tutor->getSpecialities() as $spc)
                                                <li>{{$spc->name}}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <!-- /Specializations List -->
                                </div>
                            </div>
                        </div>
                        <!-- /Overview Content -->

                        <!-- Locations Content -->
                        <div role="tabpanel" id="doc_locations" class="tab-pane fade">

                            <!-- Location List -->
                            <!-- Certificates Details -->
                            <div class="widget awards-widget">
                                <h4 class="widget-title">Địa chỉ:</h4>
                                <p><?php echo e($tutor->user->district->name ?? ''); ?>, <?php echo e($tutor->user->city->name ?? ''); ?></p>
                            </div>
                            <!-- /Awards Details -->
                            <!-- /Location List -->

                        </div>
                        <!-- /Locations Content -->

                        <!-- Reviews Content -->
                        <div role="tabpanel" id="doc_reviews" class="tab-pane fade">

                            <!-- Review Listing -->
                            <div class="widget review-listing">
                                <ul class="comments-list">

                                    <!-- Comment List -->
                                    <li>
                                        <div class="comment">
                                            <img class="avatar avatar-sm rounded-circle" alt="User Image" src="<?php echo e(asset('img/tutors/avatars/default-girl.png' )); ?>">
                                            <div class="comment-body">
                                                <div class="meta-data">
                                                    <span class="comment-author">Bùi Đan Linh</span>
                                                    <span class="comment-date">Đánh giá 2 ngày trước</span>
                                                    <div class="review-count rating">
                                                        <i class="fas fa-star filled"></i>
                                                        <i class="fas fa-star filled"></i>
                                                        <i class="fas fa-star filled"></i>
                                                        <i class="fas fa-star filled"></i>
                                                        <i class="fas fa-star"></i>
                                                    </div>
                                                </div>
                                                <p class="recommended"><i class="far fa-thumbs-up"></i> Gia sư này rất tốt</p>
                                                <p class="comment-content">
                                                    Mình đã học qua gia sư này đc một năm, anh dạy rất tâm huyết, kiến thức sâu rộng,
                                                    lại dạy rất dễ hiểu nữa, đi dạy luôn đúng giờ và chữa bài rất kỹ
                                                </p>
                                                <div class="comment-reply">
                                                    <a class="comment-btn" href="#">
                                                        <i class="fas fa-reply"></i> Trả lời
                                                    </a>
                                                    <p class="recommend-btn">
                                                        <span>Recommend?</span>
                                                        <a href="#" class="like-btn">
                                                            <i class="far fa-thumbs-up"></i> Có
                                                        </a>
                                                        <a href="#" class="dislike-btn">
                                                            <i class="far fa-thumbs-down"></i> Không
                                                        </a>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Comment Reply -->
                                        <ul class="comments-reply">
                                            <li>
                                                <div class="comment">
                                                    <img class="avatar avatar-sm rounded-circle" alt="User Image" src="<?php echo e(asset('img/tutors/avatars/default-girl.png' )); ?>">
                                                    <div class="comment-body">
                                                        <div class="meta-data">
                                                            <span class="comment-author">Nguyễn Thu Phương</span>
                                                            <span class="comment-date">Đánh giá 3 ngày trước</span>
                                                            <div class="review-count rating">
                                                                <i class="fas fa-star filled"></i>
                                                                <i class="fas fa-star filled"></i>
                                                                <i class="fas fa-star filled"></i>
                                                                <i class="fas fa-star filled"></i>
                                                                <i class="fas fa-star"></i>
                                                            </div>
                                                        </div>
                                                        <p class="comment-content">
                                                            Ừ mình cũng thấy vậy, năm ngoái mình có học anh này 1 khóa, và sau 6 tháng trình độ của mình
                                                            đã tăng lên rất nhiều, cảm thấy may mắn khi được học anh
                                                        </p>
                                                        <div class="comment-reply">
                                                            <a class="comment-btn" href="#">
                                                                <i class="fas fa-reply"></i> Trả lời
                                                            </a>
                                                            <p class="recommend-btn">
                                                                <span>Recommend?</span>
                                                                <a href="#" class="like-btn">
                                                                    <i class="far fa-thumbs-up"></i> Có
                                                                </a>
                                                                <a href="#" class="dislike-btn">
                                                                    <i class="far fa-thumbs-down"></i> Không
                                                                </a>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                        <!-- /Comment Reply -->

                                    </li>
                                    <!-- /Comment List -->

                                    <!-- Comment List -->
                                    <li>
                                        <div class="comment">
                                            <img class="avatar avatar-sm rounded-circle" alt="User Image" src="<?php echo e(asset('img/tutors/avatars/default-boy.png' )); ?>">
                                            <div class="comment-body">
                                                <div class="meta-data">
                                                    <span class="comment-author">Nguyễn Tùng Dương</span>
                                                    <span class="comment-date">Đánh giá 4 ngày trước</span>
                                                    <div class="review-count rating">
                                                        <i class="fas fa-star filled"></i>
                                                        <i class="fas fa-star filled"></i>
                                                        <i class="fas fa-star filled"></i>
                                                        <i class="fas fa-star filled"></i>
                                                        <i class="fas fa-star"></i>
                                                    </div>
                                                </div>
                                                <p class="comment-content">
                                                    Mình cũng đã học qua gia sư này đc hai năm, anh dạy rất nhiệt tình, kiến thức sâu rộng,
                                                    lại dạy rất dễ hiểu nữa, khuyến khích mọi người nên học anh này nha
                                                </p>
                                                <div class="comment-reply">
                                                    <a class="comment-btn" href="#">
                                                        <i class="fas fa-reply"></i> Trả lời
                                                    </a>
                                                    <p class="recommend-btn">
                                                        <span>Recommend?</span>
                                                        <a href="#" class="like-btn">
                                                            <i class="far fa-thumbs-up"></i> Có
                                                        </a>
                                                        <a href="#" class="dislike-btn">
                                                            <i class="far fa-thumbs-down"></i> Không
                                                        </a>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <!-- /Comment List -->

                                </ul>

                                <!-- Show All -->
                                <div class="all-feedback text-center">
                                    <a href="#" class="btn btn-primary btn-sm">
                                        Hiển thị toàn bộ đánh giá <strong>(167)</strong>
                                    </a>
                                </div>
                                <!-- /Show All -->

                            </div>
                            <!-- /Review Listing -->

                            <!-- Write Review -->
                            <div class="write-review">
                                <h4>Viết đánh giá cho gia sư <strong>{{ $tutor->user->name }}</strong></h4>

                                <!-- Write Review Form -->
                                <form>
                                    <div class="form-group">
                                        <label>Đánh giá</label>
                                        <div class="star-rating">
                                            <input id="star-5" type="radio" name="rating" value="star-5">
                                            <label for="star-5" title="5 stars">
                                                <i class="active fa fa-star"></i>
                                            </label>
                                            <input id="star-4" type="radio" name="rating" value="star-4">
                                            <label for="star-4" title="4 stars">
                                                <i class="active fa fa-star"></i>
                                            </label>
                                            <input id="star-3" type="radio" name="rating" value="star-3">
                                            <label for="star-3" title="3 stars">
                                                <i class="active fa fa-star"></i>
                                            </label>
                                            <input id="star-2" type="radio" name="rating" value="star-2">
                                            <label for="star-2" title="2 stars">
                                                <i class="active fa fa-star"></i>
                                            </label>
                                            <input id="star-1" type="radio" name="rating" value="star-1">
                                            <label for="star-1" title="1 star">
                                                <i class="active fa fa-star"></i>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Tiêu đề đánh giá</label>
                                        <input class="form-control" type="text" placeholder="Bạn cảm thấy gia sư này có tốt không?">
                                    </div>
                                    <div class="form-group">
                                        <label>Nội dung</label>
                                        <textarea id="review_desc" maxlength="100" class="form-control"></textarea>

                                        <div class="d-flex justify-content-between mt-3"><small class="text-muted">còn lại <span id="chars">100</span> từ </small></div>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <div class="terms-accept">
                                            <div class="custom-checkbox">
                                                <input type="checkbox" id="terms_accept">
                                                <label for="terms_accept">Tôi xin đồng ý với <a href="#">điều khoản</a> và cam kết đánh giá này là chính xác </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="submit-section">
                                        <button type="submit" class="btn btn-primary submit-btn">Gửi đánh giá</button>
                                    </div>
                                </form>
                                <!-- /Write Review Form -->

                            </div>
                            <!-- /Write Review -->

                        </div>
                        <!-- /Reviews Content -->

                        <!-- Business Hours Content -->
                        <div role="tabpanel" id="doc_business_hours" class="tab-pane fade">
                            <div class="row">
                                <div class="col-md-11 offset-md-1">

                                    <!-- Business Hours Widget -->
                                    <div class="widget">
                                        <div class="widget-content">
                                            <div class="form-group">
                                                <div class="weekday-calendar schedule view-only">
                                                    <div class="day-of-week mon">
                                                        <button type="button" value="mon" class="btn btn-secondary">Thứ 2</button>
                                                        <ul class="custom-checkbox">
                                                            <li>
                                                                <input name="schedule[mon][]" type="checkbox" id="morning-2" value="morning"
                                                                    {{$tutor->schedule !== null && $tutor->schedule->checkSchedule('mon','morning')==true ? 'checked' : ''}}>
                                                                <label for="morning-2">Sáng</label>
                                                            </li>
                                                            <li>
                                                                <input name="schedule[mon][]" type="checkbox" id="afternoon-2" value="afternoon"
                                                                    {{$tutor->schedule !== null && $tutor->schedule->checkSchedule('mon','afternoon')==true ? 'checked' : ''}}>
                                                                <label for="afternoon-2">Chiều</label></li>
                                                            <li>
                                                                <input name="schedule[mon][]" type="checkbox" id="evening-2" value="evening"
                                                                    {{$tutor->schedule !== null && $tutor->schedule->checkSchedule('mon','evening')==true ? 'checked' : ''}}>
                                                                <label for="evening-2">Tối</label></li>
                                                        </ul>
                                                    </div>
                                                    <div class="day-of-week tue">
                                                        <button type="button" value="tue" class="btn btn-secondary">Thứ 3</button>
                                                        <ul class="custom-checkbox">
                                                            <li>
                                                                <input name="schedule[tue][]" type="checkbox" id="morning-3" value="morning"
                                                                    {{$tutor->schedule !== null && $tutor->schedule->checkSchedule('tue','morning')==true ? 'checked' : ''}}>
                                                                <label for="morning-3">Sáng</label></li>
                                                            <li>
                                                                <input name="schedule[tue][]" type="checkbox" id="afternoon-3" value="afternoon"
                                                                    {{$tutor->schedule !== null && $tutor->schedule->checkSchedule('tue','afternoon')==true ? 'checked' : ''}}>
                                                                <label for="afternoon-3">Chiều</label></li>
                                                            <li>
                                                                <input name="schedule[tue][]" type="checkbox" id="evening-3" value="evening"
                                                                    {{$tutor->schedule !== null && $tutor->schedule->checkSchedule('tue','evening')==true ? 'checked' : ''}}>
                                                                <label for="evening-3">Tối</label></li>
                                                        </ul>
                                                    </div>
                                                    <div class="day-of-week wed">
                                                        <button type="button" value="wed" class="btn btn-secondary">Thứ 4</button>
                                                        <ul class="custom-checkbox">
                                                            <li>
                                                                <input name="schedule[wed][]" type="checkbox" id="morning-4" value="morning"
                                                                    {{$tutor->schedule !== null && $tutor->schedule->checkSchedule('wed','morning')==true ? 'checked' : ''}}>
                                                                <label for="morning-4">Sáng</label></li>
                                                            <li>
                                                                <input name="schedule[wed][]" type="checkbox" id="afternoon-4" value="afternoon"
                                                                    {{$tutor->schedule !== null && $tutor->schedule->checkSchedule('wed','afternoon')==true ? 'checked' : ''}}>
                                                                <label for="afternoon-4">Chiều</label></li>
                                                            <li>
                                                                <input name="schedule[wed][]" type="checkbox" id="evening-4" value="evening"
                                                                    {{$tutor->schedule !== null && $tutor->schedule->checkSchedule('wed','evening')==true ? 'checked' : ''}}>
                                                                <label for="evening-4">Tối</label></li>
                                                        </ul>
                                                    </div>
                                                    <div class="day-of-week thur">
                                                        <button type="button" value="thur" class="btn btn-secondary">Thứ 5</button>
                                                        <ul class="custom-checkbox">
                                                            <li>
                                                                <input name="schedule[thur][]" type="checkbox" id="morning-5" value="morning"
                                                                    {{$tutor->schedule !== null && $tutor->schedule->checkSchedule('thur','morning')==true ? 'checked' : ''}}>
                                                                <label for="morning-5">Sáng</label></li>
                                                            <li>
                                                                <input name="schedule[thur][]" type="checkbox" id="afternoon-5" value="afternoon"
                                                                    {{$tutor->schedule !== null && $tutor->schedule->checkSchedule('thur','afternoon')==true ? 'checked' : ''}}>
                                                                <label for="afternoon-5">Chiều</label></li>
                                                            <li>
                                                                <input name="schedule[thur][]" type="checkbox" id="evening-5" value="evening"
                                                                    {{$tutor->schedule !== null && $tutor->schedule->checkSchedule('thur','evening')==true ? 'checked' : ''}}>
                                                                <label for="evening-5">Tối</label></li>
                                                        </ul>
                                                    </div>
                                                    <div class="day-of-week fri">
                                                        <button type="button" value="fri" class="btn btn-secondary">Thứ 6</button>
                                                        <ul class="custom-checkbox">
                                                            <li>
                                                                <input name="schedule[fri][]" type="checkbox" id="morning-6" value="morning"
                                                                    {{$tutor->schedule !== null && $tutor->schedule->checkSchedule('fri','morning')==true ? 'checked' : ''}}>
                                                                <label for="morning-6">Sáng</label></li>
                                                            <li>
                                                                <input name="schedule[fri][]" type="checkbox" id="afternoon-6" value="afternoon"
                                                                    {{$tutor->schedule !== null && $tutor->schedule->checkSchedule('fri','afternoon')==true ? 'checked' : ''}}>
                                                                <label for="afternoon-6">Chiều</label></li>
                                                            <li>
                                                                <input name="schedule[fri][]" type="checkbox" id="evening-6" value="evening"
                                                                    {{$tutor->schedule !== null && $tutor->schedule->checkSchedule('fri','evening')==true ? 'checked' : ''}}>
                                                                <label for="evening-6">Tối</label></li>
                                                        </ul>
                                                    </div>
                                                    <div class="day-of-week sat">
                                                        <button type="button" value="sat" class="btn btn-secondary">Thứ 7</button>
                                                        <ul class="custom-checkbox">
                                                            <li>
                                                                <input name="schedule[sat][]" type="checkbox" id="morning-7" value="morning"
                                                                    {{$tutor->schedule !== null && $tutor->schedule->checkSchedule('sat','morning')==true ? 'checked' : ''}}>
                                                                <label for="morning-7">Sáng</label></li>
                                                            <li>
                                                                <input name="schedule[sat][]" type="checkbox" id="afternoon-7" value="afternoon"
                                                                    {{$tutor->schedule !== null && $tutor->schedule->checkSchedule('sat','afternoon')==true ? 'checked' : ''}}>
                                                                <label for="afternoon-7">Chiều</label></li>
                                                            <li>
                                                                <input name="schedule[sat][]" type="checkbox" id="evening-7" value="evening"
                                                                    {{$tutor->schedule !== null && $tutor->schedule->checkSchedule('sat','evening')==true ? 'checked' : ''}}>
                                                                <label for="evening-7">Tối</label></li>
                                                        </ul>
                                                    </div>
                                                    <div class="day-of-week sun">
                                                        <button type="button" value="sun" class="btn btn-secondary">Chủ Nhật</button>
                                                        <ul class="custom-checkbox">
                                                            <li>
                                                                <input name="schedule[sun][]" type="checkbox" id="morning-8" value="morning"
                                                                    {{$tutor->schedule !== null && $tutor->schedule->checkSchedule('sun','morning')==true ? 'checked' : ''}}>
                                                                <label for="morning-8">Sáng</label></li>
                                                            <li>
                                                                <input name="schedule[sun][]" type="checkbox" id="afternoon-8" value="afternoon"
                                                                    {{$tutor->schedule !== null && $tutor->schedule->checkSchedule('sun','afternoon')==true ? 'checked' : ''}}>
                                                                <label for="afternoon-8">Chiều</label></li>
                                                            <li>
                                                                <input name="schedule[sun][]" type="checkbox" id="evening-8" value="evening"
                                                                    {{$tutor->schedule !== null && $tutor->schedule->checkSchedule('sun','evening')==true ? 'checked' : ''}}>
                                                                <label for="evening-8">Tối</label></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <i class="js-errors" style="display: none"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /Business Hours Widget -->

                                </div>
                            </div>
                        </div>
                        <!-- /Business Hours Content -->

                    </div>
                </div>
            </div>
            <!-- /Doctor Details Tab -->

        </div>
    </div>
    <!-- /Page Content -->

@endsection





@section('call-modal')
    <!-- Book tutor Modal -->
    <div class="modal fade call-modal" id="book-tutor">
        <div class="modal-dialog booking-modal modal-dialog-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">

                    <div student-data="{{auth()->user()->id ?? 0}}" class="card modal-content" id="booking-modal">
                        <div class="card-header d-inline-flex justify-content-between">
                            <h4 class="card-title d-inline-block mr-2">Book Gia Sư:</h4>
                            <div>
                                <span class="avatar avatar-sm">
                                    <img id="tutor-book-img" class="avatar-img rounded-circle" alt="User Image" src="">
                                </span>
                                <h5 tutor-data="" id="tutor-book-name" class="d-inline-block">Hoang Manh Dung</h5>
                            </div>
                        </div>
                        <div id="message-box"></div>
                        <div id="choose-request">
                            <h5 class="mt-3 mb-1">Chọn yêu cầu học mà bạn muốn mời giáo viên này dạy</h5>
                            <div class="card-body border">
                                <div class="mt-3 request-cont">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-right"><a href="javascript:void(0);" class="btn btn-secondary btn-exit" data-dismiss="modal" aria-label="Close">Thoát</a></div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Booking Modal -->

@endsection
@section('booking-modal-css')
    <style rel="stylesheet" type="text/css">

        .modal.fade .modal-dialog.booking-modal {
            transition: transform 0.1s ease-out !important;
            transform: translate(0, -50px);
        }
        .modal-backdrop.show {
            opacity: 0.4;
            -webkit-transition-duration: 100ms !important;
            transition-duration: 100ms !important;
        }
    </style>
@endsection
