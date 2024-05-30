<?php
require_once('public_css.php');
require_once('func.php');

$cont = '
<div class="items">
    <fieldset class="hor" style="height: inherit;" id="visit_result">
        <legend>ثبت گزارش ویزیت</legend>
        <span style="margin-top:1rem">نتیجه ویزیت را ثبت کنید : </span>
        <div>
            <textarea class="form-control" id="visit_text" style="margin-bottom: 0.4rem;height: 10rem;width: 19rem;"></textarea>
            <iframe src="https://perfumeara.com/webapp/sound.php" width="1090" height="484" frameborder="0" allowfullscreen="allowfullscreen" allow="geolocation *; microphone *; camera *; midi *; encrypted-media *" title="Audio Recorder"></iframe>
            <!--<iframe src="https://h5p.org/h5p/embed/71393" width="1090" height="484" frameborder="0" allowfullscreen="allowfullscreen" allow="geolocation *; microphone *; camera *; midi *; encrypted-media *" title="Audio Recorder"></iframe>-->
            <script src="https://h5p.org/sites/all/modules/h5p/library/js/h5p-resizer.js" charset="UTF-8"></script>
    
            <div id="buy_pos">
                <button class="btn btn-warning" id="saveResult">ذخیره ویزیت</button>
            </div>
    </fieldset>
</div>';

require_once('header.php'); ?>

<div class="page">
    <?php
    if (isset($_COOKIE['uid'])) {
        echo $cont;
        saveTemp($_COOKIE['uid'], $_POST['code']);
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
<script src="./js/index.js"></script>
<?php require_once('footer.php'); ?>