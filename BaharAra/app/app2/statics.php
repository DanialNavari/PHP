<?php
if ($_COOKIE['uid'] == 100) {
    $report_pos = 'block';
} else {
    $report_pos = 'none';
}
?>



<?php require_once('public_css.php');
include_once('func.php');
?>


<div class='items' style='display:block'>
    <fieldset class='hor' style="margin-top: 1rem; height: fit-content;display: <?php echo $report_pos; ?>">
        <legend>تارگت</legend>
        <div class="cbd_operator" style="width:97%;">
            <div class="row" style="margin:0rem auto;width: inherit;direction: ltr;">
                <p style="margin-bottom: 0.2rem; font-size: 0.8rem;width: 97%;">درصد تحقق</p>
                <div class="progress" style="width: inherit;">
                    <div class=" progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="34" aria-valuemin="0" aria-valuemax="100" style="width:34%">34%</div>
                </div>
            </div>
        </div>
    </fieldset>

    <fieldset class='hor' style="margin-top: 1rem; height: fit-content;display: <?php echo $report_pos; ?>">
        <legend>ریال فروش</legend>
        <div class="cbd_operator" style="width:97%;">
            <div class="row" style="margin:0rem auto;width: inherit;direction: ltr;">
                <p style="margin-bottom: 0.2rem; font-size: 0.8rem;width: 97%;">روز </p>
                <div class="progress" style="width: inherit;">
                    <div class=" progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="34" aria-valuemin="0" aria-valuemax="100" style="width:34%">34%</div>
                </div>
            </div>
        </div>
        <div class="cbd_operator" style="width:97%;">
            <div class="row" style="margin:0rem auto;width: inherit;direction: ltr;">
                <p style="margin-bottom: 0.2rem; font-size: 0.8rem;width: 97%;">هفته</p>
                <div class="progress" style="width: inherit;">
                    <div class=" progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="34" aria-valuemin="0" aria-valuemax="100" style="width:34%">34%</div>
                </div>
            </div>
        </div>
        <div class="cbd_operator" style="width:97%;">
            <div class="row" style="margin:0rem auto;width: inherit;direction: ltr;">
                <p style="margin-bottom: 0.2rem; font-size: 0.8rem;width: 97%;">ماه</p>
                <div class="progress" style="width: inherit;">
                    <div class=" progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="34" aria-valuemin="0" aria-valuemax="100" style="width:34%">34%</div>
                </div>
            </div>
        </div>
        <div class="cbd_operator" style="width:97%;">
            <div class="row" style="margin:0rem auto;width: inherit;direction: ltr;">
                <p style="margin-bottom: 0.2rem; font-size: 0.8rem;width: 97%;">نسبت فروش به فروش تیم</p>
                <div class="progress" style="width: inherit;">
                    <div class=" progress-bar progress-bar-striped progress-bar-animated bg-warning" role="progressbar" aria-valuenow="34" aria-valuemin="0" aria-valuemax="100" style="width:34%">34%</div>
                </div>
            </div>
        </div>
        <div class="cbd_operator" style="width:97%;">
            <div class="row" style="margin:0rem auto;width: inherit;direction: ltr;">
                <p style="margin-bottom: 0.2rem; font-size: 0.8rem;width: 97%;">نسبت فروش به فروش شرکت</p>
                <div class="progress" style="width: inherit;">
                    <div class=" progress-bar progress-bar-striped progress-bar-animated bg-warning" role="progressbar" aria-valuenow="34" aria-valuemin="0" aria-valuemax="100" style="width:34%">34%</div>
                </div>
            </div>
        </div>
    </fieldset>

    <fieldset class='hor' style="margin-top: 1rem; height: fit-content;display: <?php echo $report_pos; ?>">
        <legend>فروش مشهد</legend>
        <div class="cbd_operator" style="width:97%;">
            <div class="row" style="margin:0rem auto;width: inherit;direction: ltr;">
                <p style="margin-bottom: 0.2rem; font-size: 0.8rem;width: 97%;">نسبت فروش مشهد به فروش کل بازاریاب</p>
                <div class="progress" style="width: inherit;">
                    <div class=" progress-bar progress-bar-striped progress-bar-animated bg-warning" role="progressbar" aria-valuenow="34" aria-valuemin="0" aria-valuemax="100" style="width:34%">34%</div>
                </div>
            </div>
        </div>
        <div class="cbd_operator" style="width:97%;">
            <div class="row" style="margin:0rem auto;width: inherit;direction: ltr;">
                <p style="margin-bottom: 0.2rem; font-size: 0.8rem;width: 97%;">نسبت فروش مشهد به فروش مشهد کل تیم</p>
                <div class="progress" style="width: inherit;">
                    <div class=" progress-bar progress-bar-striped progress-bar-animated bg-warning" role="progressbar" aria-valuenow="34" aria-valuemin="0" aria-valuemax="100" style="width:34%">34%</div>
                </div>
            </div>
        </div>
        <div class="cbd_operator" style="width:97%;">
            <div class="row" style="margin:0rem auto;width: inherit;direction: ltr;">
                <p style="margin-bottom: 0.2rem; font-size: 0.8rem;width: 97%;">نسبت فروش مشهد به فروش مشهد کل شرکت</p>
                <div class="progress" style="width: inherit;">
                    <div class=" progress-bar progress-bar-striped progress-bar-animated bg-warning" role="progressbar" aria-valuenow="34" aria-valuemin="0" aria-valuemax="100" style="width:34%">34%</div>
                </div>
            </div>
        </div>
        <div class="cbd_operator" style="width:97%;">
            <div class="row" style="margin:0rem auto;width: inherit;direction: ltr;">
                <p style="margin-bottom: 0.2rem; font-size: 0.8rem;width: 97%;">نسبت فروش مشهد به تارگت </p>
                <div class="progress" style="width: inherit;">
                    <div class=" progress-bar progress-bar-striped progress-bar-animated bg-warning" role="progressbar" aria-valuenow="34" aria-valuemin="0" aria-valuemax="100" style="width:34%">34%</div>
                </div>
            </div>
        </div>
    </fieldset>

    <fieldset class='hor' style="margin-top: 1rem; height: fit-content;display: <?php echo $report_pos; ?>">
        <legend>فروش شهرستان</legend>
        <div class="cbd_operator" style="width:97%;">
            <div class="row" style="margin:0rem auto;width: inherit;direction: ltr;">
                <p style="margin-bottom: 0.2rem; font-size: 0.8rem;width: 97%;">نسبت فروش شهرستان به فروش کل بازاریاب</p>
                <div class="progress" style="width: inherit;">
                    <div class=" progress-bar progress-bar-striped progress-bar-animated bg-warning" role="progressbar" aria-valuenow="34" aria-valuemin="0" aria-valuemax="100" style="width:34%">34%</div>
                </div>
            </div>
        </div>
        <div class="cbd_operator" style="width:97%;">
            <div class="row" style="margin:0rem auto;width: inherit;direction: ltr;">
                <p style="margin-bottom: 0.2rem; font-size: 0.8rem;width: 97%;">نسبت فروش شهرستان به فروش شهرستان کل تیم</p>
                <div class="progress" style="width: inherit;">
                    <div class=" progress-bar progress-bar-striped progress-bar-animated bg-warning" role="progressbar" aria-valuenow="34" aria-valuemin="0" aria-valuemax="100" style="width:34%">34%</div>
                </div>
            </div>
        </div>
        <div class="cbd_operator" style="width:97%;">
            <div class="row" style="margin:0rem auto;width: inherit;direction: ltr;">
                <p style="margin-bottom: 0.2rem; font-size: 0.8rem;width: 97%;">نسبت فروش شهرستان به فروش شهرستان کل شرکت</p>
                <div class="progress" style="width: inherit;">
                    <div class=" progress-bar progress-bar-striped progress-bar-animated bg-warning" role="progressbar" aria-valuenow="34" aria-valuemin="0" aria-valuemax="100" style="width:34%">34%</div>
                </div>
            </div>
        </div>
        <div class="cbd_operator" style="width:97%;">
            <div class="row" style="margin:0rem auto;width: inherit;direction: ltr;">
                <p style="margin-bottom: 0.2rem; font-size: 0.8rem;width: 97%;">نسبت فروش شهرستان به تارگت </p>
                <div class="progress" style="width: inherit;">
                    <div class=" progress-bar progress-bar-striped progress-bar-animated bg-warning" role="progressbar" aria-valuenow="34" aria-valuemin="0" aria-valuemax="100" style="width:34%">34%</div>
                </div>
            </div>
        </div>
    </fieldset>

    <fieldset class='hor' style="margin-top: 1rem; height: fit-content;display: <?php echo $report_pos; ?>">
        <legend>ویزیت</legend>
        <div class="cbd_operator" style="width:97%;">
            <div class="row" style="margin:0rem auto;width: inherit;direction: ltr;">
                <p style="margin-bottom: 0.2rem; font-size: 0.8rem;width: 97%;">روز (موفق - ناموفق)</p>
                <div class="progress" style="width: inherit;">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100" style="width:66%">66%</div>
                    <div class=" progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="34" aria-valuemin="0" aria-valuemax="100" style="width:34%">34%</div>
                </div>
            </div>
        </div>
        <div class="cbd_operator" style="width:97%;">
            <div class="row" style="margin:0rem auto;width: inherit;direction: ltr;">
                <p style="margin-bottom: 0.2rem; font-size: 0.8rem;width: 97%;">هفته (موفق - ناموفق)</p>
                <div class="progress" style="width: inherit;">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100" style="width:66%">66%</div>
                    <div class=" progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="34" aria-valuemin="0" aria-valuemax="100" style="width:34%">34%</div>
                </div>
            </div>
        </div>
        <div class="cbd_operator" style="width:97%;">
            <div class="row" style="margin:0rem auto;width: inherit;direction: ltr;">
                <p style="margin-bottom: 0.2rem; font-size: 0.8rem;width: 97%;">ماه (موفق - ناموفق)</p>
                <div class="progress" style="width: inherit;">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100" style="width:66%">66%</div>
                    <div class=" progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="34" aria-valuemin="0" aria-valuemax="100" style="width:34%">34%</div>
                </div>
            </div>
        </div>
    </fieldset>

    <fieldset class='hor' style="margin-top: 1rem; height: fit-content;display: <?php echo $report_pos; ?>">
        <legend>فاکتور</legend>
        <div class="cbd_operator" style="width:97%;">
            <div class="row" style="margin:0rem auto;width: inherit;direction: ltr;">
                <p style="margin-bottom: 0.2rem; font-size: 0.8rem;width: 97%;">تعداد فاکتور ها به کل فاکتور های شرکت</p>
                <div class="progress" style="width: inherit;">
                    <div class=" progress-bar progress-bar-striped progress-bar-animated bg-warning" role="progressbar" aria-valuenow="34" aria-valuemin="0" aria-valuemax="100" style="width:34%">34%</div>
                </div>
            </div>
        </div>
        <div class="cbd_operator" style="width:97%;">
            <div class="row" style="margin:0rem auto;width: inherit;direction: ltr;">
                <p style="margin-bottom: 0.2rem; font-size: 0.8rem;width: 97%;">تعداد فاکتور ها به کل فاکتور های تیم</p>
                <div class="progress" style="width: inherit;">
                    <div class=" progress-bar progress-bar-striped progress-bar-animated bg-warning" role="progressbar" aria-valuenow="34" aria-valuemin="0" aria-valuemax="100" style="width:34%">34%</div>
                </div>
            </div>
        </div>
        <div class="cbd_operator" style="width:97%;">
            <div class="row" style="margin:0rem auto;width: inherit;direction: ltr;">
                <p style="margin-bottom: 0.2rem; font-size: 0.8rem;width: 97%;">ارسالی - مرجوعی</p>
                <div class="progress" style="width: inherit;">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100" style="width:66%">66%</div>
                    <div class=" progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="34" aria-valuemin="0" aria-valuemax="100" style="width:34%">34%</div>
                </div>
            </div>
        </div>
        <div class="cbd_operator" style="width:97%;">
            <div class="row" style="margin:0rem auto;width: inherit;direction: ltr;">
                <p style="margin-bottom: 0.2rem; font-size: 0.8rem;width: 97%;">تسویه شده - مانده</p>
                <div class="progress" style="width: inherit;">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100" style="width:66%">66%</div>
                    <div class=" progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="34" aria-valuemin="0" aria-valuemax="100" style="width:34%">34%</div>
                </div>
            </div>
        </div>
        <div class="cbd_operator" style="width:97%;">
            <div class="row" style="margin:0rem auto;width: inherit;direction: ltr;">
                <p style="margin-bottom: 0.2rem; font-size: 0.8rem;width: 97%;">رسمی - متفرقه</p>
                <div class="progress" style="width: inherit;">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100" style="width:66%">66%</div>
                    <div class=" progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="34" aria-valuemin="0" aria-valuemax="100" style="width:34%">34%</div>
                </div>
            </div>
        </div>
    </fieldset>

    <fieldset class='hor' style="margin-top: 1rem; height: fit-content;display: <?php echo $report_pos; ?>">
        <legend>گروه کالا(تعداد فروخته شده به تعداد کل بازاریاب)</legend>
        <div class="cbd_operator" style="width:97%;">
            <div class="row" style="margin:0rem auto;width: inherit;direction: ltr;">
                <p style="margin-bottom: 0.2rem; font-size: 0.8rem;width: 97%;direction: rtl;">30میل(12566)</p>
                <div class="progress" style="width: inherit;">
                    <div class=" progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="34" aria-valuemin="0" aria-valuemax="100" style="width:34%">34%</div>
                </div>
            </div>
        </div>
        <div class="cbd_operator" style="width:97%;">
            <div class="row" style="margin:0rem auto;width: inherit;direction: ltr;">
                <p style="margin-bottom: 0.2rem; font-size: 0.8rem;width: 97%;direction: rtl;">100میل(569)</p>
                <div class="progress" style="width: inherit;">
                    <div class=" progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="34" aria-valuemin="0" aria-valuemax="100" style="width:34%">34%</div>
                </div>
            </div>
        </div>
        <div class="cbd_operator" style="width:97%;">
            <div class="row" style="margin:0rem auto;width: inherit;direction: ltr;">
                <p style="margin-bottom: 0.2rem; font-size: 0.8rem;width: 97%;direction: rtl;">بادی(142)</p>
                <div class="progress" style="width: inherit;">
                    <div class=" progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="34" aria-valuemin="0" aria-valuemax="100" style="width:34%">34%</div>
                </div>
            </div>
        </div>
        <div class="cbd_operator" style="width:97%;">
            <div class="row" style="margin:0rem auto;width: inherit;direction: ltr;">
                <p style="margin-bottom: 0.2rem; font-size: 0.8rem;width: 97%;direction: rtl;">آرا(55)</p>
                <div class="progress" style="width: inherit;">
                    <div class=" progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="34" aria-valuemin="0" aria-valuemax="100" style="width:34%">34%</div>
                </div>
            </div>
        </div>
        <div class="cbd_operator" style="width:97%;">
            <div class="row" style="margin:0rem auto;width: inherit;direction: ltr;">
                <p style="margin-bottom: 0.2rem; font-size: 0.8rem;width: 97%;direction: rtl;">کتابی(3678)</p>
                <div class="progress" style="width: inherit;">
                    <div class=" progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="34" aria-valuemin="0" aria-valuemax="100" style="width:34%">34%</div>
                </div>
            </div>
        </div>
        <div class="cbd_operator" style="width:97%;">
            <div class="row" style="margin:0rem auto;width: inherit;direction: ltr;">
                <p style="margin-bottom: 0.2rem; font-size: 0.8rem;width: 97%;direction: rtl;">استند(14)</p>
                <div class="progress" style="width: inherit;">
                    <div class=" progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="34" aria-valuemin="0" aria-valuemax="100" style="width:34%">34%</div>
                </div>
            </div>
        </div>
    </fieldset>

    <fieldset class='hor' style="margin-top: 1rem; height: fit-content;display: <?php echo $report_pos; ?>">
        <legend>گروه کالا(ریال فروش به فروش کل بازاریاب)</legend>
        <div class="cbd_operator" style="width:97%;">
            <div class="row" style="margin:0rem auto;width: inherit;direction: ltr;">
                <p style="margin-bottom: 0.2rem; font-size: 0.8rem;width: 97%;direction: rtl;">30میل</p>
                <div class="progress" style="width: inherit;">
                    <div class=" progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="34" aria-valuemin="0" aria-valuemax="100" style="width:34%">34%</div>
                </div>
            </div>
        </div>
        <div class="cbd_operator" style="width:97%;">
            <div class="row" style="margin:0rem auto;width: inherit;direction: ltr;">
                <p style="margin-bottom: 0.2rem; font-size: 0.8rem;width: 97%;direction: rtl;">100میل</p>
                <div class="progress" style="width: inherit;">
                    <div class=" progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="34" aria-valuemin="0" aria-valuemax="100" style="width:34%">34%</div>
                </div>
            </div>
        </div>
        <div class="cbd_operator" style="width:97%;">
            <div class="row" style="margin:0rem auto;width: inherit;direction: ltr;">
                <p style="margin-bottom: 0.2rem; font-size: 0.8rem;width: 97%;direction: rtl;">بادی</p>
                <div class="progress" style="width: inherit;">
                    <div class=" progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="34" aria-valuemin="0" aria-valuemax="100" style="width:34%">34%</div>
                </div>
            </div>
        </div>
        <div class="cbd_operator" style="width:97%;">
            <div class="row" style="margin:0rem auto;width: inherit;direction: ltr;">
                <p style="margin-bottom: 0.2rem; font-size: 0.8rem;width: 97%;direction: rtl;">آرا</p>
                <div class="progress" style="width: inherit;">
                    <div class=" progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="34" aria-valuemin="0" aria-valuemax="100" style="width:34%">34%</div>
                </div>
            </div>
        </div>
        <div class="cbd_operator" style="width:97%;">
            <div class="row" style="margin:0rem auto;width: inherit;direction: ltr;">
                <p style="margin-bottom: 0.2rem; font-size: 0.8rem;width: 97%;direction: rtl;">کتابی</p>
                <div class="progress" style="width: inherit;">
                    <div class=" progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="34" aria-valuemin="0" aria-valuemax="100" style="width:34%">34%</div>
                </div>
            </div>
        </div>
        <div class="cbd_operator" style="width:97%;">
            <div class="row" style="margin:0rem auto;width: inherit;direction: ltr;">
                <p style="margin-bottom: 0.2rem; font-size: 0.8rem;width: 97%;direction: rtl;">استند</p>
                <div class="progress" style="width: inherit;">
                    <div class=" progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="34" aria-valuemin="0" aria-valuemax="100" style="width:34%">34%</div>
                </div>
            </div>
        </div>
    </fieldset>

    <fieldset class='hor' style="margin-top: 1rem; height: fit-content;display: <?php echo $report_pos; ?>">
        <legend>نوع مشتری</legend>
        <div class="cbd_operator" style="width:97%;">
            <div class="row" style="margin:0rem auto;width: inherit;direction: ltr;">
                <p style="margin-bottom: 0.2rem; font-size: 0.8rem;width: 97%;">نوع مشتری(جدید - قدیم)</p>
                <div class="progress" style="width: inherit;">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100" style="width:66%">66%</div>
                    <div class=" progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="34" aria-valuemin="0" aria-valuemax="100" style="width:34%">34%</div>
                </div>
            </div>
        </div>
        <div class="cbd_operator" style="width:97%;">
            <div class="row" style="margin:0rem auto;width: inherit;direction: ltr;">
                <p style="margin-bottom: 0.2rem; font-size: 0.8rem;width: 97%;">نوع مشتری مشهد(جدید - قدیم)</p>
                <div class="progress" style="width: inherit;">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100" style="width:66%">66%</div>
                    <div class=" progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="34" aria-valuemin="0" aria-valuemax="100" style="width:34%">34%</div>
                </div>
            </div>
        </div>
        <div class="cbd_operator" style="width:97%;">
            <div class="row" style="margin:0rem auto;width: inherit;direction: ltr;">
                <p style="margin-bottom: 0.2rem; font-size: 0.8rem;width: 97%;">نوع مشتری شهرستان(جدید - قدیم)</p>
                <div class="progress" style="width: inherit;">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100" style="width:66%">66%</div>
                    <div class=" progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="34" aria-valuemin="0" aria-valuemax="100" style="width:34%">34%</div>
                </div>
            </div>
        </div>
    </fieldset>

    <fieldset class='hor' style="margin-top: 1rem; height: fit-content;display: <?php echo $report_pos; ?>">
        <button class="btn btn-info" id="return" onclick="open_page('cbd')">بازگشت</button>
    </fieldset>
</div>

<?php
$page_title = 'آمار گزارش مسیر';
$back = 1;
require_once('slider.php'); ?>
<input type="hidden" id="uid" value="<?php echo $_COOKIE['uid']; ?>" />
<input type="hidden" id="loc_id" value="" />
<script src="./js/index.js"></script>

<style>
    .cbd_info {
        width: 80%;
        margin: 0.5rem auto;
    }

    .cbd_operator {
        margin-bottom: 0.4rem;
    }
</style>