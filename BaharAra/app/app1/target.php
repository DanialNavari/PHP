<?php require_once('public_css.php'); ?>
<?php require_once('func.php');
$target = target($_COOKIE['uid']);
$div = round(($target / 2000000000) * 100); ?>

<div class="items">
    <fieldset class='hor'>
        <legend>مرداد 1402</legend>
        <div class="progress" style="width: 90%;flex-direction: row-reverse;">
            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="<?php echo $div; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $div; ?>%"><?php echo $div; ?>%</div>
        </div>
        <br>
        <h6>تارگت:
            <span id="target">2/000/000/000</span> ریال
        </h6>
        <h6>محقق شده:
            <span id="resid">
                <?php echo $target; ?></span> ریال
        </h6>
        <button class="btn btn-info" id="return" onclick="open_page('enter')">بازگشت</button>

    </fieldset>
</div>



<?php
$page_title = 'تارگت ماهانه';
$back = 1;
require_once('slider.php'); ?>