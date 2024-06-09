function page(type, route, name) {
    if (type == 'r') {
        window.location.assign('./?route=' + route + '&h=' + name);
    } else if (type == 'd') {
        window.location.assign(route + '/?h=' + name);
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
    $('.add_payments').fadeOut();
    nav_drawer = 0;
});

let path_name = $('#path_name').val();
switch (path_name) {
    case 'home':
        $('#home').addClass('bg_hover');
        $('#home .item_title').show();
        break;
    case 'wallet':
        $('#wallet').addClass('bg_hover');
        $('#wallet .item_title').show();
        break;
    case 'contact':
        $('#contact').addClass('bg_hover');
        $('#contact .item_title').show();
        break;
    case 'course':
        $('#newCourse').addClass('bg_hover');
        $('#newCourse .item_title').show();
        break;
    case 'transaction':
        $('#transaction').addClass('bg_hover');
        $('#transaction .item_title').show();
        break;
}

function changeCourseName() {
    let esm = prompt('نام جدید دوره را وارد کنید');
    if (esm.length > 2) {
        $('#courseName').text(esm);
    }
}

function addUserToCourse() {
    window.location.assign('./?route=_newCourse&h=course&course_id=1');
}

function moneyLimit() {
    let fee = prompt('مبلغ محدودیت مالی را وارد کنید');
    if (parseInt(fee) > 0) {
        $('#moneyLimit').text(fee);
    }
}

function setDate() {
    $('#set_tarikh').show('slow');
    $(".range-from-example").show('slow');
    $('.w-100').show();
    $('.month-grid-box .header').hide();
    $('.header').css('display', 'inline-block');
}

$('#savedate').click(function () {
    shamsi = $("td.selected").attr('data-date');
    if (shamsi.length > 0) {
        $('#start_from_fa').text(shamsi);
    } else {
        shamsi = $("td.today").attr('data-date');
    }

    shamsi_split = shamsi.split(",");
    let saal, maah, rooz;

    if (shamsi_split[1] < 10) {
        maah = '0' + shamsi_split[1];
    } else {
        maah = shamsi_split[1];
    }

    if (shamsi_split[2] < 10) {
        rooz = '0' + shamsi_split[2];
    } else {
        rooz = shamsi_split[2];
    }

    $('#start_from_fa').text(shamsi_split[0] + '/' + maah + '/' + rooz);

    $('.month-grid-box .header').hide();
    $('#set_tarikh').hide('slow');
    $(".range-from-example").hide('slow');
    $('.w-100').hide();
});

function remove_from_course(id) {
    let user_id = 'user-' + id;
    let user_esm = user_id + '-name';
    let user_tel = user_id + '-tel';
    let user_box = user_id + '-box';
    let course_count = parseInt($('#course_count').text()) - 1;

    $('.' + user_esm).removeClass('bg_green');
    $('.' + user_id).removeClass('bg_green');
    $('.' + user_box).removeClass('bg_green_dark');
    $('.' + user_box).addClass('bg_blue');
    $('.' + user_tel).removeClass('bg_green_dark');
    $('.' + user_id).remove();
    $('#course_count').text(course_count);
    $('#add-' + id).show();
    $('#del-' + id).hide();
};

function add_user_to_course(id) {
    let user_id = 'user-' + id;
    let user_esm = user_id + '-name';
    let user_tel = user_id + '-tel';
    let user_box = user_id + '-box';
    let pos = $('.' + user_box).hasClass('bg_green_dark');
    if (pos == false) {
        let course_count = parseInt($('#course_count').text()) + 1;

        $('.' + user_esm).addClass('bg_green');
        $('.' + user_tel).addClass('bg_green_dark');
        $('.' + user_box).removeClass('bg_blue');
        $('.' + user_box).addClass('bg_green_dark');
        let user_name = $('.' + user_id + '-name .user_info .user_name').text();
        added_btn = '<div class="user_info bg_dark_blue text-white ' + user_id + '" onclick="remove_from_course(' + id + ')"><div class="user_name td_title_ pr-2 mx-auto">' + user_name + '</span></div></div>';
        $('.selected_user').append(added_btn);
        $('#course_count').text(course_count);
        $('#add-' + id).hide();
        $('#del-' + id).show();
    }
};

$('.floatingActionButton').click(function(){
    $('.gray_layer').show();
    $('.add_payments').fadeIn();
});