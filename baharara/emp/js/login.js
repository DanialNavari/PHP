$('#loginBtn').on('click', function () {
    var state = parseInt($('#state').val());
    if (state == 1)
        setToLogin();
    else
        login();
});

//*************************************** send verification code ***************************************
function setToLogin() {
    var percode = $('#perCode').val();
    var nationalcode = $('#nationalCode').val();
    var selectDomain = $('#select_domain').val();
    
    if (percode > 0 & nationalcode.length > 0) {
        $('#spinner').removeClass('d-none');
        var validator = $('#frmLogin');
        var token = $('input[name="__RequestVerificationToken"]', validator).val();
        var model = { PerCode: percode, NationalCode: nationalcode, Domain : selectDomain };
        $.ajax({
            url: $('#requestUrl').data('request-url'),
            dataType: "json",
            type: "POST",
            cache: false,
            data: {
                __RequestVerificationToken: token,
                modelBinding: model
            },
            success: function (data) {
                $('#spinner').addClass('d-none');
                if (data.isSuccess) {
                    $('#verifyDiv').removeClass('d-none');
                    $('#perCodeDiv').hide();
                    $('#nationalCodeDiv').hide();
                    $('#select_domain').hide();
                    document.getElementById('titleBtn').innerText = 'ورود'
                    document.getElementById("loginBtn").tabIndex = "4";
                    var twoMinutes = 60 * 5,
                        display = document.querySelector('#time');
                    
                    startTimer(twoMinutes, display);
                    $('#state').val('2');
                    $("#verifyCode").focus();
                }
                else {
                    
                    $('#errorSection').removeClass('d-none');
                    $('#errorText').removeClass('d-none');
                    document.getElementById('errorText').innerText = data.msg;
                    showSection();
                  
                }
            },
            error: function (xhr) {
                $('#spinner').addClass('d-none');
                alert(xhr.responseText);
            }
        });
    };
}
//******************************** get verification code again method ***********************************
function getVerificationCodeAgain() {
    $('#time').removeClass('d-none');
    $('#reSendCode').addClass('d-none');
    setToLogin();
}

//******************************** function for countdown ***********************************************
function startTimer(duration, display) {
    
    var timer = duration, minutes, seconds;
    var interval = setInterval(function () {
        minutes = parseInt(timer / 60, 10);
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.textContent = minutes + ":" + seconds;
        if (--timer < 0) {
            timer = duration;
            $('#time').addClass('d-none');
            $('#reSendCode').removeClass('d-none');
            
            clearInterval(interval);
        }
    }, 1000);
}

//******************************** login method *********************************************************
function login() {
    var percode = $('#perCode').val();
    var vercode = $('#verifyCode').val();
    var nationalcode = $('#nationalCode').val();
    if (percode > 0) {
        $('#spinner').removeClass('d-none');
        var model = { VerificationCode: vercode, PerCode: percode, NationalCode: nationalcode };
        var validator = $('#frmLogin');
        var token = $('input[name="__RequestVerificationToken"]', validator).val();
        $.ajax({
            url: validator.data('request-url'),
            dataType: "json",
            type: "POST",
            cache: false,
            data: {
                __RequestVerificationToken: token,
                modelBinding: model
            },
            success: function (data) {
                $('#spinner').addClass('d-none');
                if (data.isSuccess == true) {
                    sessionStorage.clear();
                    window.location.href = '/Home/Index';
                }
                else {
                    $('#errorSection').removeClass('d-none');
                    $('#errorText').removeClass('d-none');
                    document.getElementById('errorText').innerText = data.msg;
                    showSection();
                }


            },
            error: function (xhr) {
                $('#spinner').addClass('d-none');
                alert(xhr.responseText);
                
            }
        });
    }
}

window.onload = function () {
    $("#perCode").focus();
    
};
function showSection() {
    var timer = 5, minutes, seconds;
    var stopinterval = setInterval(function () {
        minutes = parseInt(timer / 60, 10);
        seconds = parseInt(timer % 60, 10);
        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;
        if (--timer < 0) {
            $('#errorSection').addClass('d-none');
            $('#errorText').addClass('d-none');
            clearInterval(stopinterval);
        }
    }, 1000);
}



$(document).ready(function () {
    setInputFilter(document.getElementById("perCode"), function (value) {
        return /^-?\d*$/.test(value);
    });
    setInputFilter(document.getElementById("nationalCode"), function (value) {
        return /^-?\d*$/.test(value);
    });
    setInputFilter(document.getElementById("verifyCode"), function (value) {
        return /^-?\d*$/.test(value);
    });
});
