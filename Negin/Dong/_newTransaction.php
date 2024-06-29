<link rel="stylesheet" href="static/css/lib/persian-datepicker.min.css" />
<link rel="stylesheet" href="static/css/main.css" />

<div class="row empty">ثبت خرید</div>

<div class="cat">
    <div class="card my_card">
        <table class="table table-hover">
            <tr class="">
                <td class="td_title va_middle w-6">نام دوره</td>
                <td class="font-weight-bold text-white text-center w-9">
                    <span class="text-center text-primary">مسافرت جنوب</span>
                </td>
                <td class="text-center click" onclick="course()"><?php echo $edit; ?></td>
            </tr>
            <tr>
                <td class="td_title tarikh">تاریخ تراکنش</td>
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
                <td class="td_title tarikh">خرید کننده</td>
                <td class="font-weight-bold text-center">
                    اشکان توکلی
                </td>
                <td class="text-center click" onclick="payment()"><?php echo $edit; ?></td>
            </tr>
            <tr>
                <td class="td_title">مبلغ تراکنش</td>
                <td class="font-weight-bold text-center">
                    <span id="moneyLimit">11,500,000</span> <span class="unit">ريال</span>
                </td>
                <td class="text-center click" onclick="moneyLimit()"><?php echo $edit; ?></td>
            </tr>
            <tr>
                <td class="td_title">سهم افراد</td>
                <td class="font-weight-bold text-center" colspan="2">
                    <span>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                            <label class="form-check-label" for="inlineRadio1"><span>ضریب</span></label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                            <label class="form-check-label" for="inlineRadio2"><span>مبلغ (ريال)</span></label>
                        </div>
                    </span>

                </td>
            </tr>
            <tr>
                <td class="td_title va_middle">توضیحات</td>
                <td class="font-weight-bold text-center" colspan="2">
                    <textarea class="form-control" rows="3"></textarea>
                </td>
            </tr>
        </table>
        <div class="mb-5"></div>
        <div class="pay_btn pay_btn2">
            <div class="pay_btn_icon">
                <?php echo $check; ?>
            </div>
        </div>
    </div>
</div>

<div class="cat mb-2">
    <div class="group_name">
        <h6 class="font-weight-bold">مخاطبین تراکنش</h6>
    </div>
</div>

<!-- selected users -->
<div class="cat mb-1">
    <div class="card my_card border_none selected_user">

    </div>
</div>

<!-- users box -->
<div class="cat mb-1" onclick="add_user_to_course(2)">
    <div class="card my_card bg_blue user-2-box">
        <div class="record user-2-name">
            <div class="user_info text-white border_none box_shadow_none">
                <img src="image/user.png" alt="user" class="rounded-circle w-1-5">
                <div class="star">
                    <span>دانیال نواری</span>
                    <i>09105005289</i>
                </div>
            </div>
            <div class="user_info text-white border_none box_shadow_none">
                <input type="number" class="form-control text-center h-1-8 sum font-weight-bold" value="">
            </div>
        </div>
    </div>
</div>

<div class="cat mb-1" onclick="add_user_to_course(1)">
    <div class="card my_card bg_blue user-1-box">
        <div class="record user-1-name">
            <div class="user_info text-white border_none box_shadow_none">
                <img src="image/user.png" alt="user" class="rounded-circle w-1-5">
                <div class="star">
                    <span>اشکان توکلی</span>
                    <i>09150026017</i>
                </div>
            </div>
            <div class="user_info text-white border_none box_shadow_none">
                <input type="number" class="form-control text-center h-1-8 sum font-weight-bold" value="">
            </div>
        </div>
    </div>
</div>

<div class="add_payments hide">
    <table class="border_none mx-auto">
        <tr class="font-weight-bold">
            <td class="sum pl-3 w-30">خرید کننده</td>
            <td>
                <select class="form-select sum font-weight-bold" aria-label="Default select example">
                    <option value="1">اشکان توکلی</option>
                    <option value="2">دانیال نواری</option>
                    <option value="3">علیرضا صالحی</option>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <button class="btn btn-success btn-sm w-100" id="savedate">ثبت</button>
            </td>
        </tr>
    </table>
</div>

<div class="add_course hide">
    <table class="border_none mx-auto">
        <tr class="font-weight-bold">
            <td class="sum pl-3 w-30">نام دوره</td>
            <td>
                <select class="form-select sum font-weight-bold" aria-label="Default select example">
                    <option value="1">سفر شمال</option>
                    <option value="2" selected>سفر جنوب</option>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <button class="btn btn-success btn-sm w-100" id="savedate">ثبت</button>
            </td>
        </tr>
    </table>
</div>

<div class="add_fee hide">
    <table class="border_none mx-auto">
        <tr class="font-weight-bold">
            <td class="sum pl-3 w-30">مبلغ تراکنش(ريال)</td>
            <td>
                <input class="form-control sum font-weight-bold" type="number" />
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