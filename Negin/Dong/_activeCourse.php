<div class="row empty">دوره ها > دوره های فعال</div>
<div class="cat">
    <div class="card my_card">
        <table class="table table-hover">
            <tr>
                <td class="td_title">نام دوره</td>
                <td class="font-weight-bold">مسافرت جنوب</td>
            </tr>
            <tr>
                <td class="td_title">تعداد افراد</td>
                <td class="font-weight-bold">5</td>
            </tr>
            <tr>
                <td class="td_title tarikh">تاریخ شروع</td>
                <td class="font-weight-bold">1403/03/01 14:35:20</td>
            </tr>
            <tr>
                <td class="td_title">میانگین هزینه هر نفر</td>
                <td class="font-weight-bold">2,000,000 <span class="unit">ريال</span></td>
            </tr>
            <tr>
                <td class="td_title">تعداد تراکنش</td>
                <td class="font-weight-bold">23</td>
            </tr>
            <tr>
                <td class="td_title">مانده بدهی افراد دوره</td>
                <td class="font-weight-bold">3,500,000 <span class="unit">ريال</span></td>
            </tr>
            <tr>
                <td></td>
                <td><span class="unit"></span></td>
            </tr>
        </table>
        <div class="pay_btn pay_btn1 click" onclick="page('r','__activeCourse')">
            <div class="pay_btn_icon">
                <?php echo $check; ?>
            </div>
        </div>
        <div class="share_link bg_blue font-weight-bold g_20">
            <div class="inline_title td_title text-white">کل هزینه</div>
            <div class="inline_title hazine">5,000,000<span class="unit"> ريال</span></div>
        </div>
        <div class="proofs">
            <div class="transactions font-weight-bold">
                <div class="inline_icon"><?php echo $list; ?></div>
                <div class="inline_title">تراکنش ها</div>
            </div>
            <div class="payments font-weight-bold">
                <div class="inline_icon"><?php echo $money; ?></div>
                <div class="inline_title">پرداخت ها</div>
            </div>
            <div class="payments font-weight-bold">
                <div class="inline_icon"><?php echo $share; ?></div>
                <div class="inline_title">لینک دوره</div>
            </div>
        </div>
        <div class="share_link bg_blue_very_dark font-weight-bold">
            <div class="inline_title">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked">
                    <label class="form-check-label" for="flexSwitchCheckChecked">دوره پیش فرض</label>
                </div>
            </div>
        </div>
    </div>
</div>
