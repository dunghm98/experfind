$(document).ready(function () {

let $bookBtn = $('.book-btn');
let $bookModalTutor = $('#booking-modal');
let $tutorBookName = $('#tutor-book-name');
let $tutorBookImg = $('#tutor-book-img');
let studentId = $bookModalTutor.attr('student-data');

    // console.log(studentId);

$bookBtn.click(function () {
    let self = $(this);
    let tutor = [];
    let tutorName = self.closest('.pro-content').find('.title a').html();
    let tutorAvatar = self.closest('.pro-content').prev().find('img').attr('src');
    let tutorId = self.closest('.pro-content').attr('tutor-data');
    $tutorBookName.attr('tutor-data',tutorId);
    $tutorBookName.html(tutorName);
    $tutorBookImg.attr('src', tutorAvatar);
    getListRequest();
});

    function getListRequest(){
        $.ajax({
            url: route('students.getListRequest'),
            type: 'post',
            data: {
                id: studentId
            },
            dataType: 'json',
            success: function (res) {
                let requests = res['requests'];
                createHtml(requests);
            }, error: function (res) {
                console.log(res)
            }
        })
    }

    function createHtml(data) {
        $('.request-cont').html('');
    $.each(data, function (key, val) {
        let html = `
            <div class="append-request row form-row">
                <div class="col-12 col-md-10 col-lg-11">
                    <div class="form-group">
                        <p request-id="${val['id']}" class="request-data">${val['short_description']}</p>
                    </div>
                </div>
                <div class="col-12 col-md-2 col-lg-1">
                    <button class="btn btn-primary btn-book">Gửi</button>
                </div>
            </div>
        `;
        $('.request-cont').append(html);
    })
    }


    $(document).on('click', '.btn-book', function() {
        let requestId = $(this).closest('.append-request').find('.request-data').attr('request-id');
        let tutorId = $tutorBookName.attr('tutor-data');
        bookTutor(requestId, tutorId);
        // console.log(tutorId)
    });

    function bookTutor(requestId, tutorId) {
        $.ajax({
            url: route('student.bookTutor'),
            type: 'post',
            data: {
                tutorId: tutorId,
                requestId: requestId
            },
            dataType: 'json',
            success: function (res) {
                if (res['status']===500){
                    tutorExist();
                } else {
                    console.log(res);
                    successAsk();
                }
            }, error: function (res) {
                console.log(res)
            }
        })
    }

    function tutorExist() {
        let html = `
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Oops!</strong> Bạn đã mời gia sư này trước đó hoặc người này đã gửi lời mời cho bạn rồi!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
            </div>
        `;
        exit(html);
    }

    function successAsk() {
        let html = `
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Yeahh!</strong> Yêu cầu mời dạy của bạn đã gửi thành công rùi nhaaaa!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
            </div>
        `;
        exit(html);
    }

    function failedAsk() {
        let html = `
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Oops!</strong> Hic! Có chút vấn đề rùi, bạn hãy thử lại sau 1 lát nhé.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
            </div>
        `;
        exit(html);
    }

    function exit(html) {
        $('#message-box').html('').append(html).hide().fadeIn(200);
        $('#book').prop('disabled', true);
        setTimeout(function () {
            $('#message-box').fadeOut(300);
        }, 5000);
    }
});
