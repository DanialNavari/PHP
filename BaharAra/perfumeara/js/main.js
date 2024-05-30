
/* =================================== */
/*	slider
/* =================================== */

$(document).ready(function () {

    var owl = $('#parent-slider');

    owl.owlCarousel({
        singleItem: true,
        loop: true,
        autoplay: true,
        autoplayTimeout: 7000,
        margin: 0,
        // rtl: true,
        smartSpeed: 1000,
        nav: false,
        dots: true,
        navElement: 'div',
        items: 1
    });

    owl.trigger('refresh.owl.carousel');

    owl.on('changed.owl.carousel', function (e) {

        owl.trigger('stop.owl.autoplay');
        owl.trigger('play.owl.autoplay');

    });

});

/* =================================== */
/*	product
/* =================================== */

$(document).ready(function () {

    var owlProduct = $('#owl-product');

    owlProduct.owlCarousel({
        loop: true,
        autoplayTimeout: 5000,
        margin: 0,
        rtl: true,
        smartSpeed: 1000,
        nav: false,
        dots: false,
        navElement: 'div',
        autoWidth: true,
        responsive: {
            0: {
                items: 1,
                center: false,
                autoplay: true
            },
            576: {
                items: 1,
                center: false,
                autoplay: true
            },
            768: {
                items: 2,
                center: false,
                autoplay: true
            },
            992: {
                items: 5,
                center: true,
                autoplay: true
            }
        },
    });

    owlProduct.on('changed.owl.carousel', function (e) {
        owlProduct.trigger('stop.owl.autoplay');
        owlProduct.trigger('play.owl.autoplay');
    });

    owlProduct.on('translate.owl.carousel', function (e) {
        idx = e.item.index;
        $('.owl-item.big').removeClass('big');
        $('.owl-item.medium').removeClass('medium');
        $('.owl-item').eq(idx).addClass('big');
        $('.owl-item').eq(idx - 1).addClass('medium');
        $('.owl-item').eq(idx + 1).addClass('medium');
    });

});

/* =================================== */
/*	blog
/* =================================== */

$(document).ready(function () {

    var owlBlog = $('#owl-blog');

    owlBlog.owlCarousel({
        loop: true,
        autoplay: false,
        autoplayTimeout: 7000,
        autoHeight: false,
        rtl: true,
        smartSpeed: 1000,
        nav: false,
        navElement: 'div',
        dots: true,
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 1,
                dots: false
            }
        },
    });

    $('#img-arrow-right-blog').click(function () {
        owlBlog.trigger('prev.owl.carousel');
    });

    $('#img-arrow-left-blog').click(function () {
        owlBlog.trigger('next.owl.carousel');
    });

    owlBlog.on('changed.owl.carousel', function (e) {
        owlBlog.trigger('stop.owl.autoplay');
        owlBlog.trigger('play.owl.autoplay');
    });

    $(".p-text-blog").each(function () {
        len = $(this).text().length;
        str = $(this).text().substr(0, 300);
        lastIndexOf = str.lastIndexOf(" ");
        if (len > 80) {
            $(this).text(str.substr(0, lastIndexOf) + ' …');
        }
    });
});
