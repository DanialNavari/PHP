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
        <label>نام و نام خانوادگی : </label>
        <br>
        <input type="text" name="family" class="form-control" id="family" />

        <label>شماره همراه : </label>
        <br>
        <input type="tel" name="tel" class="form-control" id="tel" />

        <label>رمز عبور : </label>
        <br>
        <input type="password" name="pass" class="form-control" id="pass" />

        <label>کد فعالسازی : </label>
        <br>
        <input type="text" name="uid" class="form-control" id="uid" />

        <button class=" btn btn-warning btn-over" onclick="chkLogin()">ذخیره</button>
        <button class=" btn btn-warning btn-over" onclick="open_page('default')">بازگشت</button>
    </div>
</div>

<script>
    $('#headTitle').html('ثبت نام کاربر جدید');
</script>