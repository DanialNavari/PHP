<?php
require_once 'db.php';
date_default_timezone_set('Asia/Tehran');

if (isset($_POST['code'])) {
    $tel1 = $_SESSION['tel'];
    $codes = $_POST['code'];
    $result = $con->query('SELECT * FROM users WHERE userTel=' . $tel1);
    $count = $result->num_rows;
     if ($count > 0) {
        $row = $result->fetch_assoc();
        if ($row['code'] == $codes) {
            $_SESSION['name'] = $row['userName'];
            $_SESSION['rule'] = $row['rule'];
            $result = $con->query('UPDATE users SET lastLogin=' . time() . ' WHERE userTel=' . $tel1);
            if($result){require_once 'panel.php';}
        }else {
            $message = '<span class="alert alert-danger">کد وارد شده نادرست می باشد</span>';
            require_once 'message.php';
        } 
    }else{
        $message = '<span class="alert alert-danger">شماره وارد شده در سامانه ثبت نشده است</span>';
        require_once 'message.php';  
    } 

} else {
    echo '
    <div class="row login">
    <fieldset>
        <legend class="text-primary">
            وصول مطالبات
        </legend>
        <form action="." method="post" class="form"><br />
            <label for="code">کدی که پیامک شده را وارد کنید</label><input type="tel" name="code" id="code"
                class="form-control" required /><br />
            <input type="submit" value="تایید" class="btn btn-success">
        </form>
    </fieldset>
    <br /><br />
</div>
    ';
}
?>