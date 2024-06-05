<div class="row empty">دوره جدید</div>

<div class="cat">
    <div class="card my_card">
        <table class="table table-hover">
            <tr class="">
                <td class="td_title va_middle w-6">نام دوره</td>
                <td class="font-weight-bold text-white text-center w-9" colspan="2"><input type="text" class="form-control rounded-2 text-center text-primary" tabindex="1"></td>
            </tr>
            <tr>
                <td class="td_title">تعداد افراد</td>
                <td class="font-weight-bold text-center">1</td>
            </tr>
            <tr>
                <td class="td_title tarikh">تاریخ شروع</td>
                <td class="font-weight-bold text-center">
                    1403/03/01
                </td>
                <td class="text-center click"><?php echo $edit; ?></td>
            </tr>
            <tr>
                <td class="td_title">محدودیت مالی</td>
                <td class="font-weight-bold text-center">
                    11,500,000 <span class="unit">ريال</span>
                </td>
                <td class="text-center click"><?php echo $edit; ?></td>
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
                        <div class="input-group-prepend input_group_height">
                            <button class="input-group-text btn btn-secondary" id="addon-wrapping"><?php echo $search; ?></button>
                        </div>
                        <input type="text" class="input_group_height text-right form-control sum" placeholder="نام مخاطب را جستجو کنید" aria-label="Username" aria-describedby="addon-wrapping">
                    </div>
                </td>
            </tr>
        </table>
    </div>
</div>

<div class="cat mb-1 text-right">
    <div class="card my_card border_none selected_user">
        <div class="user_info bg_dark_blue text-white">
            <div class="user_name td_title_">اشکان توکلی <span><?php echo $del;?></span></div>
        </div>
    </div>
</div>

<div class="cat mb-1">
    <div class="card my_card border_none">
        <div class="record">
            <div class="user_img">
                <img src="image/users/09105005289.jpg" alt="user" class="rounded-circle w-2">
            </div>
            <div class="user_info bg_dark_blue text-white">
                <div class="user_name td_title_">دانیال نواری</div>
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
            <div class="user_info bg_green text-white border_none box_shadow_none">
                <div class="user_name td_title_">اشکان توکلی</div>
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