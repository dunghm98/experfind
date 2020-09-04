$(document).ready(function () {
    'use strict';



    $("#avatar").change(function() {
        readImgAvatar(this);
    });




//    ============City==========



    let $city = $('#city');
    $city.on('change', function () {
        let cityID = $city.val();

        if (cityID > 0) {
            getDistrict(cityID);
        } else {
            $("#district").empty();
        }
    });

    if ($city.length > 0) {
        let cityID = $city.val();
        if(cityID){
            getDistrict(cityID);
        }else{
            $("#district").empty();
        }
    }
});

function getDistrict(cityId) {
    $.ajax({
        type:"GET",
        url:'/get-district-list/'+cityId,
        success:function(res){
            if(res.status === 200){
                let $district = $('#district'),
                    selectedID = $district.attr('selected-dist');
                $district.empty();
                $district.append('<option value="0">Lựa chọn</option>');
                $.each(res.data,function(key, value){
                    $("#district").append(`<option ${parseInt(selectedID) > 0 && parseInt(selectedID) === parseInt(value.id) ? 'selected' : ''} value="${value.id}">${value.name}</option>`)
                        .trigger('change');
                });
            }else{
                $("#district").empty();
            }
        }
    });
}




// avatar

function readImgAvatar(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#preview-avatar').attr('src',e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
}


//validate data request for tutor

$(document).on('click', '#home-study', function () {
    if ($(this).prop('checked') === true){
        $('#city').prop('required',true);
        $('#district').prop('required',true);
        $('#address').prop('required',true);
    }
});
$(document).on('click', '#online-study', function () {
    if ($(this).prop('checked') === true){
        $('#city').prop('required',false);
        $('#district').prop('required',false);
        $('#address').prop('required',false);
    }
});

$("#submit").on("click", function(){
    let errorCount = 0;
    $('.js-errors').css({
        'color': 'red',
        'font-size': '12px'
    });
    if (($("input[name*='schedule']:checked").length)<=0) {
        let errorLog = $("input[name*='schedule']").closest('.form-group').find('.js-errors').show();
        errorLog.html('*Hãy chọn lịch học');
        errorCount++;
        console.log(errorLog)
    }
    else {
        $("input[name*='schedule']").closest('.form-group').find('.js-errors').hide();
    }
    if (($("input[name*='tutor_gender']:checked").length)<=0) {
        let errorLog = $("input[name*='tutor_gender']").closest('.form-group').find('.js-errors').show();
        errorLog.html('*Hãy chọn giới tính gia sư');
        errorCount++;
        console.log(errorLog)
    }
    else {
        $("input[name*='tutor_gender']").closest('.form-group').find('.js-errors').hide();
    }
    if (($("input[name*='type_of_tutor']:checked").length)<=0) {
        let errorLog = $("input[name*='type_of_tutor']").closest('.form-group').find('.js-errors').show();
        errorLog.html('*Hãy chọn kiểu gia sư');
        errorCount++;
        console.log(errorLog)
    }
    else {
        $("input[name*='type_of_tutor']").closest('.form-group').find('.js-errors').hide();
    }
    if (($("input[name*='learning_method']:checked").length)<=0) {
        let errorLog = $("input[name*='learning_method']").closest('.form-group').find('.js-errors').show();
        errorLog.html('*Hãy chọn hình thức học');
        errorCount++;
        console.log(errorLog)
    }
    else {
        $("input[name*='learning_method']").closest('.form-group').find('.js-errors').hide();
    }
    return errorCount <= 0;

});
