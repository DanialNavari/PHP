function show_error(){
    $('#alert_no').show('slow');
    $('#login_result_no').html('هیچ سفارشی با این مشخصات یافت نشد');
    $('#spinner').addClass('d-none');
}

function login_ok(){
    $('#alert_ok').show('slow');
    $('#login_result_ok').html('کاربر شناسایی شد');
    $('#spinner').addClass('d-none');
}

function open_url(){
    window.location.assign('panel.php');
}

$('#loginBtn').on('click', function () {
    $('#spinner').removeClass('d-none');
    $('#alert_no').hide('slow');
    var tel = $('#user_tel').val();
    var pass = $('#user_pass').val();
    $.ajax({
        url:'server.php',
        type:'POST',
        data:'login=1&tel=' + tel + '&pass=' + pass,
        success:function(result){
            if(result==0){
                setTimeout(show_error, 1000);
            }else if(result==1){
                setTimeout(login_ok, 1000);
                setTimeout(open_url, 3000);
            }
        }
    });
});

$('a').on('click',function(){
    route = $(this).attr('route');
    $('#left_menu').load(route + '.php');
});

function saveInfo(){
    esm = $('#user_name').val();
    tel = $('#user_tel').val();
    codem = $('#user_codem').val();
    pass = $('#pass').val();
    $.ajax({
        url:'server.php',
        type:'POST',
        data:'userInfo=update&tel=' + tel + '&name='+esm+'&codem='+codem+'&pass=' + pass,
        success:function(result){
            if(result==1){
                $('#form').slideUp('slow');
                $('.result').show('slow');
            }
        }
    });
}

$('.btn-link').click(function(){
    $('#left_menu').html('');
});

