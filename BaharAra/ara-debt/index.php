<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>سامانه وصول مطالبات شرکت بهار آرا خراسان</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link href="css/index.css" rel="stylesheet" />
</head>

<body>

    <div class="container">
        <div class="row top-row align-items-center">
            <div class="col-lg-3">
                <img src="file/logo-ba.png" alt="bahar ara logo">
            </div>
            <div class="col-lg-6">
                <h1>سامانه تسویه حساب بدهکاران</h1>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="separate"></div>
    </div>
    <div class="container">
        <div class="row middle-box">
            <div class="form-group">
                <form action="index.php" method="get">

                    <div class="form-group row">
                        <label for="user_name" class="col-sm-2 col-form-label">نام و نام خانوادگی </label>
                        <div class="col-sm-4">
                            <input type="text" name="user_name" id="user_name" class="form-control">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="user_tel" class="col-sm-2 col-form-label">موبایل</label>
                        <div class="col-sm-4">
                            <input type="tel" name="user_tel" id="user_tel" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="user_addr" class="col-sm-2 col-form-label">آدرس</label>
                        <div class="col-sm-4">
                            <textarea name="user_addr" id="user_addr" class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="user_shop" class="col-sm-2 col-form-label">نام فروشگاه</label>
                        <div class="col-sm-4">
                        <input type="tel" name="user_shop" id="user_shop" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="fee" class="col-sm-2 col-form-label">مبلغ (ریال)</label>
                        <div class="col-sm-4">
                        <input type="number" name="fee" id="fee" class="form-control">
                        </div>
                    </div>
                    <div class="separate"></div>
                    <input type="submit" value="پرداخت" class="btn btn-warning btn-lg">
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous">
    </script>
    <script src="js/index.js"></script>
</body>

</html>

<?php
    if(isset($_REQUEST['fee'])){
        require_once('db.php');

        $user_name = $_REQUEST['user_name'];
        $user_tel = $_REQUEST['user_tel'];
        $user_addr = $_REQUEST['user_addr'];
        $user_shop = $_REQUEST['user_shop'];
        $fee = $_REQUEST['fee'];

        
    }
?>