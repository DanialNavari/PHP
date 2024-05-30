<?php require_once('public_css.php'); ?>
<?php require_once('func.php');
$target = target($_COOKIE['uid']);
$main_target = round(intval($target[100]) / intval($target[200] * 1000), 2) * 100;
$reject = round(intval($target[300]) / intval($target[200] * 1000), 2) * 100;
?>
<div class="items">
    <fieldset class='hor' style="height: fit-content;">
        <legend>شهریور 1402</legend>

        <h4>تارگت</h4>
        <div class="progress" style="width: 90%;flex-direction: row-reverse;">
            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="<?php echo $main_target; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $main_target; ?>%"><?php echo $main_target; ?> %</div>
        </div>
        <br>
        <h4>مرجوعی</h4>
        <div class="progress" style="width: 90%;flex-direction: row-reverse;">
            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="<?php echo $reject; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $reject; ?>%"><?php echo $reject; ?> %</div>
        </div>
        <br>

        <table id="ttarget">
            <tr>
                <td class="t_right">تارگت:</td>
                <td class="t_left"><span id="resid" style="color:greenyellow"><?php echo sep3($target[200] * 1000); ?> تومان </span></td>
            </tr>
            <tr>
                <td class="t_right">مرجوعی:</td>
                <td class="t_left"><span id="resid" style="color: orange;"><?php echo sep3($target[300] * 1000); ?> تومان (<?php echo $reject; ?>%)</span></td>
            </tr>
            <tr>
                <td class="t_right">محقق شده:</td>
                <td class="t_left"><span id="resid" style="color:yellow"><?php echo sep3($target[100]); ?> تومان (<?php echo $main_target; ?>%)</span></td>
            </tr>
            <tr>
                <td class="t_right">کتابی :</td>
                <td class="t_left"><span id="resid"><?php echo sep3($target[0] * 1000); ?></span> تومان</td>
            </tr>
            <tr>
                <td class="t_right">آیفون :</td>
                <td class="t_left"><span id="resid"><?php echo sep3($target[1] * 1000); ?></span> تومان</td>
            </tr>
            <tr>
                <td class="t_right">بادی :</td>
                <td class="t_left"><span id="resid"><?php echo sep3($target[2] * 1000); ?></span> تومان</td>
            </tr>
            <tr>
                <td class="t_right">نیچر100م :</td>
                <td class="t_left"><span id="resid"><?php echo sep3($target[3] * 1000); ?></span> تومان</td>
            </tr>
            <tr>
                <td class="t_right">آرا :</td>
                <td class="t_left"><span id="resid"><?php echo sep3($target[0] * 1000); ?></span> تومان</td>
            </tr>
            <tr>
                <td class="t_right">نیچر30م :</td>
                <td class="t_left"><span id="resid"><?php echo sep3($target[5] * 1000); ?></span> تومان</td>
            </tr>
        </table>

        <button class="btn btn-info" id="return" onclick="open_page('enter')">بازگشت</button>

    </fieldset>

    <!-- <nav class="navbar fixed-bottom navbar-light bg-light">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0" style="display: flex;flex-direction: row-reverse;">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
        </ul>
    </nav> -->
</div>

<script>
    $('li').click(function() {
        $('li').removeClass('active');
        $(this).addClass('active');
    });
</script>
<?php
$page_title = 'تارگت ماهانه';
$back = 1;
require_once('slider.php'); ?>