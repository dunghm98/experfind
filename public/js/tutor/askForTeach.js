$(document).ready(function () {

    $askForTeach = $('#ask-for-teach');
    let requestData = $askForTeach.attr('request-data');
    let tutorData = $askForTeach.attr('tutor-data');
    // console.log(tutorData)
    $askForTeach.click(function () {
        askForTeach(tutorData, requestData);
    });
    function askForTeach(tutor, request) {
        $.ajax({
            url: route('tutor.askForTeach'),
            type: 'post',
            data: {
                tutor: tutor,
                request: request
            },
            dataType: 'json',
            success: function (res) {
                if (res['status']===500){
                    tutorExist();
                } else {
                    successAsk(res['number_apply']);
                }
            }, error: function (res) {
                failedAsk();
            }
        })
    }

    function tutorExist() {
        $askForTeach.prop('disabled', true);
        let html = `
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Oops!</strong> Bạn đã gửi yêu cầu cho học sinh này trước đó rùi mà!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
            </div>
        `;
        $('#message-box').append(html);
        setTimeout(function () {
            $('#message-box').fadeOut(300);
        }, 5000);
    }

    function successAsk(numberApplier) {
        $askForTeach.prop('disabled', true);
        let html = `
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Yeahh!</strong> Yêu cầu dạy của bạn đã gửi thành công rùi nhaaaa!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
            </div>
        `;
        $('#message-box').append(html);
        setTimeout(function () {
            $('#message-box').fadeOut(300);
        }, 5000);
        $('#number-tutor-apply').html(numberApplier);
    }

    function failedAsk() {
        $askForTeach.prop('disabled', true);
        let html = `
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Oops!</strong> Hic! Có chút vấn đề rùi, bạn hãy thử lại sau 1 lát nhé.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
            </div>
        `;
        $('#message-box').append(html);
        setTimeout(function () {
            $('#message-box').fadeOut(300);
        }, 5000)
    }
});
