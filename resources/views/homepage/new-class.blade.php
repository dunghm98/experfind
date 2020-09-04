<!-- New classes -->
<section class="section section-doctor">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-5 col-lg-4 col-xl-3">
                <div class="section-header ">
                    <h2>Lớp mới đang tìm gia sư</h2>
                    <p>Các yêu cầu tìm gia sư của học sinh được cập nhật liên tục </p>
                </div>
                <div class="about-content">
                    <p>Bạn là sinh viên hoặc giáo viên có trình độ chuyên môn tốt? Bạn muốn kiếm thêm thu nhập trong thời gian rảnh? Hãy tham khảo các lớp học đang cần tìm gia sư này nhé.</p>
                    <a href="{{route('request.list')}}">Xem thêm</a>
                </div>
            </div>
            <div class="col-md-7 col-lg-8 col-xl-9">
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
                                    @foreach($requests as $request)
                                    <tr class="clickable-row" data-href="{{route('request.detail', $request)}}">
                                        <td>
                                            <h2 class="table-avatar">
                                                <a href="{{route('students.viewProfile',$request->student->id)}}" class="avatar avatar-sm mr-2">
                                                    <img id="preview-avatar"
                                                         src="{{asset($request->student->user->avatar ? 'storage/'. $request->student->user->avatar : ($request->student->user->gender == 1 ? 'img/tutors/avatars/default-boy.png':'img/tutors/avatars/default-girl.png' ))}}" alt="User Avatar">
                                                </a>
                                                <a href="{{route('students.viewProfile',$request->student)}}">{{$request->student->user->name}}<span>{{$request->type_of_tutor}}</span></a>
                                            </h2>
                                        </td>
                                        <td>{{$request->short_description}}</td>
                                        <td>{{date('d/m/Y', strtotime($request->created_at))}}</td>
                                        <td>{{$request->expect_fee}} VND</td>
                                        <td>{{$request->city->name ?? ''}}</td>
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
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Appointment Tab -->
            </div>
        </div>
    </div>
</section>
<!-- /New classes -->
