<?php
require_once '../func.php';
require_once 'jdf.php';
require_once 'formDetailCss.php';
?>
<link rel="stylesheet" href="../css/index.css" />
<script src="../js/jquery.min.js"></script>


<?php
$mission = [];
$users = [];
$seller_  = '';
$customer_sign_   = '';

$super_pos = '';
$manager_pos = '';
$both_pos = '';
$acc_pos = '';
$night = 0;
$day = 0;


function mission($id)
{
    db();
    $sql = "SELECT * FROM mission WHERE `id` =" . $id;
    $result = mysqli_query($GLOBALS['conn'], $sql);
    if ($result) {
        $r = mysqli_fetch_assoc($result);

        $sqli = "SELECT * FROM customers WHERE `uid` =" . $r['uid'];
        $resultr = mysqli_query($GLOBALS['conn'], $sqli);
        $rr = mysqli_fetch_assoc($resultr);
        $line = $rr['line'];
        $GLOBALS['night'] = $r['night'];
        $GLOBALS['day'] = $r['day'];

        $ll = explode(',', $r['route']);
        $ln = count($ll);
        for ($k = 0; $k < $ln - 1; $k++) {
            $sqlia = "SELECT * FROM `masir` WHERE `id` =" . $ll[$k];
            $resultra = mysqli_query($GLOBALS['conn'], $sqlia);
            $rra = mysqli_fetch_assoc($resultra);
            if ($k < $ln - 2) {
                $GLOBALS['masr'] .= $rra['city'] . ' > ';
            } else {
                $GLOBALS['masr'] .= $rra['city'];
            }
        }


        $GLOBALS['mission'] = [
            'id' => $r['id'],
            'uid' => $rr['family'],
            'u_id' => $r['uid'],
            's_unix' => $r['start_unix'],
            'e_unix' => $r['end_unix'],
            'mission_name' => $r['mission_name'],
            'date' => $r['date'],
            's_fa' => $r['start_fa'],
            'e_fa' => $r['end_fa'],
            'route' => $r['route'],
            'vehicle_name' => $r['vehicle_name'],
            'vehicle_num' => $r['vehicle_num'],
            'p2' => $r['p2'],
            'alph' => $r['alph'],
            'p3' => $r['p3'],
            'p4' => $r['p4'],
            'home' => $r['home'],
            'food' => $r['food'],
            'travel' => $r['travel'],
            'sign' => $r['sign'],
            'accept_time' => $r['accept_time'],
            'codem' => $rr['codem'],
            'eskan' => $rr['home'],
            'khorak' => $rr['food'],
            'ayab' => $rr['travel'],
            'line' => $line,
            'extra_add' => $r['extra_add'],
        ];
    }
}

function last_rest($uid)
{
    db();
    $idd = $_GET['id'];
    $sql = "SELECT * FROM mission WHERE `uid` =$uid AND `type`=2 AND id<$idd ORDER BY id DESC LIMIT 0,5";
    $result = mysqli_query($GLOBALS['conn'], $sql);
    if ($result) {
        $n = mysqli_num_rows($result);
        if ($n > 0) {
            for ($i = 0; $i < $n; $i++) {
                $r = mysqli_fetch_assoc($result);
                $id = $r['id'];
                $s_ = $r['start_fa'];
                $e_ = $r['end_fa'];
                $s_hour = $r['vehicle_name'];
                $e_hour = $r['vehicle_num'];
                $home = $r['home'];
                echo "
                <tr>
                    <td><a href='https://perfumeara.com/webapp/app_new/panel/formRest1.php?id=$id&type=rest'>$id</a></td>
                    <td>$s_</td>
                    <td>$e_</td>
                    <td>$s_hour</td>
                    <td>$e_hour</td>
                </tr>
                <tr>
                    <td colspan='5' style='text-align:right;background:#F5F5F5'>توضیحات: $home</td>
                </tr>
            ";
            }
        } else {
            echo '
            <tr>
                <td colspan="5">-</td>
            </tr>
            ';
        }
    }
}

function users($uid)
{
    db();
    $sql = "SELECT * FROM customers WHERE `uid`=" . $uid;
    $result = mysqli_query($GLOBALS['conn'], $sql);
    if ($result) {
        $r = mysqli_fetch_assoc($result);
        $GLOBALS['users'] = [$r['family'], $r['mtel'], $r['sign'], $r['semat'], $r['codem'], $r['sheba'], $r['bank']];
    }
}

mission($_GET['id']);
users($mission['u_id']);

$seller_pic = 'https://perfumeara.com/webapp/app2/img/users/' . $mission['uid'] . '.jpg';
$seller_sign = $users[3];
$sign = $mission['sign'];
$sign_ = explode(',', $sign);
$accept_time = $mission['accept_time'];
$accept_time_ = explode(',', $mission['accept_time']);

$super_ = '';
$manager__ = '';
$both_ = '';
$acc_ = '';

$id = $_GET["id"];

if (isset($sign_[0]) && $sign_[0] > 0) {
    $super_ = 'https://perfumeara.com/webapp/app1/img/users/sign/' . $sign_[0] . '.jpg';
    $accept_time__ = explode(' ', $accept_time_[0]);
    $timestamp = strtotime($accept_time__[0]);
    $jalali_date = jdate("Y/m/d", $timestamp);
    $super_pos = '
    <td>
    ' . $jalali_date . '<br/>
    ' . $accept_time__[1] . '
    </td>
    ';
} else {
    $super_ = 'https://perfumeara.com/webapp/app1/img/users/nosign.jpg';
    $super_pos = '
    <td>
        <button class="btn btn-success" onclick="super_accept(' . $id . ')">تایید</button>
        <button class="btn btn-danger" onclick="super_decline(' . $id . ')">رد</button>
    </td>';
}

if (isset($sign_[1]) && $sign_[1] > 0) {
    $manager_ = 'https://perfumeara.com/webapp/app1/img/users/sign/' . $sign_[1] . '.jpg';
    $accept_time__ = explode(' ', $accept_time_[1]);
    $timestamp = strtotime($accept_time__[0]);
    $jalali_date = jdate("Y/m/d", $timestamp);
    $manager_pos = '
    <td>
    ' . $jalali_date . '<br/>
    ' . $accept_time__[1] . '
    </td>
    ';
} else {
    $manager_ = 'https://perfumeara.com/webapp/app1/img/users/nosign.jpg';
    $manager_pos = '
    <td>
        <button class="btn btn-success" onclick="manager_accept(' . $id . ')">تایید</button>
        <button class="btn btn-danger" onclick="manager_decline(' . $id . ')">رد</button>
    </td>';
}

if (isset($sign_[2]) && $sign_[2] > 0) {
    $both_ = 'https://perfumeara.com/webapp/app1/img/users/sign/' . $sign_[2] . '.jpg';
    $accept_time__ = explode(' ', $accept_time_[2]);
    $timestamp = strtotime($accept_time__[0]);
    $jalali_date = jdate("Y/m/d", $timestamp);
    $both_pos = '
    <td>
    ' . $jalali_date . '<br/>
    ' . $accept_time__[1] . '
    </td>
    ';
} else {
    $both_ = 'https://perfumeara.com/webapp/app1/img/users/nosign.jpg';
    $both_pos = '
    <td>
        <button class="btn btn-success" onclick="both_accept(' . $id . ')">تایید</button>
        <button class="btn btn-danger" onclick="both_decline(' . $id . ')">رد</button>
    </td>';
}

if (isset($sign_[3]) && $sign_[3] > 0) {
    $acc_ = 'https://perfumeara.com/webapp/app1/img/users/sign/' . $sign_[3] . '.jpg';
    $accept_time__ = explode(' ', $accept_time_[3]);
    $timestamp = strtotime($accept_time__[0]);
    $jalali_date = jdate("Y/m/d", $timestamp);
    $acc_pos = '
    <td>
    ' . $jalali_date . '<br/>
    ' . $accept_time__[1] . '
    </td>
    ';
} else {
    $acc_ = 'https://perfumeara.com/webapp/app1/img/users/nosign.jpg';
    $acc_pos = '
    <td>
        <button class="btn btn-success" onclick="acc_accept(' . $id . ')">تایید</button>
        <button class="btn btn-danger" onclick="acc_decline(' . $id . ')">رد</button>
    </td>';
}

?>
<!DOCTYPE html>
<html lang="fa" style="background:#fff">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>چاپ فرم</title>
    <style>
        .alph,
        .p2,
        .p3,
        .p4 {
            position: absolute;
            padding: 0.5rem;
            font-weight: bold;
            font-size: 1.4rem;
            color: #293330;
        }

        .alph {
            top: 0.1rem;
            right: 8.4rem;
        }

        .pelak {
            position: relative;
            width: 16rem;
        }

        .pelak img {
            width: inherit;
        }

        .p2 {
            top: 0.3rem;
            right: 11.2rem;
            letter-spacing: 0.3rem;
        }

        .p3 {
            top: 0.3rem;
            right: 4rem;
            letter-spacing: 0.3rem;
        }

        .p4 {
            top: 0.3rem;
            right: 0rem;
            letter-spacing: 0.3rem;
        }

        .bold {
            font-weight: bold;
            font-style: italic;
        }

        .info_det {
            display: flex;
            gap: 1rem;
            flex-direction: row;
            align-items: center;
            width: 100%;
            justify-content: center;
            padding: 0.2rem;
        }

        .factor_detail {
            width: 60%;
        }

        .btn-success {
            background: #8BC34A;
        }

        @media print {
            .factor_detail {
                width: 95%;
                gap: 9rem;
            }

            button,
            .btn-success,
            .btn-danger {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="factor_detail">
        <div class="logos">
            <img src="../../app1/img/users/<?php echo $mission['u_id']; ?>.jpg" style="width: 48px;" />
        </div>
        <div class="info bold">
            فرم مرخصی
        </div>
        <div class="logos">
            <img src="https://perfumeara.com/webapp/app1/img/users/200.jpg" style="width: 4rem" />
        </div>
    </div>
    <div class="factor_detail">
        <div class="info info1" style="font-size:0.9rem">
            <span>شماره سند:
                <span class="bold">
                    <?php
                    echo $_GET['id'];
                    $d = explode(' ', $mission['date']);
                    ?>
                </span>
            </span>
            <span>تاریخ :
                <span class="bold">
                    <?php $e = strtotime($d[0]);
                    echo jdate('Y/m/d', $e); ?>
                </span>
            </span>
            <span>شماره سند حسابداری: </span>
        </div>
    </div>
    <div class=" factor_detail">
        <div class="info_det">
            <span>نام و نام خانوادگی: </span> <span class="bold"><?php echo $users[0]; ?></span>
            <span>کدملی : </span> <span class="bold"><?php echo $users[4]; ?></span>
            <span>واحد: </span> <span class="bold"><?php echo $users[3]; ?></span>
        </div>
    </div>

    <?php
    $days = ['Sat' => 'شنبه', 'Sun' => 'یکشنبه', 'Mon' => 'دوشنبه', 'Tue' => 'سه شنبه', 'Wed' => 'چهارشنبه', 'Thu' => 'پنج شنبه', 'Fri' => 'جمعه'];
    $start_day = date('D', $mission['s_unix'] / 1000);
    $end_day = date('D', $mission['e_unix'] / 1000);

    ?>
    <div class="factor_detail">
        <span>از تاریخ : <span class="bold"><?php echo  $mission['s_fa'] . ' (' . $days[$start_day] . ')'; ?></span></span>
        <span>تا تاریخ : <span class="bold"><?php echo $mission['e_fa'] . ' (' . $days[$end_day] . ')'; ?></span></span>
    </div>

    <div class="factor_detail">
        <span>از ساعت: <span class="bold"><?php echo $mission['vehicle_name']; ?></span></span>
        <span>تا ساعت: <span class="bold"><?php echo $mission['vehicle_num']; ?></span></span>
    </div>
    <div class="factor_detail">
        <table style="width:100%">
            <tr>
                <td class="shaba bold" style="text-align:right">مرخصی های قبلی:</td>
            </tr>
            <tr>
                <th style='text-align:center;'>شماره سند</th>
                <th style='text-align:center;'>از تاریخ</th>
                <th style='text-align:center;'>تا تاریخ</th>
                <th style='text-align:center;'>از ساعت</th>
                <th style='text-align:center;'>تا ساعت</th>
            </tr>
            <?php last_rest($mission['u_id']); ?>
        </table>
    </div>
    <?php
    $d = explode(' ', $mission['date']);
    $timestamp = strtotime($d[0]);
    $jalali_date = jdate("Y/m/d", $timestamp);

    ?>
    <div class="factor_detail">
        <table style="width:100%">
            <tr>
                <td>بازاریاب</td>
                <td>سرپرست فروش</td>
                <td>مدیر فروش</td>
                <td>مدیر عامل</td>
                <td>حسابداری</td>
            </tr>
            <tr>
                <td>
                    <img class="sign" src="<?php echo $users[2]; ?>" />
                </td>
                <td>
                    <img class="sign" src="<?php echo $super_; ?>" />
                </td>
                <td>
                    <img class="sign" src="<?php echo $manager_; ?>" />
                </td>
                <td>
                    <img class="sign" src="<?php echo $both_; ?>" />
                </td>
                <td>
                    <img class="sign" src="<?php echo $acc_; ?>" />
                </td>
            </tr>
            <tr>
                <td><?php echo $jalali_date; ?> <br /><?php echo $d[1]; ?> </td>
                <?php echo $super_pos; ?>
                <?php echo $manager_pos; ?>
                <?php echo $both_pos; ?>
                <?php echo $acc_pos; ?>
            </tr>
        </table>
    </div>
    <?php
    if (isset($_GET['pos'])) {
        $type = $_GET['pos'];
    } else {
        $type = '';
    }
    ?>
    <input type="hidden" value="<?php echo $type; ?>" id="print_pos" />

    <script>
        function super_accept(id) {
            var elan = parseInt(prompt(' کد تایید را وارد کنید'));
            if (elan > 0) {
                $.ajax({
                    type: "GET",
                    data: {
                        accept_: 'ok',
                        ids: id,
                        pass: elan,
                        type: 'mission',
                        signer: 'super'
                    },
                    url: 'https://perfumeara.com/webapp/app_new/server.php',
                    success: function(result) {
                        if (result == 1) {
                            alert('فاکتور با موفقیت تایید شد');
                            window.location.reload();
                        } else if (result == 0) {
                            alert('کد وارد شده دسترسی تایید سرپرست ندارد');
                        } else if (result == -1) {
                            alert('کد وارد شده نادرست است');
                        }
                    }
                });
            } else {
                alert('کد تایید را به صورت یک عدد چهار رقمی وارد کنید');
            }
        }

        function manager_accept(id) {
            var elan = parseInt(prompt('کد تایید را وارد کنید'));
            if (elan > 0) {
                $.ajax({
                    type: "GET",
                    data: {
                        accept_: 'ok',
                        ids: id,
                        pass: elan,
                        type: 'mission',
                        signer: 'manager'
                    },
                    url: 'https://perfumeara.com/webapp/app_new/server.php',
                    success: function(result) {
                        if (result == 1) {
                            alert('فاکتور با موفقیت تایید شد');
                            window.location.reload();
                        } else if (result == 0) {
                            alert('کد وارد شده دسترسی تایید مدیر فروش ندارد');
                        } else if (result == -1) {
                            alert('کد وارد شده نادرست است');
                        }
                    }
                });
            } else {
                alert('کد تایید را به صورت یک عدد چهار رقمی وارد کنید');
            }
        }

        function both_accept(id) {
            var elan = parseInt(prompt('کد تایید را وارد کنید'));
            if (elan > 0) {
                $.ajax({
                    type: "GET",
                    data: {
                        accept_: 'ok',
                        ids: id,
                        pass: elan,
                        type: 'mission',
                        signer: 'both'
                    },
                    url: 'https://perfumeara.com/webapp/app_new/server.php',
                    success: function(result) {
                        if (result == 1) {
                            alert('مرخصی با موفقیت تایید شد');
                            window.location.reload();
                        } else if (result == 0) {
                            alert('کد وارد شده دسترسی تایید مدیریت را ندارد');
                        } else if (result == -1) {
                            alert('کد وارد شده نادرست است');
                        }
                    }
                });
            } else {
                alert('کد تایید را به صورت یک عدد چهار رقمی وارد کنید');
            }
        }

        function acc_accept(id) {
            var elan = parseInt(prompt('کد تایید را وارد کنید'));
            if (elan > 0) {
                $.ajax({
                    type: "GET",
                    data: {
                        accept_: 'ok',
                        ids: id,
                        pass: elan,
                        type: 'mission',
                        signer: 'acc'
                    },
                    url: 'https://perfumeara.com/webapp/app_new/server.php',
                    success: function(result) {
                        if (result == 1) {
                            alert('فاکتور با موفقیت تایید شد');
                            window.location.reload();
                        } else if (result == 0) {
                            alert('کد وارد شده دسترسی تایید حسابداری را ندارد');
                        } else if (result == -1) {
                            alert('کد وارد شده نادرست است');
                        }
                    }
                });
            } else {
                alert('کد تایید را به صورت یک عدد چهار رقمی وارد کنید');
            }
        }

        let print_pos = $('#print_pos').val();
        if (print_pos == 'print') {
            $('button').hide();
        }
    </script>

</body>

</html>