<link rel="stylesheet" href="static/css/lib/persian-datepicker.min.css" />
<link rel="stylesheet" href="static/css/main.css" />

<div class="row empty">دوره ها > دوره های فعال</div>
<div class="cat">
    <?php active_course($_COOKIE['uid']);
    if ($GLOBALS['course_count'] == 0) {
        echo '<h5 class="pt-2 text-secondary">ابتدا یک دوره جدید ایجاد کنید</h5>';
    }
    ?>
</div>

<div class="add_fee hide">
    <table class="border_none mx-auto">
        <tr class="font-weight-bold">
            <td class="sum pl-3 w-30">مبلغ تراکنش(ريال)</td>
            <td>
                <input class="form-control sum font-weight-bold" type="tel" id="feeLimit" onkeyup="separate_id('feeLimit')" />
                <input class="form-control sum font-weight-bold" type="hidden" id="fee_code" value="" />
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <button class="btn btn-success btn-sm w-100 save" id="saveCourseFee" onclick="change_values('feeLimit', 'moneyLimit')">تغییر محدودیت مالی</button>
            </td>
        </tr>
    </table>
</div>

<div class="tarikh_table hide">
    <table class="border_none mx-auto">
        <tr id="set_tarikh" class="hide">
            <td colspan="3">
                <span id="start_from_en" class="hide"></span>
                <span id="start_unix" class="hide"></span>
                <div class="range-from-example" class="hide"></div>
            </td>
        </tr>
        <tr class="hide w-100">
            <td colspan="3">
                <button class="btn btn-success btn-sm w-100" id="savedate" onclick="saveDates()">تغییر تاریخ</button>
            </td>
        </tr>
    </table>
</div>

<div class="add_course hide">
    <table class="border_none mx-auto">
        <tr class="font-weight-bold">
            <td class="td_title_ va_middle w-6 sum pl-3 ">نام دوره</td>
            <td>
                <input class="form-control sum font-weight-bold" id="newCourseName" />
                <input class="form-control sum font-weight-bold" id="course_code" value="" type="hidden" />
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <button class="btn btn-success btn-sm w-100 save" id="saveCourseName" onclick="change_values('newCourseName', 'courseName')">تغییر نام دوره</button>
            </td>
        </tr>
    </table>
</div>

<div class="add_manager">
    <div class="popup_header">
        <h6>مدیر دوره را انتخاب کنید</h6>
        <div class="end_course bg-white w_fit">
            <div class="btn btn-warning click1" onclick="cancelManager()">انصراف</div>
        </div>
    </div>
    <div class="popup_body">

    </div>
</div>

<div class="floatingActionButton" onclick="window.location.assign('./?route=_newCourse&h=course&id=null')">
    <div class="icon">
        <?php echo $GLOBALS['active_course1']; ?>
        <span>دوره جدید</span>
    </div>
</div>

<div class="cat mb-1 h-1"></div>

<!-- <div class="floatingActionButton" onclick="window.location.assign('./?route=_newCourse&h=course&id=null')">
    <div class="icon">
        <span>ایجاد دوره</span>
    </div>
</div> -->

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