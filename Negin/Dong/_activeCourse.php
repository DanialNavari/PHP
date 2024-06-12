<div class="row empty">دوره ها > دوره های فعال</div>
<div class="cat">
    <div class="card my_card">
        <table class="table table-hover">
            <tr>
                <td class="td_title">نام دوره</td>
                <td class="font-weight-bold" id="courseName">مسافرت جنوب</td>
                <td class="font-weight-bold" onclick="changeCourseName()"><?php echo $edit; ?></td>
            </tr>
            <tr>
                <td class="td_title">تعداد افراد</td>
                <td class="font-weight-bold">5</td>
                <td class="font-weight-bold" onclick="addUserToCourse()"><?php echo $edit; ?></td>
            </tr>
            <tr>
                <td class="td_title tarikh">تاریخ شروع</td>
                <td class="font-weight-bold">1403/03/01</td>
                <td class="font-weight-bold"><?php echo $edit; ?></td>
            </tr>
            <tr>
                <td class="td_title">میانگین هزینه هر نفر</td>
                <td class="font-weight-bold" colspan="2">2,000,000 <span class="unit">ريال</span></td>
            </tr>
            <tr>
                <td class="td_title">تعداد تراکنش</td>
                <td class="font-weight-bold" colspan="2">23</td>
            </tr>
            <tr>
                <td class="td_title">مانده بدهی افراد دوره</td>
                <td class="font-weight-bold" colspan="2">3,500,000 <span class="unit">ريال</span></td>
            </tr>

        </table>
        <div class="share_link bg_blue font-weight-bold g_20">
            <div class="inline_title td_title text-white">کل هزینه</div>
            <div class="inline_title hazine">5,000,000<span class="unit"> ريال</span></div>
        </div>
        <div class="proofs">
            <div class="transactions font-weight-bold" onclick="page('r','__transactions')">
                <div class="inline_icon"><?php echo $list; ?></div>
                <div class="inline_title">تراکنش ها</div>
            </div>
            <div class="payments font-weight-bold" onclick="page('r','__payments')">
                <div class="inline_icon"><?php echo $money; ?></div>
                <div class="inline_title">پرداخت ها</div>
            </div>
            <div class="payments font-weight-bold" onclick="page('r','___report')">
                <div class="inline_icon"><?php echo $list; ?></div>
                <div class="inline_title">گزارش</div>
            </div>
        </div>
        <div class="share_link bg_blue_very_dark font-weight-bold">
            <div class="inline_title">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="defaultCourse" checked>
                    <label class="form-check-label" for="defaultCourse">دوره پیش فرض</label>
                </div>
            </div>
            <div class="inline_title">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="disabledCourse">
                    <label class="form-check-label" for="disabledCourse">غیرفعالسازی</label>
                </div>
            </div>
        </div>
        <div class="proofs">
            <div class="end_course transactions font-weight-bold">
                <button class="btn btn-primary w-100 click1" ><?php echo $end_course; ?> اتمام دوره</button>
                <button class="btn btn-warning w-100 click1"><?php echo $share; ?> لینک دوره</button>
                <button class="btn btn-danger w-100 click1 fs-0-75"><?php echo $end_course; ?> حذف دوره</button>
            </div>
        </div>
    </div>
</div>