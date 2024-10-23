/* =================================== */
/*	related product
/* =================================== */

var owlRelatedProduct = $('#owl-related-product');

owlRelatedProduct.owlCarousel({
    loop: false,
    autoplay: true,
    autoplayTimeout: 4000,
    margin: 0,
    rtl: true,
    smartSpeed: 1000,
    nav: false,
    navElement: 'div',
    responsive: {
        0: {
            items: 2,
            dots: true,
        },
        576: {
            items: 2,
            dots: true,
        },
        768: {
            items: 4,
            dots: true
        },
        992: {
            items: 5,
            dots: false
        }
    },
});

owlRelatedProduct.on('changed.owl.carousel', function (e) {
    owlRelatedProduct.trigger('stop.owl.autoplay');
    owlRelatedProduct.trigger('play.owl.autoplay');
});

$('#arrow-right-related-product').click(function () {
    owlRelatedProduct.trigger('prev.owl.carousel');
    //console.log('right');
});

$('#arrow-left-related-product').click(function () {
    owlRelatedProduct.trigger('next.owl.carousel');
    //console.log('left');
});


/*var imgProductDetails = $('#img-product-details');

$('.item').click(function () {
    console.log($(this).attr('id'));
    var id = $(this).attr('id')
    imgProductDetails.attr("src", "img/product/" + id + ".png");
    goToTop();
});

function goToTop() {
    $('html, body').animate({
        scrollTop: $('#section-product-details').offset().top
    }, 'slow');
}*/


/* =================================== */
/*	image zoom
/* =================================== */


$(document).ready(function () {
    $(".img-product-details").imagezoomsl({
        zoomrange: [1, 1],
        stepzoom: 1,
        zoomstart: 2
    });
});

/* =================================== */
/*	shairing
/* =================================== */

$(".fb").attr("href", window.location);
$(".fb").sharing("facebook");

$(".tw").attr("href", window.location);
$(".tw").sharing("twitter");

$(".pt").attr("href", window.location);
$(".pt").sharing("pinterest");

$(".ln").attr("href", window.location);
$(".ln").sharing("linkedin");

$(".gp").attr("href", window.location);
$(".gp").sharing("googleplus");

/* =================================== */
/*	image product and table food
/* =================================== */

$('#p-show-image-product').click(function () {
    $('#row-table-food').hide();
    $('#row-img-product').show();
    $(this).addClass('p-active');
    $('#p-show-table-food').removeClass('p-active');
});

$('#p-show-table-food').click(function () {
    $('#row-table-food').show();
    $('#row-img-product').hide();
    $(this).addClass('p-active');
    $('#p-show-image-product').removeClass('p-active');
});

