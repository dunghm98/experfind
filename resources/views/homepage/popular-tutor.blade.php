<!-- Popular Section -->
<section class="section section-doctor">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-5 col-lg-4 col-xl-3">
                <div class="section-header ">
                    <h2>Book Gia Sư</h2>
                    <p>Lorem Ipsum is simply dummy text </p>
                </div>
                <div class="about-content">
                    <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum.</p>
                    <p>web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes</p>
                    <a href="search.html">Read More..</a>
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
                            <p class="speciality">Gia sư tiếng Hàn</p>
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
                                    <i class="far fa-clock"></i> Available on Fri, 22 Mar
                                </li>
                                <li>
                                    <i class="far fa-money-bill-alt"></i> $300 - $1000
                                    <i class="fas fa-info-circle" data-toggle="tooltip" title="Lorem Ipsum"></i>
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
