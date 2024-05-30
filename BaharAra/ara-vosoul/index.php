<?php
session_start();
require_once 'db.php';
require_once 'sms.php';
?>

<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>پنل مشتریان</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="index.css" rel="stylesheet" />

</head>

<body>
    <div class="container">
        <div class="row">
            <div class="logo">
                <img src="logo-ba.png" alt="logo">
            </div>
        </div>
        <!-- costomer panel -->
        <?php
if (isset($_POST['tel'])) {
    $tel = (int) $_POST['tel'];
    $tel1 = $_POST['tel'];
    $num = mt_rand(1111, 9999);
    $text = "کد تایید شما : $num";
    //sendSMS($tel1,$text);
    $result = $con->query('SELECT * FROM users WHERE userTel=' . $tel);
    $count = $result->num_rows;
    if ($count > 0) {
        $result = $con->query('UPDATE users SET code=' . $num . ' WHERE userTel=' . $tel);
        if ($result) {
            $_SESSION['tel'] = $tel;
            require_once 'confirmSMS.php';
        }
    } else {
        $message = '<span class="alert alert-danger">شماره وارد شده در سامانه ثبت نشده است</span>';
        require_once 'message.php';
    }
} elseif (isset($_POST['code'])) {
    require_once 'confirmSMS.php';
} else {
    require_once 'login.php';
}

?>

        <h5>Info@BaharAra.Com</h5>


    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
</script>
<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
<script src="index.js"></script>
</html>