<link rel="stylesheet" href="static/css/lib/persian-datepicker.min.css" />
<link rel="stylesheet" href="static/css/main.css" />

<div class="row empty">دوره جدید</div>

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
                <td class="font-weight-bold text-center"></td>
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
                    <button class="btn btn-success btn-sm w-100" id="savedate">تغییر تاریخ</button>
                </td>
            </tr>
            <tr>
                <td class="td_title pl-0">محدودیت مالی</td>
                <td class="font-weight-bold text-center">
                    <span id="moneyLimit">11,500,000</span> <span class="unit">ريال</span>
                </td>
                <td class="text-center click" onclick="moneyLimit()"><?php echo $edit; ?></td>
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

<div class="h-1"></div>
<div class="h-1"></div>

<div class="cat mb-1">
    <div class="group_name">
        <h6 class="font-weight-bold">اضافه کردن مخاطب جدید</h6>
    </div>
</div>

<div class="cat">
    <div class="card my_card border_none">
        <table class="table">
            <tr class="white">
                <td class="td_title_ font-weight-bold text-white">
                    <div class="form-row">
                        <div class="col">
                            <input type="text" id="newContactName" class="input_group_height text-right form-control sum" placeholder="نام مخاطب" aria-label="Username" aria-describedby="addon-wrapping">
                        </div>
                        <div class="col">
                            <input type="tel" id="newContactTel" class="input_group_height text-right form-control sum" placeholder="شماره مخاطب" aria-label="Username" aria-describedby="addon-wrapping">
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="td_title_ font-weight-bold text-white">
                    <button class="btn btn-success w-100 sum" onclick="addNewContact()">اضافه کردن مخاطب</button>
                </td>
            </tr>
        </table>
    </div>
</div>

<div class="cat mb-1">
    <div class="group_name">
        <h6 class="font-weight-bold">افراد حاضر در دوره</h6>
    </div>
</div>

<div class="cat">
    <div class="card my_card border_none">
        <table class="table">
            <tr class="white">
                <td class="td_title_ font-weight-bold text-white">
                    <div class="input-group">
                        <input type="text" class="input_group_height text-right form-control sum search_box" placeholder="نام مخاطب یا شماره موبایل را جستجو کنید" aria-label="Username" aria-describedby="addon-wrapping" onkeyup="searchContact()">
                    </div>
                </td>
            </tr>
        </table>
    </div>
</div>

<!-- selected users -->
<div class="cat mb-1">
    <div class="card my_card border_none selected_user">

    </div>
</div>

<!-- users box -->
<div class="cat mb-1 contactBox" onclick="add_user_to_course(2)" data="دانیال نواری 09105005289">
    <div class="card my_card bg_blue user-2-box">
        <div class="record user-2-name">
            <div class="user_info text-white border_none box_shadow_none">
                <img src="image/user.png" alt="user" class="rounded-circle w-1-5">
                <div class="star">
                    <span>دانیال نواری</span>
                    <i><?php echo star(1, 1); ?></i>
                </div>
            </div>
            <div class="user_info text-white border_none box_shadow_none">
                <a href="tel://09105005289" target="_blank">09105005289</a>
            </div>
        </div>
    </div>
</div>

<div class="cat mb-1 contactBox" onclick="add_user_to_course(1)" data="اشکان توکلی 09150026017">
    <div class="card my_card bg_blue user-1-box">
        <div class="record user-1-name">
            <div class="user_info text-white border_none box_shadow_none">
                <img src="image/user.png" alt="user" class="rounded-circle w-1-5">
                <div class="star">
                    <span>اشکان توکلی</span>
                    <i><?php echo star(0, 0); ?></i>
                </div>
            </div>
            <div class="user_info text-white border_none box_shadow_none">
                <a href="tel://09150026017" target="_blank">09150026017</a>
            </div>
        </div>
    </div>
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
            <td class="sum pl-3 w-30">نام دوره</td>
            <td>
                <input class="form-control sum font-weight-bold" id="newCourseName" />
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