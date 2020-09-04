<?php /** @var \App\User $users */ ?>
@section('bottom.js')
    <script src="{{ asset('js/dialog-box.js') }}"></script>
    <script src="{{ asset('js/student/profile.js') }}"></script>
@endsection

@extends('layouts.app')

@section('content')
{{--    @dd($users)--}}
    <!-- Breadcrumb -->
    <div class="breadcrumb-bar">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-8 col-12">
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Tìm kiếm gia sư</li>
                        </ol>
                    </nav>
                    <h2 class="breadcrumb-title">{{$count ?? ''}} kết quả cho : {{$filterString ?? ''}} {{ $speciality->name ?? '' }}</h2>
                </div>
                <div class="col-md-4 col-12 d-md-block d-none">
                    <div class="sort-by">
                        <span class="sort-title">Sắp Xếp Theo</span>
                        <span class="sortby-fliter">
									<select class="select">
										<option>Chọn</option>
										<option class="sorting">Xếp hạng</option>
										<option class="sorting">Phổ biến</option>
										<option class="sorting">Mới nhất</option>
										<option class="sorting">Học phí</option>
									</select>
                    </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Breadcrumb -->

    <!-- Page Content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12 col-lg-4 col-xl-3 theiaStickySidebar">

                    <form action="{{ route('tutor.searchFilter') }}" method="post" id="form" enctype="multipart/form-data">
                    @csrf
                    <!-- Search Filter -->
                    <div class="card search-filter">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Tìm kiếm theo bộ lọc</h4>
                        </div>
                        <div class="card-body">
                            <!-- cate level1  -->
                            <div class="filter-widget">
                                <h4 class="choose">Chọn môn học</h4>
                                    <div class="form-group">
                                        <select name="subject" id="subject" class="form-control select">
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
                            <!--  -->
                            <!-- cate level1  -->
                            <div class="filter-widget">
                                <h4 class="choose">Chọn thành phố</h4>
                                <div class="form-group">
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
                            <!--  -->
                            <!-- cate level1  -->
                            <div class="filter-widget">
                                <h4 class="choose">Chọn quận huyện</h4>
                                <div class="form-group">
                                    <select  name="district" id="district" class="form-control select">
                                    </select>
                                    @error('district')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <!--  -->

                            <!-- cate level1  -->
                            <div class="filter-widget">
                                <h4 class="choose">Giới tính gia sư</h4>
                                <div class="form-group" >
                                    <div id="type-of-tutor">
                                        <div class="custom-control custom-checkbox custom-control-inline">
                                            <input name="tutor_gender[male]" value="1" type="checkbox" class="custom-control-input checkbox" id="male-tutor" >
                                            <label class="custom-control-label" for="male-tutor">Nam</label>
                                        </div>
                                        <div class="custom-control custom-checkbox custom-control-inline">
                                            <input name="tutor_gender[female]" value="1" type="checkbox" class="custom-control-input checkbox"  id="female-tutor" >
                                            <label class="custom-control-label" for="female-tutor">Nữ</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--  -->

                            <!-- cate level1  -->
                            <div class="filter-widget">
                                <h4 class="choose">Kiểu gia sư</h4>
                                <div class="form-group" >
                                    <div id="type-of-tutor">
                                        <div class="custom-control custom-checkbox custom-control-inline">
                                            <input name="type_of_tutor[student]" value="0" type="checkbox" class="custom-control-input checkbox" id="sinhvien">
                                            <label class="custom-control-label" for="sinhvien">Sinh viên</label>
                                        </div>
                                        <div class="custom-control custom-checkbox custom-control-inline">
                                            <input name="type_of_tutor[teacher]" value="1" type="checkbox" class="custom-control-input checkbox"  id="giaovien">
                                            <label class="custom-control-label" for="giaovien">Giáo viên</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--  -->
                            <div class="col-md-6">

                            </div>
                            <div class="btn-search mt-3">
                                <button type="submit" class="btn btn-block">Tìm</button>
                            </div>
                        </div>
                    </div>
                    <!-- /Search Filter -->
                    </form>

                </div>

                <div class="col-md-12 col-lg-8 col-xl-9">
{{--    @dd($tutors)--}}
                    <div class="row justify-content-center">
                        @forelse($tutors as $tutor)
{{--                            @dd($tutor->user->name)--}}
                        <!-- Tutor Widget -->
                        <div class="col-xl-6 col-lg-10 col-md-11">
                            <div class="card">
                                <div class="card-body">
                                    <div class="doctor-widget">
                                        <div class="doc-info-left">
                                            <div class="doctor-img">
                                                <a href="{{route('tutor-profile',$tutor->id)}}">
                                                    <img src="{{asset($tutor->user->avatar ? 'storage/'. $tutor->user->avatar : ($tutor->user->gender == 1 ? 'img/tutors/avatars/default-boy.png':'img/tutors/avatars/default-girl.png' ))}}" class="img-fluid" alt="Tutor Image">
                                                </a>
                                            </div>
                                            <div class="doc-info-cont">
                                                <h4 class="doc-name" tutor-data="{{$tutor->id}}"><a href="{{route('tutor-profile',$tutor->id)}}">{{ $tutor->user->name }}</a></h4>
                                                <h5 class="doc-department"><img src="{{asset($tutor->user->avatar ? 'storage/'. $tutor->user->avatar : ($tutor->user->gender == 1 ? 'img/tutors/avatars/default-boy.png':'img/tutors/avatars/default-girl.png' ))}}" class="img-fluid" alt="Speciality">
                                                    {{$tutor->type_of_tutor == 0 ? 'Sinh viên' : 'Giáo viên'}}
                                                </h5>
                                                <div class="rating">
                                                    <i class="fas fa-star filled"></i>
                                                    <i class="fas fa-star filled"></i>
                                                    <i class="fas fa-star filled"></i>
                                                    <i class="fas fa-star filled"></i>
                                                    <i class="fas fa-star"></i>
                                                    <span class="d-inline-block average-rating">(17)</span>
                                                </div>


                                            </div>
                                        </div>
                                        <div class="doc-info-right">
                                            <div class="clini-infos">
                                                <ul>
                                                    <li><i class="far fa-thumbs-up"></i> 98%</li>
                                                    <li><i class="far fa-comment"></i> 17 Feedback</li>
                                                    <li><i class="fas fa-map-marker-alt"></i>{{$tutor->user->district->name ?? ''}}, {{$tutor->user->city->name ?? ''}}</li>
                                                    <li><i class="far fa-money-bill-alt"></i>{{$tutor->tuition_fee}} VND</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tutor-desc mt-3">
                                        <div class="clinic-services">
                                            @foreach($tutor->subjects as $subject)
                                                <span>{{$subject->name}}</span>
                                            @endforeach
                                        </div>
                                        <p class="">{{$tutor->introduction ?? ''}}</p>
                                        <div class="clinic-booking-small text-right">
                                            <a class="btn btn-block btn-outline-primary" href="{{route('tutor-profile',$tutor->id)}}">Xem thông tin</a>
                                            <a href="javascript:void(0)" class="btn book-btn" data-toggle="modal" data-target="#book-tutor">Mời dạy</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Tutor Widget -->
                            @empty
                            <p>Xin lỗi bạn, tạm thời chưa có gia sư nào phù hợp với yêu cầu rồi!</p>
                            @endforelse
                    </div>

{{--                    <div class="load-more text-center">--}}
{{--                        <a class="btn btn-primary btn-sm" href="javascript:void(0);">Load More</a>--}}
{{--                    </div>--}}
                </div>
            </div>

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
