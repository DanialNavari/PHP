<link rel="stylesheet" href="static/css/lib/persian-datepicker.min.css" />
<link rel="stylesheet" href="static/css/main.css" />

<div class="row empty">دوره ها > دوره های فعال</div>
<div class="cat">
    <?php active_course($_COOKIE['uid']);?>
</div>

<div class="add_fee hide">
    <table class="border_none mx-auto">
        <tr class="font-weight-bold">
            <td class="sum pl-3 w-30">مبلغ تراکنش(ريال)</td>
            <td>
                <input class="form-control sum font-weight-bold" type="number" id="feeLimit" />
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <button class="btn btn-success btn-sm w-100 save" id="saveCourseFee" onclick="change_value('feeLimit', 'moneyLimit')">تغییر محدودیت مالی</button>
            </td>
        </tr>
    </table>
</div>

<div class="add_course hide">
    <table class="border_none mx-auto">
        <tr class="font-weight-bold">
            <td class="td_title_ va_middle w-6 sum pl-3 ">نام دوره</td>
            <td>
                <input class="form-control sum font-weight-bold" id="newCourseName"/>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <button class="btn btn-success btn-sm w-100 save" id="saveCourseName" onclick="change_value('newCourseName', 'courseName')">تغییر نام دوره</button>
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