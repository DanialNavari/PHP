<style>
    .header {
        display: inherit;
    }

    .login {
        padding-top: 2rem;
    }

    .bg {
        height: 100vh;
    }
</style>
<div class="bg">

    <div id="middle_logo">
        <img src="img/logo.png" alt="logo" id="logo">
    </div>

    <div class="login">
        <label>شماره همراه : </label>
        <br>
        <input type="tel" name="tel" class="form-control" id="tel" />

        <label>رمز عبور : </label>
        <br>
        <input type="password" name="pass" class="form-control" id="pass" />
        <button class=" btn btn-warning btn-over" onclick="Login()">ورود</button>
        <button class=" btn btn-warning btn-over" onclick="open_page('default',null,null,null,false)">بازگشت</button>
    </div>
</div>

<script>
    $('#headTitle').html('ورود به پنل کاربری');

    function chkLogin() {
        mtel = $("#tel").val();
        pass = $("#pass").val();
        family = $("#family").val();
        uid = $("#uids").val();

        $.ajax({
            url: "server.php",
            data: "tel=" +
                mtel +
                "&pass=" +
                pass +
                "&family=" +
                family +
                "&uid=" +
                uid +
                "&type=register",
            type: "POST",
            success: function(result) {
                switch (result) {
                    case "0.1":
                        alert("نام و نام خانوادگی خود را وارد کنید");
                        break;
                    case "0.2":
                        alert("شماره موبایل را به درستی وارد کنید");
                        break;
                    case "0.3":
                        alert("رمز عبور را وارد کنید");
                        break;
                    case "0.4":
                        alert("کد فعالسازی را وارد کنید");
                        break;
                    case "1":
                        $("mtel").val("");
                        $("family").val("");
                        $("pass").val("");
                        $("uid").val("");
                        open_page("success");
                        break;
                    case "2":
                        alert("کاربری با این مشخصات وجود دارد");
                        break;
                }
            },
        });
    }

    function Login() {
        mtel = $("#tel").val();
        pass = $("#pass").val();

        $.ajax({
            url: "server.php",
            data: "tel=" + mtel + "&pass=" + pass + "&type=login",
            type: "POST",
            success: function(result) {
                if (Number(result) > 0) {
                    $("#mtel").val("");
                    $("#family").val("");
                    $("#pass").val("");
                    $("#uid").val("");
                    open_page("panel", "uid", String(result));
                    window.location.reload();
                } else {
                    alert("شماره موبایل یا رمز عبور نادرست است");
                }
            },
        });
    }
</script>