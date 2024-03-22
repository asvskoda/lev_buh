jQuery(function ($) {
    $('a.nav-link').removeClass('active');
    let url = window.location.pathname;
    if (url === '/') {
        $('a.nav-link.main').addClass('active');
    } else {
        let action = url.replace('/', '');

        $(`a.nav-link.${action}`).addClass('active');
    }

    $('.modal-button-consulting').on('click', function () {
        $('#myModal').modal('show');
    });

    $('.close-modal').on('click', function () {
        $('#myModal').modal('hide');
    });
});
