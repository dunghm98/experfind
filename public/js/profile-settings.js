/*
Author       : Dreamguys
Template Name: Doccure - Bootstrap Template
Version      : 1.0
*/

(function($) {
    "use strict";

	// Pricing Options Show

	$('#pricing_select input.tuition_fee').on('click', function() {
		if ($(this).val() === 'free') {
			$('#custom_price_cont').hide();
		}
		if ($(this).val() === 'non-fee') {
			$('#custom_price_cont').show();
		}
		else {
		}
	});

	// Address study show

	$('#study-method-select #home-study').change(function(){
		if(this.checked) {
			$('#custom-study-address').show();
		}
		else {
			$('#custom-study-address').hide();
		}
	});

	// Weekday calendar

	$('.day-of-week > .btn').click(function(){
		let selector = "." + $(this).val();
		selectDay(selector);
	});
	function selectDay(selector){
		let inputSelector = $(selector + " ul input");
		var morning = inputSelector[0].checked;
		var afternoon = inputSelector[1].checked;
		var evening = inputSelector[2].checked;

		if(morning||afternoon||evening){
			inputSelector.prop('checked', true)
		}
		if(morning && afternoon && evening){
			inputSelector.prop('checked', false)
		}
		if(!morning && !afternoon && !evening){
			inputSelector.prop('checked', true)
		}
	}
	// Education Add More

    $(".education-info").on('click','.trash', function () {
		$(this).closest('.education-cont').remove();
		return false;
    });

    $(".add-education").on('click', function () {
        var educationsContNum = $('.education-cont').length;
		var educationContent = '<div class="row form-row education-cont">' +
			'<div class="col-12 col-md-10 col-lg-11">' +
				'<div class="row form-row">' +
					'<div class="col-12 col-md-4 col-lg-4">' +
						'<div class="form-group">' +
							'<label>Trình độ</label>' +
							'<select name="educations['+educationsContNum+'][degree]" class="form-control select">' +
                                '<option value="0">Lựa chọn</option>' +
                                '<option value="1">Cao học</option>' +
                                '<option value="2">Đại học</option>' +
                                '<option value="3">Cao đẳng</option>' +
                                '<option value="4">Khác</option>' +
                            '</select>' +
						'</div>' +
					'</div>' +
					'<div class="col-12 col-md-6 col-lg-6">' +
						'<div class="form-group">' +
							'<label>Tên trường</label>' +
							'<input name="educations['+educationsContNum+'][college]" type="text" class="form-control">' +
						'</div>' +
					'</div>' +
					'<div class="col-12 col-md-2 col-lg-2">' +
						'<div class="form-group">' +
							'<label>Năm tốt nghiệp</label>' +
							'<input name="educations['+educationsContNum+'][graduate_year]" type="text" class="form-control">' +
						'</div>' +
					'</div>' +
				'</div>' +
			'</div>' +
			'<div class="col-12 col-md-2 col-lg-1"><label class="d-md-block d-sm-none d-none">&nbsp;</label><a href="#" class="btn btn-danger trash"><i class="far fa-trash-alt"></i></a></div>' +
		'</div>';

        $(".education-info").append(educationContent);
        return false;
    });

	// Experience Add More

    $(".experience-info").on('click','.trash', function () {
		$(this).closest('.experience-cont').remove();
		return false;
    });

    $(".add-experience").on('click', function () {
        var experienceContNum = $('.experience-cont').length;
		var experienceContent = '<div class="row form-row experience-cont">' +
			'<div class="col-12 col-md-10 col-lg-11">' +
				'<div class="row form-row">' +
					'<div class="col-12 col-md-6 col-lg-6">' +
						'<div class="form-group">' +
							'<label>Nội dung</label>' +
							'<textarea class="form-control" name="experiences['+experienceContNum+'][description]" id="" cols="30" rows="3"></textarea>' +
						'</div>' +
					'</div>' +
					'<div class="col-12 col-md-6 col-lg-3">' +
						'<div class="form-group">' +
							'<label>Thời gian bắt đầu</label>' +
							'<input type="text" name="experiences['+experienceContNum+'][start_time]" placeholder="Chọn thời gian" class="form-control datetimepicker">' +
						'</div>' +
					'</div>' +
					'<div class="col-12 col-md-6 col-lg-3">' +
						'<div class="form-group">' +
							'<label>Thời gian kết thúc</label>' +
							'<input type="text" name="experiences['+experienceContNum+'][end_time]" placeholder="Chọn thời gian" class="form-control datetimepicker">' +
						'</div>' +
					'</div>' +
				'</div>' +
			'</div>' +
			'<div class="col-12 col-md-2 col-lg-1"><label class="d-md-block d-sm-none d-none">&nbsp;</label><a href="#" class="btn btn-danger trash"><i class="far fa-trash-alt"></i></a></div>' +
		'</div>';

        $(".experience-info").append(experienceContent);
        return false;
    });

	// Certificates Add More

    $(".certificates-info").on('click','.trash', function () {
		$(this).closest('.certificates-cont').remove();
		return false;
    });
    $(".add-award").on('click', function () {
        var certificatesContNum = $('.certificates-cont').length;
        var regcontent = '<div class="row form-row certificates-cont">' +
			'<div class="col-12 col-md-5">' +
				'<div class="form-group">' +
					'<label for="certificate_name">Tên chứng chỉ</label>' +
					'<input name="certificates['+certificatesContNum+'][name]" id="certificate_name" type="text" class="form-control">' +
				'</div>' +
			'</div>' +
            '<div class="col-12 col-md-4">' +
                '<div class="form-group">' +
                    '<label for="issued_by">Nơi cấp</label>' +
                    '<input name="certificates['+certificatesContNum+'][issued_by]" id="issued_by" type="text" class="form-control">' +
                '</div>' +
            '</div>' +
			'<div class="col-12 col-md-2">' +
				'<div class="form-group">' +
					'<label for="year_granted">Năm</label>' +
					'<input name="certificates['+certificatesContNum+'][year_granted]" id="year_granted" type="text" class="form-control">' +
				'</div>' +
			'</div>' +
			'<div class="col-12 col-md-1">' +
				'<label class="d-md-block d-sm-none d-none">&nbsp;</label>' +
				'<a href="#" class="btn btn-danger trash"><i class="far fa-trash-alt"></i></a>' +
			'</div>' +
		'</div>';

        $(".certificates-info").append(regcontent);
        return false;
    });

	// Auth Add More

    $(".auth-info").on('click','.trash', function () {
		$(this).closest('.auth-cont').remove();
		return false;
    });

    $(".add-auth-info").on('click', function () {

        var authContNum = $('.auth-cont').length;
        var authContent = '<div id="auth-cont-'+authContNum+'" class="row form-row auth-cont">' +
			'<div class="col-12 col-md-4 col-lg-4">' +
				'<div class="form-group">' +
					'<label>Loại giấy tờ</label>' +
					'<input name="authentications['+authContNum+'][name]" type="text" class="form-control">' +
				'</div>' +
			'</div>' +
			'<div class="col-12 col-md-3 col-lg-3">' +
				'<label>Ảnh xác minh</label>' +
				'<div class="custom-file">' +
                    '<input name="authentications['+authContNum+'][img]" type="file" auth-info class="custom-file-input" id="auth_info_img-'+authContNum+'">' +
                    '<label class="custom-file-label" for="customFile">Choose file</label>' +
                '</div>' +
			'</div>' +
            `
                 <div class="col-12 col-md-3 col-lg-3">
                                <div class="auth-info-img">
                                    <img class="img-rounded" id="preview-auth-info-${authContNum}"
                                         src="" alt="User Auth-info">
                                </div>
                            </div>
`+
            '<div class="col-12 col-md-2">' +
                '<label class="d-md-block d-sm-none d-none">&nbsp;</label>' +
                '<a href="#" class="btn btn-danger trash"><i class="far fa-trash-alt"></i></a>' +
            '</div>' +
		'</div>';

        $(".auth-info").append(authContent);

        // preview img\
        let $previewImg = $('#preview-auth-info-'+authContNum);
        let $previewImgInput = $('#auth_info_img-'+authContNum);

        $previewImgInput.change(function() {
            readURL(this);
        });
        function readURL(input) {
            if (input.files && input.files[0]) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    $previewImg.attr('src',e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
        return false;
    });



    //  the following code put the name of the file appear on select
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });

	// Registration Add More

    $(".registrations-info").on('click','.trash', function () {
		$(this).closest('.reg-cont').remove();
		return false;
    });

    $(".add-reg").on('click', function () {

        var regcontent = '<div class="row form-row reg-cont">' +
			'<div class="col-12 col-md-5">' +
				'<div class="form-group">' +
					'<label>Registrations</label>' +
					'<input type="text" class="form-control">' +
				'</div>' +
			'</div>' +
			'<div class="col-12 col-md-5">' +
				'<div class="form-group">' +
					'<label>Year</label>' +
					'<input type="text" class="form-control">' +
				'</div>' +
			'</div>' +
			'<div class="col-12 col-md-2">' +
				'<label class="d-md-block d-sm-none d-none">&nbsp;</label>' +
				'<a href="#" class="btn btn-danger trash"><i class="far fa-trash-alt"></i></a>' +
			'</div>' +
		'</div>';

        $(".registrations-info").append(regcontent);
        return false;
    });

})(jQuery);
