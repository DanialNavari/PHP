function page(type, route) {
    if (type == 'r') {
        window.location.assign('./?route=' + route);
    } else if (type == 'd') {
        window.location.assign(route);
    }
}

var nav_drawer = 0;

$('#h_menu').click(function () {
    if (nav_drawer == 0) {
        $('.gray_layer').show();
        $('.nav_drawer').fadeIn();
        nav_drawer = 1;
    } else if (nav_drawer == 1) {
        $('.gray_layer').click();
        nav_drawer = 0;
    }
});

$('.gray_layer').click(function () {
    $('.nav_drawer').fadeOut();
    $('.gray_layer').fadeOut();
    nav_drawer = 0;
});