<?php /** @var \App\User $users */ ?>
@section('bottom.js')
    <script src="{{ asset('js/student/profile.js') }}"></script>
@endsection
@extends('layouts.app')

@section('content')

{{--        @dd(1)--}}
    <!-- Breadcrumb -->
    <div class="breadcrumb-bar">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-8 col-12">
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index-2.html">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Search</li>
                        </ol>
                    </nav>
                    <h2 class="breadcrumb-title">{{$count ?? ''}} kết quả cho : {{$filterString ?? ''}}</h2>
                </div>
                <div class="col-md-4 col-12 d-md-block d-none">
                    <div class="sort-by">
                        <span class="sort-title">Sắp Xếp Theo</span>
                        <span class="sortby-fliter">
									<select class="select">
										<option>Select</option>
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

                    <form action="{{ route('request.filter') }}" method="post" id="form" enctype="multipart/form-data">
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

                                <div class="btn-search mt-3">
                                    <button type="submit" class="btn btn-block">Tìm</button>
                                </div>
                            </div>
                        </div>
                        <!-- /Search Filter -->
                    </form>

                </div>

                <div class="col-md-12 col-lg-8 col-xl-9">

                    <div class="row justify-content-center">
                        <div class="col-md-12 col-lg-12 col-xl-12">
                            <!-- Appointment Tab -->
                            <div id="pat_appointments" class="tab-pane fade show active">
                                <div class="card card-table mb-0">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover table-center mb-0">
                                                <thead>
                                                <tr>
                                                    <th>Người đăng</th>
                                                    <th>Nội dung lớp học</th>
                                                    <th>Ngày đăng</th>
                                                    <th>Học phí</th>
                                                    <th>Địa chỉ</th>
                                                    <th>Trạng thái</th>
                                                    <th></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @forelse($requests as $request)
                                                    <tr class="clickable-row" data-href="{{route('request.detail', $request)}}">
                                                        <td>
                                                            <h2 class="table-avatar">
                                                                <a href="{{route('students.viewProfile',$request->student)}}" class="avatar avatar-sm mr-2">
                                                                    <img id="preview-avatar"
                                                                         src="{{asset($request->student->user->avatar ? 'storage/'. $request->student->user->avatar : ($request->student->user->gender == 1 ? 'img/tutors/avatars/default-boy.png':'img/tutors/avatars/default-girl.png' ))}}" alt="User Avatar">
                                                                </a>
                                                                <a href="{{route('students.viewProfile',$request->student)}}">{{$request->student->user->name}}</a>
                                                            </h2>
                                                        </td>
                                                        <td> {{$request->short_description}}</td>
                                                        <td>{{date('d/m/Y', strtotime($request->created_at))}}</td>
                                                        <td>{{$request->expect_fee}} VND</td>
                                                        <td>{{$request->city->name ?? 'Học online'}}</td>
                                                        <td>
                                                            @if($request->status===0)
                                                                <span class="badge badge-pill bg-info-light">Đang tìm</span>
                                                            @endif
                                                                @if($request->status===2)
                                                                    <span class="badge badge-pill bg-warning-light">Đấu giá</span>
                                                                @endif
                                                                @if($request->status===3)
                                                                    <span class="badge badge-pill bg-success-light">Đã tìm thấy</span>
                                                                @endif
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="6">Xin lỗi, hiện tại chưa có yêu cầu tìm gia sư như bạn mong muốn, bạn có thể tìm theo bộ lọc khác nhé!</td>
                                                    </tr>
                                                @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /Appointment Tab -->
                        </div>


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
