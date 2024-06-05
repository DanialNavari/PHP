<div class="row empty">دوره جدید</div>

<div class="cat">
    <div class="card my_card">
        <table class="table table-hover">
            <tr class="">
                <td class="td_title va_middle w-6">نام دوره</td>
                <td class="font-weight-bold text-white text-center w-9">
                    <span class="text-center text-primary">مسافرت جنوب</span>
                </td>
                <td class="text-center click"><?php echo $edit; ?></td>
            </tr>
            <tr>
                <td class="td_title">تاریخ تراکنش</td>
                <td class="font-weight-bold text-center">1403/03/01</td>
                <td class="text-center click"><?php echo $edit; ?></td>

            </tr>
            <tr>
                <td class="td_title tarikh">خرید کننده</td>
                <td class="font-weight-bold text-center">
                    اشکان توکلی
                </td>
                <td class="text-center click"><?php echo $edit; ?></td>
            </tr>
            <tr>
                <td class="td_title">مبلغ تراکنش</td>
                <td class="font-weight-bold text-center">
                    500,000 <span class="unit">ريال</span>
                </td>
                <td class="text-center click"><?php echo $edit; ?></td>
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

<div class="cat mb-1">
    <div class="card my_card border_none">
        <div class="record">
            <div class="user_img">
                <img src="image/users/09105005289.jpg" alt="user" class="rounded-circle w-2">
            </div>
            <div class="user_info bg_dark_blue text-white user_infos">
                <div class="user_name td_title_">دانیال نواری</div>
                <div class="user_name td_title_">
                    <input type="number" id="" class="form-control text-center rounded-2 w-6" placeholder="مبلغ">
                </div>
            </div>
        </div>
        <div class="edit_btn">
            <div class="user_info user_info1 bg_dark_blue text-white">
                <div class="user_tel"><a href="tel://09105005289" target="_blank">09105005289</a></div>
                <div class="other_btn">
                    <div class="edit_btn click"><?php echo $check_box; ?></div>
                    <div class="del_btn click"><?php echo $del; ?></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="cat mb-1">
    <div class="card my_card border_none bg_green">
        <div class="record bg_green">
            <div class="user_img">
                <img src="image/user.png" alt="user" class="rounded-circle w-2">
            </div>
            <div class="user_info bg_green text-white border_none box_shadow_none user_infos">
                <div class="user_name td_title_">اشکان توکلی</div>
                <div class="user_name td_title_">
                    <input type="number" id="" class="form-control text-center rounded-2 w-6" placeholder="مبلغ" value="256000">
                </div>
            </div>
        </div>
        <div class="edit_btn">
            <div class="user_info user_info1 bg_green_dark text-white">
                <div class="user_tel"><a href="tel://09150026017" target="_blank">09150026017</a></div>
                <div class="other_btn">
                    <div class="edit_btn click"><?php echo $check_box; ?></div>
                    <div class="del_btn click"><?php echo $del; ?></div>
                </div>
            </div>
        </div>
    </div>
</div>