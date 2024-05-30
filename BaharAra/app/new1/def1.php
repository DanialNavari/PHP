<style>
    .header {
        display: none;
    }

    #logo {
        margin: 15% auto 20% auto
    }
</style>
<div class="bg" style="height:100vh">

    <div id="middle_logo">
        <img src="img/logo.png" alt="logo" id="logo">
    </div>
    <div id="demo" style="color: #fff;"></div>
    <div class="login">
        <button class=" btn btn-warning btn-over" onclick="open_page('login',null,null,null,false)">ورود</button>
        <!--         <button class=" btn btn-warning btn-half float-right" onclick="open_page('forget')">فراموشی رمز عبور</button>
        <button class=" btn btn-warning btn-half float-left" onclick="open_page('register')">عضویت</button> -->
    </div>
</div>

<script>
    //let agent = navigator.userAgent;
    //document.getElementById("demo").innerHTML = "User-agent:<br>" + agent;
</script>