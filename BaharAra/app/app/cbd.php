<?php require_once('public_css.php');
include_once('func.php');
?>
<div class="load_page" style="display:none">
    <div class="load_item">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hourglass-split" viewBox="0 0 16 16">
            <path d="M2.5 15a.5.5 0 1 1 0-1h1v-1a4.5 4.5 0 0 1 2.557-4.06c.29-.139.443-.377.443-.59v-.7c0-.213-.154-.451-.443-.59A4.5 4.5 0 0 1 3.5 3V2h-1a.5.5 0 0 1 0-1h11a.5.5 0 0 1 0 1h-1v1a4.5 4.5 0 0 1-2.557 4.06c-.29.139-.443.377-.443.59v.7c0 .213.154.451.443.59A4.5 4.5 0 0 1 12.5 13v1h1a.5.5 0 0 1 0 1h-11zm2-13v1c0 .537.12 1.045.337 1.5h6.326c.216-.455.337-.963.337-1.5V2h-7zm3 6.35c0 .701-.478 1.236-1.011 1.492A3.5 3.5 0 0 0 4.5 13s.866-1.299 3-1.48V8.35zm1 0v3.17c2.134.181 3 1.48 3 1.48a3.5 3.5 0 0 0-1.989-3.158C8.978 9.586 8.5 9.052 8.5 8.351z" />
        </svg>
        لطفا کمی صبر کنید ...
    </div>
</div>

<div class="items" style="display: block;">
    <fieldset class='hor' style="height: 30rem;display:none">
        <legend>گزارش ویزیت امروز</legend>
        <div class="cbd_info">
            <div class="row">
                <span>نوع ویزیت (منفی | مثبت) :</span>
                <div class="progress" style="width: 100%;flex-direction: row-reverse;">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width: 30%">3</div>
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%">7</div>
                </div>
            </div>
            <div class="row">
                <span>زمان ویزیت (حضور در فروشگاه) :</span>
                <div class="progress" style="width: 100%;flex-direction: row-reverse;">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 70%">3 ساعت</div>
                </div>
            </div>
            <div class="row">
                <span>زمان غیر ویزیت (استراحت | رسیدن به مقصد) :</span>
                <div class="progress" style="width: 100%;flex-direction: row-reverse;">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" role="progressbar" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100" style="width: 50%">2 ساعت</div>
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100" style="width: 50%">2 ساعت</div>
                </div>
            </div>
            <div class="row">
                <span>نوع مشتری (قدیم | جدید) :</span>
                <div class="progress" style="width: 100%;flex-direction: row-reverse;">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">4</div>
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">6</div>
                </div>
            </div>
            <div class="row">
                <span>وضعیت فاکتور ها : (تایید | رد)</span>
                <div class="progress" style="width: 100%;flex-direction: row-reverse;">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width: 30%">3</div>
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%">7</div>
                </div>
            </div>
            <div class="row">
                <span>وضعیت ویزیت ها (در محدوده | خارج از محدوده)</span>
                <div class="progress" style="width: 100%;flex-direction: row-reverse;">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: 10%">1</div>
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 90%">9</div>
                </div>
            </div>
            <div class="row">
                <span>پوشش ویزیت (پایگاه های ویزیت شده | پایگاه های ویزیت نشده)</span>
                <div class="progress" style="width: 100%;flex-direction: row-reverse;">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" aria-valuenow="22" aria-valuemin="0" aria-valuemax="100" style="width: 22%">22</div>
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="78" aria-valuemin="0" aria-valuemax="100" style="width: 78%">78</div>
                </div>
            </div>
            <div class="row">
                <span>منطقه ویزیت : </span>
                <div id="my_hood"></div>
            </div>

        </div>
    </fieldset>
    <fieldset class='hor' style="margin-top: 1rem; height: fit-content;">
        <legend></legend>
        <div class="cbd_operator">
            <div class="row">
                <?php
                $company = load_seller_shift($_COOKIE['uid'], '#');
                if ($company > 0) {
                } else {
                }
                ?>
                <button class="btn btn-warning btn-half" id="visit" onclick="open_page('visit','loc','ok',1, true);">ثبت ویزیت </button>
            </div>
        </div>
    </fieldset>
</div>

<?php
$page_title = 'ثبت گزارش مسیر روزانه';
$back = 1;
require_once('slider.php'); ?>
<input type="hidden" id="uid" value="<?php echo $_COOKIE['uid']; ?>" />
<input type="hidden" id="loc_id" value="" />
<script src="./js/index.js"></script>