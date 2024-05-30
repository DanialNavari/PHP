<?php
require_once('header.php');
require_once('public_css.php');
require_once('func.php');
$info = getInfo($_COOKIE['uid']);
$f_id = $info['factor_id'];

/* if ($info['visit_pos'] == '+') {
    $tarikh = date('Y-m-d');
    $link = '<a target="_blank" href="https://perfumeara.com/webapp/app1/panel/factor.php?f=' . $f_id . '&d=' . $tarikh . '">نمایش فاکتور</a>';
} else {
    $link = '';
} */
$cont = '
<div class="items">
    <fieldset class="hor" style="height: inherit;" id="visit_result">
        <legend>ثبت گزارش ویزیت</legend>
        <span style="margin-top:1rem">نتیجه ویزیت را ثبت کنید : </span>
        <div>
            <textarea class="form-control" id="visit_text" style="margin-bottom: 0.4rem;height: 10rem;width: 19rem;"></textarea>
            <!--<iframe src="https://perfumeara.com/webapp/sound.php" width="1090" height="484" frameborder="0" allowfullscreen="allowfullscreen" allow="geolocation *; microphone *; camera *; midi *; encrypted-media *" title="Audio Recorder"></iframe>-->
            <!--<iframe src="https://h5p.org/h5p/embed/71393" width="1090" height="484" frameborder="0" allowfullscreen="allowfullscreen" allow="geolocation *; microphone *; camera *; midi *; encrypted-media *" title="Audio Recorder"></iframe>-->
            <script src="https://h5p.org/sites/all/modules/h5p/library/js/h5p-resizer.js" charset="UTF-8"></script>
            <input type="hidden" id="link" value="https://perfumeara.com/webapp/app1/panel/factor.php?f=' . $f_id . '&d=' . $tarikh . '"/>
            <div id="buy_pos">
                <button class="btn btn-warning" id="saveResult" onclick="saveResult()">ذخیره ویزیت</button>
            </div>
    </fieldset>
</div>';
?>

<div class="final">
    <div class="final_icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
        </svg><br><br>
    </div>
    <div class="final_result">سفارش شما با موفقیت ثبت و ارسال شد</div>
    <div class="final_link">برای مشاهده فاکتور روی لینک زیر کلیک کنید:<br><br>
        <?php echo $link; ?><br><br>
        <button class="btn btn-warning" id="new_visit">شروع مجدد</button>
    </div>
</div>

<div class=" page">
    <?php
    if (isset($_COOKIE['uid'])) {
        echo $cont;
        saveTemp($_COOKIE['uid'], $_POST['code']);
    } else if (isset($_GET['final'])) {
        echo $final;
    } else {
        require_once('def1.php');
    }
    ?>
</div>

<?php
$page_title = '<b style="color:#94f14f">C</b>ustomers <b style="color:#94f14f">B</b>usiness <b style="color:#94f14f">D</b>evelopment';
$back = 1;
require_once('slider.php'); ?>
<input type=" hidden" id="uid" value="<?php echo $_COOKIE['uid']; ?>" />
<script src="./js/jquery-3.4.1.min.js"></script>
<script src="./js/index.js"></script>
<?php require_once('footer.php'); ?>