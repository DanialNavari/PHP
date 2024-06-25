<?php
require_once("symbol.php");
require_once("main_top.php");

?>
<div class="row empty">دعوت به دوره</div>
<div class="cat">
    <div class="card my_card">
        <table class="table">
            <tr>
                <td class="td_title">: نام دوره</td>
                <td class="font-weight-bold">مسافرت جنوب</td>
            </tr>
            <tr>
                <td class="td_title">: تاریخ شروع</td>
                <td class="font-weight-bold">1403/04/01</td>
            </tr>
            <tr>
                <td class="td_title">: محدودیت مالی</td>
                <td class="font-weight-bold">12,500,000 <span class="unit">ريال</span></td>
            </tr>
            <tr>
                <td class="td_title">: ظرفیت دوره</td>
                <td class="font-weight-bold">10 <span class="unit">نفر</span></td>
            </tr>
            <tr>
                <td class="td_title">: افراد دوره</td>
                <td class="font-weight-bold">5 <span class="unit">نفر</span></td>
            </tr>
            <tr>
                <td class="td_title">: مدیر دوره</td>
                <td class="font-weight-bold">اشکان توکلی</td>
            </tr>
        </table>

    </div>
    <div class="card my_card request_course">
        <table class="table">
            <tr>
                <td class="td_title va_middle">: نام</td>
                <td><input type="text" class="form-control w-9 h-2"></td>
            </tr>
            <tr>
                <td class="td_title va_middle">: نام خانوادگی</td>
                <td><input type="text" class="form-control w-9 h-2"></td>
            </tr>
            <tr>
                <td class="td_title va_middle">: تلفن</td>
                <td><input type="tel" class="form-control w-9 h-2"></td>
            </tr>
            <tr>
                <td class="td_title va_middle">: توضیحات</td>
                <td><textarea class="form-control w-9 h-2"></textarea></td>
            </tr>
            <tr>
                <td colspan="2">
                    <button class="btn btn-success w-100 sum">ثبت نام</button>
                </td>
            </tr>
        </table>
    </div>
</div>