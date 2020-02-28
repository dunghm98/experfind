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
