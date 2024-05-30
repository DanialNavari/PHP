<?php
require_once('public_css.php');
require_once('func.php');
$infos = getUidInfo($_COOKIE['uid']);
$x = get_return_cheqs($infos['family']);

$z = '';
$sum = 0;

$y = count($x);
for ($i = 0; $i < $y; $i++) {
    $customer = $x[$i]['customer'];
    $tarikh = $x[$i]['tarikh'];
    $owner = $x[$i]['owner'];
    $cheq_num = $x[$i]['cheq_num'];
    $cost = $x[$i]['cost'];
    $cost_add = $x[$i]['cost_add'];
    $cost_remain = $x[$i]['cost_remain'];
    $desc1 = $x[$i]['desc1'];
    $desc2 = $x[$i]['desc2'];

    $sum += intval($cost_remain);

    $j = $i + 1;
    $z .= '        
    <table id="ttarget" style="user-select: none;">
    <tr>
        <td rowspan="6" style="padding: 1rem; font-size: 2rem; border: 1px solid #fff;">' . $j . '</td>
        <th style="width:50%">
            تاریخ:
            ' . $tarikh . '
        </th>
        <th>
            مشتری:
            ' . $customer . '
        </th>
    </tr>
    <tr>
        <th colspan="2">
            صاحب حساب:
            ' . $owner . '
        </th>
        
    </tr>
    <tr>
        <th>
            شماره چک:
            ' . $cheq_num . '
        </th>
        <th colspan="2">
            کل مانده:
            ' . sep3(intval($cost)) . ' ریال
        </th>
    </tr>
    <tr>
        <th>
            آخرین واریزی:
            ' . sep3(intval($cost_add)) . ' ریال
        </th>
        <th style="color:#00eefb">
            مبلغ باقی مانده:
            ' . sep3(intval($cost_remain)) . ' ریال
        </th>
    </tr>
    <tr>
        <th>
            پیگیری اول: 
            ' . $desc1 . '
        </th>
        <th>
            پیگیری دوم: 
          ' . $desc2 . '
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
        width: 90% !important;
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
        <legend>لیست چک های برگشتی</legend>
        <h5>جمع کل: <span><?php echo sep3($sum); ?> ریال</span></h5>
        <button class="btn btn-info" id="return" onclick="open_page('enter')">بازگشت</button>
        <?php echo $z; ?>
    </fieldset>
</div>

<script>
    $('li').click(function() {
        $('li').removeClass('active');
        $(this).addClass('active');
    });
</script>

<?php
$page_title = 'چک های برگشتی مشتریان من';
$back = 1;
require_once('slider.php'); ?>