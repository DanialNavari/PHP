<style>
.spacer {
    padding: 0.25rem;
}
.info{
    border-bottom: 1px dashed silver;
    padding-bottom: 0.25rem;
    margin: 0px 0px 0.5rem 0;
}

</style>
<?php 
    require_once('functions.php');
    db();
    get_info($_SESSION['user']);
?>
<div class="cointainer" id="form">
<div class="row info">
        <div class="col">
            <div class="form-group">
                <h3>ویرایش اطلاعات شخصی</h3>
            </div>
        </div>
</div>
    <div class="row info">
        <div class="col">
            <div class="form-group">
                <label class="float-left" for="user_name">نام و نام خانوادگی :
                    <input class="form-control" tabindex="1" type="text" autocomplete="off" id="user_name" required value="<?php echo $u_name;?>">
                </label>
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label class="float-left" for="user_tel"> همراه :
                    <input class="form-control" tabindex="1" type="number" autocomplete="off" id="user_tel" required value="<?php echo $u_tel;?>">
                </label>
            </div>
        </div>
    </div>
    <div class="spacer"></div>
    <div class="row info">
        <div class="col">
            <div class="form-group">
                <label class="float-left" for="user_codem"> کدملی :
                    <input class="form-control" tabindex="1" type="text" autocomplete="off" id="user_codem" required value="<?php echo $u_codem;?>">
                </label>
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label class="float-left" for="pass">رمز عبور :
                    <input class="form-control" tabindex="1" type="text" autocomplete="off" id="pass" required value="<?php echo $u_pass;?>"> 
                </label>
            </div>
        </div>
    </div>
    <div class="row info">
        <div class="col">
            <div class="form-group">
                <label class="float-left" for="personeli"> کد پرسنلی :
                    <span id="personeli"><?php echo $u_pers;?></span>
                </label>
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label class="float-left" for="rule"> سمت :
                    <span id="rule"><?php echo $u_rule;?></span>
                </label>
            </div>
        </div>
    </div><br>
    <button class="btn btn-green" onclick="saveInfo()">ذخیره</button>
</div>
<div class="container">
    <div class="result alert alert-success">✔ تغییرات با موفقیت ذخیره شد</div>
</div>