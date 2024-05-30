<style>
    .header {
        display: inherit;
    }

    .login {
        padding-top: 2rem;
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
</script>