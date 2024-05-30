function send_ajax(data, value) {
    var info = '';
    if (data == 'start') {
        info = 'start';
    } else {
        info = data;
    }

    $.ajax({
        data: info + '=' + value,
        url: 'server.php',
        method: 'POST',
        success: function (result) {
            if (data == 'start') {
                $('#uids').text(result);
            }
        }
    });
}

function pishraft(x) {
    switch (x) {
        case 0:
            darsad = '8%';
            break;

        case 1:
            darsad = '16%';
            break;

        case 2:
            darsad = '25%';
            break;

        case 3:
            darsad = '33%';
            break;

        case 4:
            darsad = '41%';
            break;

        case 5:
            darsad = '50%';
            break;

        case 6:
            darsad = '58%';
            break;

        case 7:
            darsad = '66%';
            break;

        case 8:
            darsad = '75%';
            break;

        case 9:
            darsad = '83%';
            break;

        case 10:
            darsad = '91%';
            break;

        case 11:
            darsad = '100%';
            break;

        case 12:
            darsad = '100%';
            break;

        case 13:
            darsad = '100%';
            break;
    }

    $('#pishraft').css('width', darsad);
    $('.n' + x).css('background-color', '#131313');
}

function set_start_btn() {
    $('.start').hide();
    $('.lvl-1').css('display', 'flex');
    $('#start').css('margin-top', '3rem');
    pishraft(0);
    $('#age_frame').show();
    send_ajax('start', 'now');
}

$('.q_r1 label').click(function () {
    $('.q_r1 label').css('background-color', 'transparent');
    $(this).css('background-color', '#e5e5e5');
});

function rangeSlider() {
    rang = $('#customRange1').val();
    $('#range_num').html(rang);
}

function nextcell(x) {

    if (x == 1) {
        var age = $(".noUi-tooltip").text();
        send_ajax('q1', age);
        $('.btn-start1').hide();

    } else if (x == 2 || x == 3 || x == 4 || x == 5 || x == 6 || x == 7 || x == 8 || x == 9) {
        var answer = $('#answer').text();
        send_ajax('q' + x, answer);
        $('.btn-start1').hide();

    } else if (x == 10) {
        answer = $('#answer').text();
        send_ajax('q' + x, answer);
        $('.btn-start1').fadeIn();

    } else if (x == 11) {
        var about = $('#about').val();
        send_ajax('q' + x, about);
    }

    prev = x + 1;
    $('.lvl-' + x).hide();
    $('.lvl-' + prev).show();
    $('.lvl-' + prev).css('display', 'flex');

    $('#answer').text('');
    pishraft(x);

}

function sex_type(x) {
    $('#male').css('background-color', 'transparent');
    $('#female').css('background-color', 'transparent');
    $("#" + x).css('background-color', '#b1b1b1');
    $('#answer').text(x);
    $('.btn-start1').fadeIn();
}

function show_result() {
    $('.n12').css('background-color', '#131313');
    var esmi = $('#esmi').val();
    var teli = $('#teli').val();
    var uids = $('#uids').text();

    if (teli.length < 10) {
        alert('نام و شماره موبایل خود را به درستی وارد کنید');
    } else {
        $.ajax({
            data: 'esm=' + esmi + '&teli=' + teli + '&uid=' + uids + '&result=ok',
            url: 'server.php',
            method: 'POST',
            success: function (result) {
            }
        });

        $('.lvl-12').hide();
        $('.result').show();
        setTimeout(function () {
            window.location.assign('result.php?u=' + uids);
        }, 1000);
    }
}

$(":radio").click(function () {
    var data_v = $(this).attr('data-value');
    $('#answer').text(data_v);
    $('.btn-start1').fadeIn();
});

function pic_select(x) {
    $('input[type="radio"]').removeAttr('checked');
    $('img').removeClass('orange');
    $('#' + x).click();
    $('.' + x).addClass('orange');
}