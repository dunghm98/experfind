$(document).ready(function () {

    $(document).on('click', '.btn-search-tag', function () {
        let requestTag = removeAccents($(this).html());
        requestTag = requestTag.split(' ').join('+');
        window.location = "/list-request-for-tutor-by-tag?tag="+requestTag;
    });

    function removeAccents(str) {
        return str.normalize('NFD')
            .replace(/[\u0300-\u036f]/g, '')
            .replace(/đ/g, 'd').replace(/Đ/g, 'D');
    }
})
