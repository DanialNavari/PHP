<link rel="stylesheet" href="static/css/lib/persian-datepicker.min.css" />
<link rel="stylesheet" href="static/css/main.css" />

<div class="row empty">دوره ها > دوره های فعال</div>
<div class="cat">
    <div class="card my_card">
        <table class="table">
            <tr class="">
                <td class="td_title va_middle w-6">نام دوره</td>
                <td class="font-weight-bold text-center" id="courseName">دوره جدید</td>
                <td class="font-weight-bold text-center click" onclick="course()"><?php echo $edit; ?></td>
            </tr>
            <tr>
                <td class="td_title">تعداد افراد</td>
                <td class="font-weight-bold text-center" id="course_count">1</td>
                <td class="font-weight-bold text-center click" onclick="course()"><?php echo $edit; ?></td>
            </tr>
            <tr>
                <td class="td_title tarikh">تاریخ شروع</td>
                <td class="font-weight-bold text-center">
                    <span id="start_from_fa">1403/03/01</span>
                </td>
                <td class="text-center click" onclick="setDate()"><?php echo $edit; ?></td>
            </tr>
            <tr id="set_tarikh" class="hide">
                <td colspan="3">
                    <span id="start_from_en" class="hide"></span>
                    <span id="start_unix" class="hide"></span>
                    <div class="range-from-example" class="hide"></div>
                </td>
            </tr>
            <tr class="hide w-100">
                <td colspan="3">
                    <button class="btn btn-success btn-sm w-100" id="savedate">ثبت تاریخ</button>
                </td>
            </tr>
            <tr>
                <td class="td_title pl-0">محدودیت مالی</td>
                <td class="font-weight-bold text-center">
                    <span id="moneyLimit">11,500,000</span> <span class="unit">ريال</span>
                </td>
                <td class="text-center click" onclick="moneyLimit()"><?php echo $edit; ?></td>
            </tr>
            <tr>
                <td class="td_title w-9">میانگین هزینه هر نفر</td>
                <td class="font-weight-bold text-center">2,000,000 <span class="unit">ريال</span></td>
                <td class="font-weight-bold text-center"></td>
            </tr>
            <tr>
                <td class="td_title">تعداد تراکنش</td>
                <td class="font-weight-bold text-center">23</td>
                <td class="font-weight-bold text-center"></td>
            </tr>
            <tr>
                <td class="td_title">مانده بدهی افراد دوره</td>
                <td class="font-weight-bold text-center">3,500,000 <span class="unit">ريال</span></td>
                <td class="font-weight-bold text-center"></td>
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
                <button class="btn btn-primary w-100 click1"><?php echo $end_course;
                                                                $link = urlencode("🔸 نام دوره: مسافرت جنوب\n 🔸 تاریخ شروع: 1403/04/01 \n 🔸 مدیر گروه : ** اشکان توکلی ** \n "); ?> اتمام دوره</button>
                <a class="btn btn-warning w-100 click1" href="tg://msg_url?text=<?php echo $link; ?> &url=https://danielnv.ir/Dong/courseRequest.php?id=1"> <?php echo $share; ?> لینک دوره</a>
                <button class="btn btn-danger w-100 click1 fs-0-75"><?php echo $end_course; ?> حذف دوره</button>
            </div>
        </div>
    </div>
</div>

<div class="add_course hide">
    <table class="border_none mx-auto">
        <tr class="font-weight-bold">
            <td class="td_title_ va_middle w-6 sum pl-3 ">نام دوره</td>
            <td>
                <input class="form-control sum font-weight-bold" />
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <button class="btn btn-success btn-sm w-100" id="savedate">ثبت</button>
            </td>
        </tr>
    </table>
</div>

<div class="cat mb-1 h-1"></div>


<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script src="static/js/lib/persian-date.min.js"></script>
<script src="static/js/lib/persian-datepicker.min.js"></script>

<script>
    var to, from;
    from = $(".range-from-example").persianDatepicker({
        inline: true,
        altField: '.range-from-example-alt',
        altFormat: 'LLLL',
        initialValue: false,
        onSelect: function(unix) {
            $('#start_unix').text(unix);
            const d = new Date(unix);
            var year = d.getFullYear();
            var month = ("0" + (d.getMonth() + 1)).slice(-2);
            var rooz = ("0" + d.getDate()).slice(-2);

            from.touched = true;
            if (to && to.options && to.options.minDate != unix) {
                var cachedValue = to.getState().selected.unixDate;
                to.options = {
                    minDate: unix
                };
                if (to.touched) {
                    to.setDate(cachedValue);
                }
            }
        }
    });
</script>