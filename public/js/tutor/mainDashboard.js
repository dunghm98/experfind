$(document).ready(function () {

    console.log('ok')
});
$('.btn-accept').on('click', function () {
    let requestId = $(this).closest('.request-cont').attr('data-request');
    let tutorId = $(this).closest('.request-cont').attr('data-tutor');
    // console.log(requestId)
    accept(requestId, tutorId);
});

$('.btn-decline').on('click', function () {
    let rowSelector = $(this).closest('.request-cont').attr('id');
    let requestId = $(this).closest('.request-cont').attr('data-request');
    let tutorId = $(this).closest('.request-cont').attr('data-tutor');
    // console.log(requestId)
    decline(requestId, tutorId,rowSelector);
});
$('.btn-delete').on('click', function () {
    let rowSelector = $(this).closest('.request-cont').attr('id');
    let requestId = $(this).closest('.request-cont').attr('data-request');
    let tutorId = $(this).closest('.request-cont').attr('data-tutor');
    // console.log(rowSelector);
    deleteRequest(requestId, tutorId,rowSelector);
});

function accept(request, tutor) {
    $.ajax({
        url: route('tutor.acceptRequest'),
        type: 'post',
        data: {
            request: request,
            tutor: tutor
        },
        dataType: 'json',
        success: function (res) {
            if (res['status']===500){
                console.log(res);
                CanNotAccept();
            } else {
                successAccept();
                console.log(res)
            }
        }, error: function (res) {
            console.log(res);
            failed();
        }
    })
}


function CanNotAccept() {
    // $askForTeach.prop('disabled', true);
    let html = `
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Oops!</strong> Hình như có ai đó đã nhận dạy trước bạn mất rùi :<<<<
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
            </div>
        `;
    appendMessage(html);
}

function successAccept() {
    // $askForTeach.prop('disabled', true);
    let html = `
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Yeahh!</strong> Yêu cầu xác nhận dạy của bạn đã gửi thành công rùi nhaaaa!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
            </div>
        `;
    appendMessage(html);
}

function failed() {
    // $askForTeach.prop('disabled', true);
    let html = `
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Oops!</strong> Hic! Có chút vấn đề rùi, bạn hãy thử lại sau 1 lát nhé.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
            </div>
        `;
    appendMessage(html);
}

function appendMessage(html) {
    $('.message-box').html('').append(html).hide().fadeIn(200);
    setTimeout(function () {
        $('.message-box').fadeOut(300);
    }, 8000)
}

function decline(request, tutor, rowSelector) {
    $.ajax({
        url: route('tutor.declineRequest'),
        type: 'post',
        data: {
            request: request,
            tutor: tutor
        },
        dataType: 'json',
        success: function (res) {
            if (res['status']===500){
                AlreadyDecline(rowSelector);
            } else {
                successDecline(rowSelector);
                console.log(res)
            }
        }, error: function (res) {
            console.log(res);
            failed();
        }
    })
}

function AlreadyDecline(rowSelector) {
    // $askForTeach.prop('disabled', true);
    let html = `
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Oops!</strong> Hình như bạn hủy yêu cầu này trước rùi mà ._.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
            </div>
        `;
    appendMessage(html);
    $('#'+rowSelector).fadeOut(700);
    console.log()
}

function successDecline(rowSelector) {
    // $askForTeach.prop('disabled', true);
    let html = `
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Yeahh!</strong> Yêu cầu huỷ lời mời dạy của bạn đã gửi thành công rùi nhaaaa!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
            </div>
        `;
    appendMessage(html);
    $('#'+rowSelector).fadeOut(700);
}

function successDelete(rowSelector) {
    // $askForTeach.prop('disabled', true);
    let html = `
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Yeahh!</strong> Yêu cầu mời dạy đã được xóa khỏi hệ thống!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
            </div>
        `;
    appendMessage(html);
    $('#'+rowSelector).fadeOut(700);
    console.log('xoa')
}

function deleteRequest(request, tutor, rowSelector) {
    $.ajax({
        url: route('tutor.deleteRequest'),
        type: 'post',
        data: {
            request: request,
            tutor: tutor
        },
        dataType: 'json',
        success: function (res) {
                successDelete(rowSelector);
                console.log(res)
        }, error: function (res) {
            console.log(res);
            failed();
        }
    })
}
