@extends('student.dashboard')
@section('student-dashboard-content')

    <div class="col-md-7 col-lg-8 col-xl-9">
        <div class="row row-grid">
            <!-- Tutor box -->
            <div class="col-md-6 col-lg-4 col-xl-3">
                <div class="profile-widget">
                    <div class="doc-img">
                        <a href="#">
                            <img class="img-fluid" alt="User Image" src="https://icdn.dantri.com.vn/thumb_w/640/2019/03/24/nam-sinh-nha-trangdocx-1553397056658.jpeg">
                        </a>
                        <a href="javascript:void(0)" class="fav-btn">
                            <i class="far fa-bookmark"></i>
                        </a>
                    </div>
                    <div class="pro-content">
                        <h3 class="title">
                            <a href="#">Nguyễn Huy Hoàng</a>
                            <i class="fas fa-check-circle verified"></i>
                        </h3>
                        <p class="speciality">Sinh viên Đại học Bách Khoa</p>
                        <div class="rating">
                            <i class="fas fa-star filled"></i>
                            <i class="fas fa-star filled"></i>
                            <i class="fas fa-star filled"></i>
                            <i class="fas fa-star filled"></i>
                            <i class="fas fa-star filled"></i>
                            <span class="d-inline-block average-rating">(17)</span>
                        </div>
                        <ul class="available-info">
                            <li>
                                <i class="fas fa-map-marker-alt"></i> Cầu Giấy, Hà Nội
                            </li>
                            <li>
                                <i class="fas fa-chalkboard-teacher"></i>
                                <div class="clinic-services inline-service">
                                    <span>Văn</span>
                                    <span> Lý</span>
                                </div>
                            </li>
                            <li>
                                <i class="far fa-money-bill-alt"></i> $300 - $1000 <i class="fas fa-info-circle" data-toggle="tooltip" title="Lorem Ipsum"></i>
                            </li>
                        </ul>
                        <div class="row row-sm">
                            <div class="col-6">
                                <a href="#" class="btn view-btn">Chi tiết</a>
                            </div>
                            <div class="col-6">
                                <a href="#" class="btn book-btn">Mời dạy</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Tutor box -->
            <!-- Tutor box -->
            <div class="col-md-6 col-lg-4 col-xl-3">
                <div class="profile-widget">
                    <div class="doc-img">
                        <a href="#">
                            <img class="img-fluid" alt="User Image" src="https://cdn.24h.com.vn/upload/2-2019/images/2019-06-13/1560394608-165-01-1560392181-width640height480.jpg">
                        </a>
                        <a href="javascript:void(0)" class="fav-btn">
                            <i class="far fa-bookmark"></i>
                        </a>
                    </div>
                    <div class="pro-content">
                        <h3 class="title">
                            <a href="#">Hoàng Mạnh Dũng</a>
                            <i class="fas fa-check-circle verified"></i>
                        </h3>
                        <p class="speciality">Sinh viên Đại học Ngoại Thương</p>
                        <div class="rating">
                            <i class="fas fa-star filled"></i>
                            <i class="fas fa-star filled"></i>
                            <i class="fas fa-star filled"></i>
                            <i class="fas fa-star filled"></i>
                            <i class="fas fa-star filled"></i>
                            <span class="d-inline-block average-rating">(17)</span>
                        </div>
                        <ul class="available-info">
                            <li>
                                <i class="fas fa-map-marker-alt"></i> Hai Bà Trưng, Hà Nội
                            </li>
                            <li>
                                <i class="fas fa-chalkboard-teacher"></i>
                                <div class="clinic-services inline-service">
                                    <span>Toán</span>
                                    <span> Tiếng Anh</span>
                                </div>
                            </li>
                            <li>
                                <i class="far fa-money-bill-alt"></i> $300 - $1000 <i class="fas fa-info-circle" data-toggle="tooltip" title="Lorem Ipsum"></i>
                            </li>
                        </ul>
                        <div class="row row-sm">
                            <div class="col-6">
                                <a href="#" class="btn view-btn">Chi tiết</a>
                            </div>
                            <div class="col-6">
                                <a href="#" class="btn book-btn">Mời dạy</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Tutor box -->



        </div>
    </div>
@endsection
