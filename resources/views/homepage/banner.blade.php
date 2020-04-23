<!-- Home Banner -->
<section class="section section-search">
    <div class="container-fluid">
        <div class="banner-wrapper">
            <div class="banner-header text-center">
                <h1>Tìm Gia Sư, Book Lịch Học</h1>
                <p>Khám phá những gia sư giỏi nhất, thích hợp và gần bạn nhất.</p>
            </div>

            <!-- Search -->
            <div class="search-box">
                <form id="header-search" method="post">
                    <div class="form-group search-location">
                        <input type="text" name="location" class="form-control m-input" placeholder="Địa điểm">
                        <span class="form-text">Tìm theo vị trí của bạn</span>
                    </div>
                    <div class="form-group search-info">
                        <input type="text" name="subject" class="form-control m-input" placeholder="Tìm gia sư theo môn học, lớp, hoặc chuyên ngành...">
                        <span class="form-text">Vd : Gia sư tiếng anh, gia sư toán lớp 12...</span>
                    </div>
                    <button type="submit" class="btn btn-primary search-btn"><i class="fas fa-search"></i> <span>Search</span></button>
                    {{ csrf_field() }}
                </form>
            </div>
            <div id="search-suggest" class="s-suggest"></div>
            <!-- /Search -->
            <script type="text/javascript">
                $('#header-search').on('keyup', function() {
                    var search = $(this).serialize();
                    console.log(search);
                    if ($(this).find('.m-input').val() == '') {
                        $('#search-suggest div').hide();
                    } else {
                        console.log(search);
                        $.ajax({
                            url: route('search'),
                            type: 'POST',
                            data: search,
                        })
                            .done(function(res) {
                                $('#search-suggest').html('');
                                $('#search-suggest').append(res)
                            })
                    };
                });
            </script>

        </div>
    </div>
</section>
<!-- /Home Banner -->
