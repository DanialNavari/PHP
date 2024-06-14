let cd;
function page(type, route, name = null) {
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
    $('.add_course').fadeOut();
    $('.add_fee').fadeOut();
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
    let user_box = user_id + '-box';
    let pos = $('.' + user_box).hasClass('bg_green_dark');
    if (pos == false) {
        let course_count = parseInt($('#course_count').text()) + 1;

        $('.' + user_esm).addClass('bg_green');
        $('.' + user_box).removeClass('bg_blue');
        $('.' + user_box).addClass('bg_green_dark');
        let user_name = $('.' + user_esm + ' .user_info .star span').text();
        added_btn = '<div class="user_info bg_dark_blue text-white ' + user_id + '" onclick="remove_from_course(' + id + ')"><div class="user_name td_title_ pr-2 mx-auto">' + user_name + '</span></div></div>';
        $('.selected_user').append(added_btn);
        $('#course_count').text(course_count);
    }
};

$('.floatingActionButton').click(function () {
    $('.gray_layer').show();
    $('.add_payments').fadeIn();
});

function payment(pay_id = 0) {
    $('.gray_layer').show();
    $('.add_payments').fadeIn();
}

function moneyLimit() {
    $('.gray_layer').show();
    $('.add_fee').fadeIn();
}

function course() {
    $('.gray_layer').show();
    $('.add_course').fadeIn();
}

/* Start programming */
function navigate(page) {
    window.location.assign(page);
}

function Toast(message) {
    $('.alertBox .alert span').text(message);
    $('.alertBox').fadeIn(300);
    $('.rapid_access div').hide();
    hide_After_time(3000);
}

function login() {
    let tel = $('#tel').val();
    const zaman = new Date();
    if (tel.length == 11) {
        $.ajax({
            type: "POST",
            url: "server.php",
            data: "tel=" + tel + '&login=' + zaman.getTime(),
            success: function (response) {
                if (response == true) {
                    navigate('sms.php');
                } else {
                    Toast('خطا 101');
                }
            }
        });
    } else {
        Toast('شماره تلفن را به صورت صحیح وارد کنید');
    }
}

$('.btn-close').click(function () {
    $('.alertBox').fadeOut('slow');
});

function hide_After_time(time) {
    const hide_After_time = setTimeout(function () {
        $('.alertBox').fadeOut('slow');
        $('.rapid_access div').fadeIn('slow');
        $('input').css('border', '1px solid #ced4da');
    }, time);
}

function check_code() {
    var c1 = $('#c1').val();
    var c2 = $('#c2').val();
    var c3 = $('#c3').val();
    var c4 = $('#c4').val();
    var c5 = $('#c5').val();
    var c6 = $('#c6').val();

    let user_code = c6 + '' + c5 + '' + c4 + '' + c3 + '' + c2 + '' + c1;

    $.ajax({
        type: "POST",
        url: "server.php",
        data: 'verify=' + user_code,
        success: function (response) {
            if (response == 1) {
                clearInterval(cd);
                navigate('.');
            } else if (response == 0) {
                Toast("خطا 102 - کد وارد شده نادرست می باشد");
                $('#c1').val("");
                $('#c2').val("");
                $('#c3').val("");
                $('#c4').val("");
                $('#c5').val("");
                $('#c6').val("");
            }
        }
    });
}

function countLess() {
    let value = parseInt($('#remain_time').text()) - 1;
    if (value < 0) {
        clearInterval(cd);
        navigate('login.php');
    } else {
        $('#remain_time').text(value);
    }
}

function countDown() {
    $('#remain_time').text('60');
    cd = setInterval(countLess, 1000);
}

function next_place(event, id) {
    let value = event.key;
    if (value == 'Backspace') {
        if (id == 6) {
            $('#c' + id).val("");
        } else {
            let number_box = $('#c' + id).val();
            if (number_box > 0) {
                $('#c' + id).val("");
            } else {
                $('#c' + (id + 1)).focus();
                $('#c' + id).val("");
                $('#c' + (id + 1)).val("");
            }
        }
    } else {
        $('#c' + (id - 1)).focus();
    }
}

function change_value(input_id, text_id) {
    var newData = $('#' + input_id).val();
    if (newData.length > 0) {
        $('#' + text_id).text(newData);
        $('.gray_layer').click();
        $('#newCourseName').val("");
    } else {
        $('.gray_layer').click();
    }
}

function addNewContact() {
    var contact_name = $('#newContactName').val();
    var contact_tel = $('#newContactTel').val();
    if (contact_name.length > 0) {
        $.ajax({
            data: 'add_contact=ok&contact_name=' + contact_name + '&contact_tel=' + contact_tel,
            url: 'server.php',
            type: 'POST',
            success: function (response) {
                if (response == true) {

                } else {
                    Toast('خطای 103 - ثبت مخاطب جدید ناموفق بود');
                    alert_border('newContactTel');
                    alert_border('newContactName');
                }
            }
        });
    } else {
        Toast('خطای 104- نام مخاطب را وارد کنید');
        alert_border('newContactName');
    }
}

function alert_border(element_id) {
    $('#' + element_id).css('border', '1px solid #E91E63');
}

function bormal_border(element_id) {
    $('#' + element_id).css('border', '1px solid #ced4da;');
}

function searchContact() {
    var search = $('.search_box').val();
    if (search == '') {
        $(".contactBox").show();
    } else {
        $(".contactBox").hide();
        $(".contactBox").filter("[data*='" + search + "']").show();
    }
}

