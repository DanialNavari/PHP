<?php
require_once('public_css.php');
require_once('func.php');
$infos = getUidInfo($_COOKIE['uid']);
$x = getRemainCash($infos['family']);

$z = '';

$y = count($x);
for ($i = 0; $i < $y; $i++) {
    $no = $x[$i]['no'];
    $cat = $x[$i]['cat'];
    $tarikh = $x[$i]['tarikh'];
    $fee = $x[$i]['fee'];
    $customer = $x[$i]['customer'];
    $pos = $x[$i]['pos'];
    $date_pos = $x[$i]['date_pos'];
    $desc_pos = $x[$i]['desc_pos'];
    $desc = $x[$i]['desc'];

    $z .= '        
    <table id="ttarget" style="user-select: none;">
    <tr>
        <th style="width:50%">
            شماره فاکتور: ' . $no . '
        </th>
        <th>
            نوع فاکتور: ' . $cat . '
        </th>
    </tr>
    <tr>
        <th colspan="2">
            تاریخ فاکتور: ' . $tarikh . '
        </th>  
    </tr>
    <tr>
        <th colspan="2">
            مشتری: ' . $customer . '
        </th>
    </tr>
    <tr>
        <th colspan="2">
            کل مانده: ' . sep3($fee) . '
        </th>
    </tr>
    <tr>
        <th colspan="2">
            آخرین مانده: ' . sep3(intval($desc_pos)) . '
        </th>
    </tr>
    <tr>
        <th colspan="2">
            تاریخ آخرین پیگیری: ' . $date_pos . '
        </th>
    </tr>
    <tr>
        <th style="color:#00eefb" colspan="2">
        توضیحات: ' . $desc . '
        </th>   
    </tr>
</table>';
}

?>
<style>
    fieldset {
        height: fit-content;
        display: flex;
        flex-direction: column;
        flex-wrap: nowrap;
        align-items: center;
        justify-content: space-around;
    }

    table {
        margin: 1rem auto;
        width: 85vw;
        font-size: 0.9rem;
    }

    th {
        padding: 0.2rem;
        border: 1px solid #fff;
        color: white;
    }

    a,
    a:visited {
        color: greenyellow;
        cursor: pointer;
        text-decoration: none;
    }
</style>

<div class="items">
    <fieldset class='hor'>
        <legend>لیست همه مانده حساب ها</legend>
        <p>کلیه قیمت ها به ریال می باشد</p>
        <?php echo $z; ?>
        <button class="btn btn-info" id="return" onclick="open_page('enter')">بازگشت</button>
    </fieldset>
</div>

<script>
    $('li').click(function() {
        $('li').removeClass('active');
        $(this).addClass('active');
    });
</script>

<?php
$page_title = 'مانده حساب های من';
$back = 1;
require_once('slider.php'); ?>