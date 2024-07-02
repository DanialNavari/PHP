<div class="row empty">مخاطبین</div>
<div class="cat">
    <div class="card my_card">
        <table class="table">
            <tr class="">
                <td class="td_title_ va_middle w-4">نام کاربر</td>
                <td class="font-weight-bold text-white"><input type="text" class="form-control rounded-2 text-center text-primary" tabindex="1" id="newContactName"></td>
                <td class="font-weight-bold"></td>
            </tr>
            <tr class="">
                <td class="td_title_ va_middle w-4">موبایل</td>
                <td class="font-weight-bold text-white"><input type="tel" class="form-control rounded-2 text-center text-primary" pattern="[0-9]{11}" tabindex="3" id="newContactTel"></td>
                <td class="font-weight-bold"></td>
            </tr>
            <tr>
                <td class="td_title_"></td>
                <td class="font-weight-bold"></td>
                <td class="font-weight-bold"></td>
            </tr>
            <tr>
                <td class="td_title_ "></td>
                <td class="font-weight-bold"></td>
                <td class="font-weight-bold"></td>
            </tr>
        </table>
        <div class="pay_btn contact_btn">
            <div class="pay_btn_icon">
                <?php echo $check; ?>
            </div>
        </div>
        <div class="pay_btn contact_btn add_user">
            <div class="pay_btn_icon">
                <?php echo $user_add; ?>
            </div>
        </div>
    </div>
</div>

<br/>
<div class="cat mb-1">
    <div class="group_name">
        <h6 class="font-weight-bold">مخاطبین</h6>
    </div>
</div>

<div class="cat">
    <div class="card my_card border_none">
        <table class="table">
            <tr class="white">
                <td class="td_title_ font-weight-bold text-white">
                    <div class="input-group">
                        <input type="text" class="input_group_height text-right form-control sum" placeholder="نام مخاطب را جستجو کنید" aria-label="Username" aria-describedby="addon-wrapping">
                    </div>
                </td>
            </tr>
        </table>
    </div>
</div>

<?php contact_list($_COOKIE['uid']);?>
<div class="empty_space"></div>
