
/*$.ajax({
    url: "http://192.168.2.162/NavganForoshApi/apiservice/api/GetListCustomer",
    method: 'POST',
    dataType: "json",
    headers: {
        'TOKEN': 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1bmlxdWVfbmFtZSI6IjIzOTgzYTY0OTQ3MTQyYmViNGQyIiwibmJmIjoxNjAwMjI1OTQ5LCJleHAiOjE2NjMyOTc5NDksImlhdCI6MTYwMDIyNTk0OX0.R-HpJD0uj1DpS5A06vu2BqFjKi5-rCMXM9C0ErXh2Wk'
    },
    data: {
        'code': "2398",
        'androidId': "3a64947142beb4d2"
    },
    success: function (data) {
        $(".a_RedirectPersonel").attr('href', 'https://emp.behara.com/');
        $(".a_RedirectAgent").attr('href', 'https://crm.behara.com');
    },
    error: function (XHR, textStatus, errorThrown) {
    }
});*/


function checkURL(url) {
    var scriptTag = document.body.appendChild(document.createElement("script"));
    scriptTag.onload = function () {
        /*alert(url + " is available");*/
    };
    scriptTag.onerror = function () {
        $(".a_RedirectPersonel").attr('href', 'https://emp.behara.com/');
        $(".a_RedirectAgent").attr('href', 'https://crm.behara.com/index?ac=2');
        $(".a_RedirectCustomer").attr('href', 'https://crm.behara.com/index?ac=1');
        $(".a_Recruitment").attr('href', 'https://jobs.behara.com/');
        /*alert(url + " is not available");*/
    };
    scriptTag.src = url;
}
//checkURL("https://jobs.behara.net:7474");


$(document).ready(function () {
    setTimeout(function () {
        $("#preloader").fadeOut("slow");
        new WOW().init();
    }, 500);
});

/* =================================== */
/*	ic top
/* =================================== */

var icTop = $('.a-icon-go-to-top-page');

icTop.click(function () {
    $('html, body').animate({ scrollTop: 0 }, 'slow');
});

$(window).scroll(function () {

    if (window.pageYOffset > 500) {
        icTop.css('opacity', '1');
    } else {
        icTop.css('opacity', '0');
    }

});

/* =================================== */
/*	navigation
/* =================================== */

$('#navigation li.dropdown').hover(function () {
    $(this).find('.dropdown-menu').addClass("show");
    $(this).find('.dropdown-toggle').addClass("show");
}, function () {
    $(this).find('.dropdown-menu').removeClass("show");
    $(this).find('.dropdown-toggle').removeClass("show");
});


$(document).ready(function () {

    var sidenav_visible = 0;

    var $toggle = $('.navbar-toggler');
    var $divNavigationMobile = $('.div-navigation-mobile');
    var $divParentUlNavigationMobile = $('.div-parent-ul-navigation-mobile');

    $toggle.click(function (e) {

        e.stopPropagation();

        if (sidenav_visible === 0) {

            sidenav_visible = 1;

            setTimeout(function () {
                $toggle.addClass('toggled');
                $divNavigationMobile.removeClass('slide-up');
                $divNavigationMobile.addClass('slide-down');
            }, 300);

            setTimeout(function () {
                $divParentUlNavigationMobile.addClass('slide-down');
                $divParentUlNavigationMobile.removeClass('slide-up');
            }, 500);


        } else if (sidenav_visible === 1) {

            sidenav_visible = 0;

            $toggle.removeClass('toggled');
            $divNavigationMobile.removeClass('slide-down');
            $divNavigationMobile.addClass('slide-up');

            $divParentUlNavigationMobile.removeClass('slide-down');
            $divParentUlNavigationMobile.addClass('slide-up');

        }

    });

    $(document).click(function () {

        if (sidenav_visible === 1) {

            sidenav_visible = 0;

            $toggle.removeClass('toggled');
            $divNavigationMobile.removeClass('slide-down');
            $divNavigationMobile.addClass('slide-up');

            $divParentUlNavigationMobile.removeClass('slide-down');
            $divParentUlNavigationMobile.addClass('slide-up');

        }

    });

    $('#nav').singlePageNav({
        offset: 56,
        speed: 2000,
        filter: ':not(.external)'
    });

    $(window).scroll(function () {

        //var bottom = $("#section-slider").position().top + $("#section-slider").outerHeight(true);
        //bottom = bottom - 60;

        if (window.pageYOffset >= 450) {

            $("#header").addClass('nav-fixed');
            $(".img-logo-navigation").removeClass('wow animated flip slow');

        } else {

            $("#header").removeClass('nav-fixed');

        }

    });

});

/*var sidenav_visible = 0;

$(document).ready(function () {

    var $toggle = $('.navbar-toggler');

    $toggle.on('click', function () {

        if (sidenav_visible === 1) {

            $('html').removeClass('nav-open');
            sidenav_visible = 0;
            setTimeout(function() {
                $toggle.removeClass('toggled');
            }, 300);

        } else {

            setTimeout(function() {
                $toggle.addClass('toggled');
            }, 300);

            $('#overlay').on('click', function() {
                $('html').removeClass('nav-open');
                sidenav_visible = 0;
                setTimeout(function() {
                    $toggle.removeClass('toggled');
                }, 300);
            });

            $('html').addClass('nav-open');
            sidenav_visible = 1;

        }
    });

    $(window).resize(function () {

        $('html').removeClass('nav-open');
        sidenav_visible = 0;
        setTimeout(function() {
            $toggle.removeClass('toggled');
        }, 300);

    });

});*/

/* =================================== */
/*	persian number
/* =================================== */

$(document).ready(function () {

    function ConvertNumberToPersion() {
        let persian = { 0: '۰', 1: '۱', 2: '۲', 3: '۳', 4: '۴', 5: '۵', 6: '۶', 7: '۷', 8: '۸', 9: '۹' };

        function traverse(el) {

            if (el.className != 'site-info-footer' && el.className != 'modal fade') {

                //el.id

                if (el.nodeType == 3) {
                    var list = el.data.match(/[0-9]/g);
                    if (list != null && list.length != 0) {
                        for (var i = 0; i < list.length; i++)
                            el.data = el.data.replace(list[i], persian[list[i]]);
                    }
                }
                for (var i = 0; i < el.childNodes.length; i++) {
                    traverse(el.childNodes[i]);
                }

            }
        }

        traverse(document.body);
    }

    ConvertNumberToPersion();

});

