<!-- Popular Section -->
<section class="section section-doctor">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-5 col-lg-4 col-xl-3">
                <div class="section-header ">
                    <h2>Tìm Gia Sư</h2>
                    <p>Bạn cần nâng cao kiến thức? </p>
                </div>
                <div class="about-content">
                    <p>Bạn cần tìm gia sư để kèm học, nâng cao kiến thức chuyên môn? Hay muốn tìm gia sư cho con em của mình ôn lại kiến thức trên trường?.</p>
                    <p>Chúng tôi có đội ngũ gia sư giàu kinh nghiệm có thể đáp ứng tốt nhu cầu của bạn, hãy chọn cho mình một người đồng hành tại đây nhé</p>
                    <a href="{{ route('list-tutor') }}">Xem thêm </a>
                </div>
            </div>
            <div class="col-md-7 col-lg-8 col-xl-9">
                <div class="doctor-slider slider">
                    @foreach($tutors as $tutor)
                    <!-- Tutor Widget -->
                    <div class="profile-widget">
                        <div class="doc-img">
                            <a href="{{route('tutor-profile',$tutor->id)}}">
                                <img class="img-fluid" alt="User Image" src="{{asset($tutor->user->avatar ? 'storage/'. $tutor->user->avatar : ($tutor->user->gender == 1 ? 'img/tutors/avatars/default-boy.png':'img/tutors/avatars/default-girl.png' ))}}">
                            </a>
                            <a href="javascript:void(0)" class="fav-btn">
                                <i class="far fa-bookmark"></i>
                            </a>
                        </div>
                        <div class="pro-content" tutor-data="{{$tutor->id}}">
                            <h3 class="title">
                                <a href="{{route('tutor-profile',$tutor->id)}}">{{$tutor->user->name}}</a>
                                <i class="fas fa-check-circle verified"></i>
                            </h3>
                            <?php
                            foreach ($tutor->subjects as $subject) {
                                $subjectArray[] = $subject->name;
                            }
                            ?>
                            <p class="speciality">Gia sư {{isset($subjectArray) ? implode(", ",$subjectArray) : ''}}</p>
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
                                    <i class="fas fa-map-marker-alt"></i> {{$tutor->user->district->name ?? ''}}, {{$tutor->user->city->name ?? ''}}
                                </li>
                                <li>
                                    <i class="far fa-user"></i> {{$tutor->type_of_tutor == 0 ? 'Sinh viên' : 'Giáo viên'}}
                                </li>
                                <li>
                                    <i class="far fa-money-bill-alt"></i>{{$tutor->tuition_fee ?? 'Dạy miễn phí'}} vnđ
                                    <i class="fas fa-info-circle" data-toggle="tooltip" title="Học phí cho mỗi giờ"></i>
                                </li>
                            </ul>
                            <div class="row row-sm">
                                <div class="col-6">
                                    <a href="{{route('tutor-profile',$tutor->id)}}" class="btn view-btn">Xem thông tin</a>
                                </div>
                                <div class="col-6">
                                    <a href="javascript:void(0)" class="btn book-btn" data-toggle="modal" data-target="#book-tutor">Mời dạy</a>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- /Tutor Widget -->
                    @endforeach


                </div>
            </div>
        </div>
    </div>
</section>
<!-- /Popular Section -->
