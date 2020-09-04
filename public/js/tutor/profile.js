$(document).ready(function () {
    'use strict';



    $("#avatar").change(function() {
        readImgAvatar(this);
    });


    let $selectedSubject = $('#subject_name'),
        $speciality = $('#speciality_name');

    if (oldSpecialities instanceof  Array && oldSpecialities.length > 0) {

        $.ajax({
            url: route('specialities.getList'),
            type: 'get',
            data: {
                specialities: oldSpecialities
            },
            dataType: 'json',
            success: function (res) {
                let specialities = res.data,
                    htmlOption = '';
                specialities.forEach(function (speciality) {
                    htmlOption += `<option selected value="${speciality.id}">${speciality.name}</option>`;
                });
                $speciality.append(htmlOption).trigger('select2:select');
            }
        });



    }

    if (oldSubjects instanceof  Array && oldSubjects.length > 0) {
        $.ajax({
            url: route('subjects.getList'),
            type: 'get',
            data: {
                subjects: oldSubjects,
            },
            dataType: 'json',
            success: function (res) {
                // console.log(res);
                let subjects = res.data,
                    htmlOption = '';
                subjects.forEach(function (subject) {
                    htmlOption += `<option selected value="${subject.id}">${subject.name}</option>`;
                });
                $selectedSubject.append(htmlOption).trigger('select2:select');
            }
        });
    }

    $speciality.select2({
        placeholder: 'Select A Subject',
        pagination: {
            more: true,
        },
        ajax: {
            url: route('specialities.getAll'),
            type: 'get',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    name: params.term,
                };
            },
            processResults: function (data) {
                return {
                    results: $.map(data.data, function (val, i) {
                        return {
                            id: val.id,
                            text: val.name == null || val.name === '' ? `ID: ${val.id} - No Name` : val.name
                        };
                    })
                }
            },
            error: function (res) {
                console.log(res.responseJSON.message);
            }
        }
    });



    $speciality.on('select2:unselect', function (e) {
        if (oldSpecialities.includes(parseInt(e.params.data.id))) {
            oldSpecialities = oldSpecialities.filter(function (item) {
                return item != e.params.data.id;
            });
        }

        console.log(oldSpecialities);

        initSubjectSl2($selectedSubject);

        if (oldSpecialities.length === 0) {
            $selectedSubject.empty();
        }
    });
    $speciality.on('select2:select', function (e) {

        if (e.params !== undefined) {
            oldSpecialities.push(e.params.data.id);
        }
        // console.log(oldSpecialities);
        if ($selectedSubject.length > 0) {
            initSubjectSl2($selectedSubject);
        }
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



function initSubjectSl2(selector = $(document)) {
    selector.select2({
        placeholder: 'Select A Subject',
        pagination: {
            more: true,
        },
        ajax: {
            url: route('subjects.getBySpeciality'),
            type: 'post',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    specialities: oldSpecialities,
                    name: params.term,
                };
            },
            processResults: function (data) {
                return {
                    results: $.map(data.data, function (val, i) {
                        return {
                            id: val.id,
                            text: val.name == null || val.name === '' ? `ID: ${val.id} - No Name` : val.name
                        };
                    })
                }
            },
            error: function (res) {
                console.log(res);
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
// auth img
$(document).on('change', '[auth-info]', function() {
    readURL(this);
    let self = $(this);
    let outImgSelect = this;
    $('.js-errors').css({
        'color': 'red',
        'font-size': '12px'
    });
    // console.log(self.closest('.col-12').prev());
    // return false;
    if (this.files && this.files[0]) {
        let id = self.attr('data-id');
        let imgFile = $(this).prop('files'),
            tutorID = $('#authentications-info').attr('tutor-id'),
            name = self.closest('.col-12').prev().find('input').val();

        // console.log(name);

        let formData = new FormData();
        formData.append('img', imgFile[0]);
        formData.append('tutor', tutorID);
        formData.append('id', id);
        formData.append('name', name);

        if (id && imgFile) {
            $.ajax({
                url: route('tutors.updateAuthInfo'),
                type: 'post',
                data: formData,
                dataType: 'json',
                processData: false,  // tell jQuery not to process the data
                contentType: false,  // tell jQuery not to set contentType
                success: function (res) {
                    console.log(res.message);
                    if(res.status===200){
                        $('.show-message').append(`<p class="success-message text-info">${res.message}</p>`);
                        setTimeout(function () {
                            $('.success-message').fadeOut(200);
                        },3000)
                    }
                }
            });
        } else {
            console.log(route('tutors.createAuthInfo', {tutor:tutorID}).url());
            $.ajax({
                url: route('tutors.createAuthInfo', {tutor:tutorID}).url(),
                type: 'post',
                data: formData,
                dataType: 'json',
                processData: false,  // tell jQuery not to process the data
                contentType: false,  // tell jQuery not to set contentType
                success: function (res) {
                    if (res.status !== 200) {
                        let messagesText = ``;
                        if (res.messages['name'] !== undefined) {
                            res.messages['name'].forEach(function (value) {
                                messagesText += `${value}`;
                            });
                            $('.show-message').append(`<p class="failed-message text-danger">${messagesText}</p>`);

                            setTimeout(function () {
                                $('.failed-message').fadeOut(200);
                                resetUrlImg(outImgSelect);
                            },3000)
                        }
                    }
                    if(res.status===200){
                        $('.show-message').append(`<p class="success-message text-info">${res.message}</p>`);
                        setTimeout(function () {
                            $('.success-message').fadeOut(200);
                        },3000)
                    }

                }
            }).fail(function (res) {
                console.log(res.responseJSON);
            });
        }

        // console.log(imgFile);
    }


});




$(document).on('click', '._delete_auth_info_action', function () {

    let self = $(this),
        id = self.attr('data-id');
    $.ajax({
        url: route('tutors.deleteAuthInfo', {id: id}).url(),
        type: 'get',
        dataType: 'json',

    }).done(function (res) {
        console.log(res);
    }).fail(function (res) {
        console.log(res);
    });
});

function deleteAuthInfo(id) {
    $.ajax({
        url: route('tutors.deleteAuthInfo', {id: id}).url(),
        type: 'get',
        dataType: 'json',

    }).done(function (res) {
        console.log(res);
    }).fail(function (res) {
        console.log(res);
    });
}


function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $(input).closest('.col-12').next().find('.img-rounded').attr('src',e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function resetUrlImg(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $(input).closest('.col-12').next().find('.img-rounded').attr('src','/img/tutors/auth-info/auth-default.png');
            console.log('vl')
        };
        reader.readAsDataURL(input.files[0]);
    }
}
