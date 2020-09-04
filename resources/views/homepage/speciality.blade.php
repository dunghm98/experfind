<!-- Clinic and Specialities -->
<section class="section section-specialities">
    <div class="container-fluid">
        <div class="section-header text-center">
            <h2>Tìm Gia Sư và Lớp Học</h2>
            <p class="sub-title">Lựa chọn gia sư phù hợp cho bạn theo các danh mục kiến thức dưới đây.</p>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-9">
                <!-- Slider -->
                <div class="specialities-slider slider">
                    @foreach($specialities as $speciality)
                    <!-- Slider Item -->
                    <a href="{{route('search-tutor-by-speciality',$speciality->id)}}">
                        <div class="speicality-item text-center">
                            <div class="speicality-img">
                                <img src="{{asset('img/toan-hoc.png')}}" class="img-fluid" alt="Speciality">
                                <span><i class="fa fa-circle" aria-hidden="true"></i></span>
                            </div>
                            <p>{{$speciality->name}}</p>
                        </div>
                    </a>
                    <!-- /Slider Item -->
                    @endforeach
                </div>
                <!-- /Slider -->

            </div>
        </div>
    </div>
</section>
<!-- Clinic and Specialities -->
