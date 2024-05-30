<?php
require_once '../func.php';
require_once 'jdf.php';
require_once 'formDetailCss.php';

?>
<link rel="stylesheet" href="../css/index.css" />


<?php
$mission = [];
$users = [];
$seller_  = '';
$customer_sign_   = '';

function masir($id)
{
    $sql = "SELECT * FROM masir WHERE `id` = $id";
    $result = mysqli_query($GLOBALS['conn'], $sql);
    $r = mysqli_fetch_assoc($result);
    return $r['city'];
}

function mission($id)
{
    db();
    $sql = "SELECT * FROM mission WHERE `id` =" . $id;
    $result = mysqli_query($GLOBALS['conn'], $sql);
    if ($result) {
        $num = mysqli_num_rows($result);
        $r = mysqli_fetch_assoc($result);
        $GLOBALS['mission'] = [
            'id' => $r['id'],
            'uid' => $r['uid'],
            'mission_name' => $r['mission_name'],
            'date' => $r['date'],
            's_fa' => $r['start_fa'],
            'e_fa' => $r['end_fa'],
            'route' => $r['route'],
            'vehicle_name' => $r['vehicle_name'],
            'vehicle_num' => $r['vehicle_num'],
            'home' => $r['home'],
            'food' => $r['food'],
            'travel' => $r['travel'],
            'sign' => $r['sign'],
            'accept_time' => $r['accept_time'],
        ];
    }
}

function users($uid)
{
    db();
    $sql = "SELECT * FROM customers WHERE `uid`=" . $uid;
    $result = mysqli_query($GLOBALS['conn'], $sql);
    if ($result) {
        $r = mysqli_fetch_assoc($result);
        $GLOBALS['users'] = [$r['family'], $r['mtel'], $r['sign'], $r['semat']];
    }
}

mission($_GET['id']);
users($mission['uid']);

$seller_pic = 'https://perfumeara.com/webapp/app2/img/users/' . $mission['uid'] . '.jpg';
$seller_sign = $users[3];
$sign = $mission['sign'];


$accept_time = explode(',', $mission['accept_time']);
if (isset($accept_time[0])) {
    $a1 = explode(' ', $accept_time[0]);
    $timestamp11 = strtotime($a1[0]);
    $supervisor_signs = ''; //jdate("d F", $timestamp11);
    $supervisor_ = $a1[1];
}

if (isset($accept_time[1])) {
    $a2 = explode(' ', $accept_time[1]);
    $timestamp22 = strtotime($a2[0]);
    $supervisor_signs = ''; //jdate("d F", $timestamp11);
    $manager_ = $a2[1];
}

if (isset($accept_time[2]) && strlen($accept_time[2]) > 0) {
    $a3 = explode(' ', $accept_time[2]);
    $timestamp33 = strtotime($a3[0]);
    $supervisor_signs = ''; //jdate("d F", $timestamp11);
    $hesabdari_ = $a3[1];
}

if (isset($hesabdari_)) {
} else {
    $hesabdari_ = '';
    $login[1] = '';
    $logout[1] = '';
}

if (isset($seller_signs)) {
} else {
    $seller_signs = '';
    $login[1] = '';
    $logout[1] = '';
}

if (isset($customer_signs)) {
} else {
    $customer_signs = '';
}

if (isset($supervisor_signs)) {
} else {
    $supervisor_signs = '';
}

if (isset($manager_signs)) {
} else {
    $manager_signs = '';
}

if (isset($hesabdari_signs)) {
} else {
    $hesabdari_signs = '';
}

?>

<div class="watermark"><?php echo $mission['mission_name']; ?></div>

<div class="factor_detail">
    <table style="width:100%;">
        <tr>
            <th class="border_left" style="text-align: center;">
                <div class="logos">
                    <img src="../img/bgh.png" style="width: 4rem" />
                </div>
            </th>
            <th class="border_left" style="border-left: 1px dashed silver;text-align: center;width:12rem">
                <img id="seller_pic" src="<?php echo $seller_pic; ?>" style="margin: 0 auto;outline: none; border: none;width:4rem;display:block;" />

                <?php
                echo '
                    <span id="seller_name">' . $users[0] . '<br/>
                    </span>' . $users[1];
                ?>
            </th>
            <?php
            switch ($_GET['type']) {
                case 'mission':
                    $f_type = 'ماموریت';
                    $e_type = 'Mission';
                    break;
                case 'rest':
                    $f_type = 'مرخصی';
                    $e_type = 'Leave';
                    break;
                case 'donate':
                    $f_type = 'مساعده';
                    $e_type = 'Advance Money';
                    break;
            }

            ?>
            <th style="width:20rem;text-align: center;border-left: 1px dashed silver;">
                <h3> <?php echo $f_type; ?></h3>
                <h3 class="english"><?php echo $e_type; ?> </h3>
            </th>

            <th class="border_right" style="width: 10rem; text-align: center;border-left: 1px dashed silver;direction: rtl;">
                <h5>شماره سند: </h5><br />
                <h2 style="background-color: #000;color:#fff;text-align:center"><?php echo $_GET['id']; ?></h2>
            </th>

            <th id="tarikh_saat" class="border_right" style="width: 16vw;border-left: 1px dashed silver;padding-right: 1rem;">
                <h4><?php
                    $e = explode(' ', $mission['date']);
                    $timestamp = strtotime($e[0]);
                    $jalali_date = jdate("Y/m/d", $timestamp);
                    echo $jalali_date;
                    ?></h4>
                <h4><?php echo $e[1]; ?></h4>
            </th>
        </tr>
    </table>
    <table style="direction: rtl; padding: 0.5rem;width:100%;">
        <tr>
            <td style="width: 25%;">نام مشتری : </td>
        </tr>
    </table>

</div>

<input type="hidden" id="click_name" value="" />
<input type="hidden" id="super_permission" value="<?php echo $super_permission; ?>" />
<input type="hidden" id="manager_permission" value="<?php echo $manager_permission; ?>" />

<script src="../js/jquery.min.js"></script>

<script>
    $('svg.ok').click(function() {
        $(this).addClass('svg_ok');
        $(this).css('opacity', 1);
        $(this).siblings('.no').css('opacity', '0.5');
        $(this).siblings('.no').removeClass('svg_no');
    });

    $('svg.no').click(function() {
        $(this).addClass('svg_no');
        $(this).css('opacity', 1);
        $(this).siblings('.ok').css('opacity', '0.5');
        $(this).siblings('.ok').removeClass('svg_ok');
    });

    desc = $('#factor_desc').text();
    customer_name = $('#customer_name').text();
    seller_name = $('#seller_name').text();

    function set_admin_sign(code, post_title) {
        $.ajax({
            type: "GET",
            data: {
                sign: code,
            },
            url: 'https://perfumeara.com/webapp/app_new/server.php',
            success: function(result) {
                $('#' + post_title + ' ._img').attr('src', result);
                $('.' + post_title).hide();

                let cnsl = $('#cancel').val();
                if (cnsl == 1) {
                    $('.manager_accept').hide();
                    $('#manager img').attr('src', 'cancel.png').show();
                }
            }
        });
    }

    var f_id = $('#f_id').val();
    $.ajax({
        type: "GET",
        data: {
            accept: f_id,
        },
        url: 'https://perfumeara.com/webapp/app_new/server.php',
        success: function(result) {
            if (result == '') {
                $('#supervisor').show();
                $('#manager').show();
                $('#admin').show();

                $('#supervisor ._img').hide();
                $('#manager ._img').hide();
                $('#admin ._img').hide();

                $('.manager').hide();
                $('.manager_accept').hide();
                $('.admin').hide();

            } else {
                accpt = result.split(',');

                if (isNaN(parseInt(accpt[0]))) {
                    $('#supervisor').show();
                    $('#supervisor ._img').hide();
                } else {
                    set_admin_sign(accpt[0], 'supervisor');
                    $('#supervisor').show();
                }

                if (isNaN(parseInt(accpt[1]))) {
                    $('#manager').show();
                    $('.manager_accept').show();
                    $('#manager ._img').hide();
                    $('.admin').hide();
                } else {
                    set_admin_sign(accpt[1], 'manager');
                    $('#manager').show();
                    $('#accountant').show();
                    $('.accountant').show();
                    $('.admin').show();
                    $('.manager_accept').hide();
                }

                if (isNaN(parseInt(accpt[2]))) {
                    $('#accountant').show();
                    $('#accountant ._img').hide();
                } else {
                    set_admin_sign(accpt[2], 'accountant');
                    $('#accountant').show();
                    $('#accountant ._img').show();
                }
            }

        }
    });



    $('.signs button').click(function() {
        var click_name = $(this).attr('id');
        $('#click_name').val(click_name);

        var supervisor_code = parseInt(prompt('کد تایید خود را وارد کنید'));
        if (!isNaN(supervisor_code)) {
            if (parseInt(supervisor_code) < 1) {
                var supervisor_code = parseInt(prompt('کد تایید خود را وارد کنید'));
            } else {
                f_id = $('#f_id').val();
                $.ajax({
                    type: "GET",
                    data: {
                        emza: supervisor_code,
                        factor_id: f_id
                    },
                    url: 'https://perfumeara.com/webapp/app_new/server.php',
                    success: function(result) {
                        if (result == 0) {
                            alert('کد تایید وارد شده نادرست می باشد');
                        } else if (result == -1) {
                            alert('کد تایید وارد شده متعلق به این سمت نمی باشد');
                        } else if (result > 0) {

                            var sign_desc = prompt('توضیحات فاکتور را وارد کنید');
                            $.ajax({
                                type: "GET",
                                data: {
                                    tozih: sign_desc,
                                    click_names: click_name,
                                    f_id: f_id
                                },
                                url: 'https://perfumeara.com/webapp/app_new/server.php',
                                success: function(result) {
                                    alert('فاکتور با موفقیت تایید شد');
                                    window.location.reload();
                                }
                            });

                        }
                    }
                });
            }
        }
    });
</script>