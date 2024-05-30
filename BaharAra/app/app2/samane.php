<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>سامانه های شرکت بهار آرا</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/bootstrap-rtl.min.css">

    <style>
        fieldset {
            width: 100%;
            height: 100%;
            overflow: hidden;
            margin-top: 3rem;
            cursor: auto;
            padding: 0.3rem;
        }

        legend {
            background: #525254;
            width: fit-content;
            padding: 0.3rem;
        }

        .item {
            display: flex;
            flex-direction: column;
            flex-wrap: nowrap;
            align-items: flex-start;
            justify-content: center;
            width: 60%;
            margin: 0 auto;
            height: 100vh;
        }

        .item:hover {
            background-color: transparent;
            border-radius: 0%;
        }

        .items:hover {
            background: #676767;
            border-radius: 0.5rem;
        }

        svg:hover {
            color: #f9f9f9;
        }

        .items {
            display: flex;
            flex-direction: row;
            flex-wrap: nowrap;
            justify-content: space-evenly;
            align-items: center;
            cursor: pointer;
            gap: 0.5rem;
        }

        .sep {
            display: flex;
            flex-direction: row;
            flex-wrap: nowrap;
            align-items: center;
            justify-content: center;
            width: 100%;
        }
    </style>

</head>
<?php
$site_admin = 'https://perfumeara.com/fa/ww/Easy_Installer/wp-admin/';
$site_order = 'https://perfumeara.com/emp/dailyorder.php?date=' . date('Y-m-d');
$insta_order = 'https://barjio.com/order.php?date=' . date('Y-m-d');
$cbd = 'https://perfumeara.com/webapp/app_new/panel/visitors.php?g=cfcd208495d565ef66e7dff9f98764d';
?>
<script>
    function open_web(x) {
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();

        today = yyyy + '-' + mm + '-' + dd;

        if (x == 1) {
            y = 'https://perfumeara.com/fa/ww/Easy_Installer/wp-admin/';
        } else if (x == 2) {
            y = 'https://perfumeara.com/emp/dailyorder.php?date=' + today;

        } else if (x == 3) {
            y = 'https://barjio.com/order.php?date=' + today;
        } else if (x == 4) {
            y = 'https://perfumeara.com/webapp/app_new/panel/visitors.php?g=cfcd208495d565ef66e7dff9f98764d';
        }
        window.open(y, '_blank');
    }
</script>

<body style="background-color: #2c2c2c;">
    <div class="header">
        <div class="item">
            <div class="sep">
                <fieldset>
                    <legend>سامانه های سفارشات مجازی </legend>
                    <div class="items" onclick="open_web(1)">
                        <div class="item_logo">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-person-lock" viewBox="0 0 16 16">
                                <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm0 5.996V14H3s-1 0-1-1 1-4 6-4c.564 0 1.077.038 1.544.107a4.524 4.524 0 0 0-.803.918A10.46 10.46 0 0 0 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h5ZM9 13a1 1 0 0 1 1-1v-1a2 2 0 1 1 4 0v1a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1v-2Zm3-3a1 1 0 0 0-1 1v1h2v-1a1 1 0 0 0-1-1Z" />
                            </svg>
                        </div>
                        <div class="item-title">پنل مدیریت سایت</div>
                    </div>

                    <div class="items" onclick="open_web(2)">
                        <div class="item_logo">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-browser-chrome" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M16 8a8.001 8.001 0 0 1-7.022 7.94l1.902-7.098a2.995 2.995 0 0 0 .05-1.492A2.977 2.977 0 0 0 10.237 6h5.511A8 8 0 0 1 16 8ZM0 8a8 8 0 0 0 7.927 8l1.426-5.321a2.978 2.978 0 0 1-.723.255 2.979 2.979 0 0 1-1.743-.147 2.986 2.986 0 0 1-1.043-.7L.633 4.876A7.975 7.975 0 0 0 0 8Zm5.004-.167L1.108 3.936A8.003 8.003 0 0 1 15.418 5H8.066a2.979 2.979 0 0 0-1.252.243 2.987 2.987 0 0 0-1.81 2.59ZM8 10a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z" />
                            </svg>
                        </div>
                        <div class="item-title">سفارشات سایت</div>
                    </div>

                    <div class="items" onclick="open_web(3)">
                        <div class="item_logo">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                                <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z" />
                            </svg>
                        </div>
                        <div class="item-title">سفارشات اینستاگرام</div>
                    </div>
                </fieldset>
            </div>

            <fieldset>
                <legend>سامانه های بازاریاب ها</legend>
                <div class="sep">
                    <div class="items" onclick="open_web(4)">
                        <div class="item_logo">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                                <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z" />
                            </svg>
                        </div>
                        <div class="item-title">گزارش عملکرد بازاریاب ها به تفکیک بازاریاب و تاریخ(CBD)</div>
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
</body>