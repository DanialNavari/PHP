<div class="row empty">دوره ها > دوره های فعال > مسافرت جنوب > پرداخت ها</div>

<div class="cat">
    <div class="card my_card">
        <table class="table">
            <tr class="bg_blue_very_dark font-weight-bold">
                <td class="text-white text-center">پرداخت از</td>
                <td class="text-white text-center">واریز به</td>
                <td class="text-white text-center">مبلغ(ريال)</td>
                <td class="text-white text-center">تاریخ</td>
            </tr>
        </table>

        <table class="table" onclick="payment(1)">
            <tr class="bg-white font-weight-bold">
                <td class="text-primary text-center">اشکان توکلی</td>
                <td class="text-primary text-center">دانیال نواری</td>
                <td class="text-primary text-center">1,000,000</td>
                <td class="text-primary text-center">1403/03/01</td>
            </tr>
        </table>

        <table class="table">
            <tr class="bg_blue_nice font-weight-bold">
                <td class="td_title text_blue_very_dark text-right" colspan="4">هزینه هتل و شام</td>
            </tr>
        </table>

    </div>
</div>

<div class="add_payments hide">
    <table class="border_none mx-auto">
        <tr class="font-weight-bold">
            <td class="sum pl-3 w-30">پرداخت از </td>
            <td>
                <select class="form-select sum font-weight-bold" aria-label="Default select example">
                    <option value="1">اشکان توکلی</option>
                    <option value="2">دانیال نواری</option>
                    <option value="3">علیرضا صالحی</option>
                </select>
            </td>
        </tr>
        <tr class="font-weight-bold">
            <td class="sum pl-3">واریز به</td>
            <td>
                <select class="form-select sum font-weight-bold" aria-label="Default select example">
                    <option value="1">اشکان توکلی</option>
                    <option value="2">دانیال نواری</option>
                    <option value="3">علیرضا صالحی</option>
                </select>
            </td>
        </tr>
        <tr class="font-weight-bold">
            <td class="sum pl-3">مبلغ(ريال)</td>
            <td>
                <input type="number" class="form-control">
            </td>
        </tr>
        <tr class="font-weight-bold">
            <td class="sum pl-3">عنوان</td>
            <td>
                <input type="text" class="form-control">
            </td>
        </tr>
        <tr class="font-weight-bold">
            <td class="sum" colspan="2">
                <button class="btn btn-success w-100">ثبت</button>
            </td>
        </tr>
    </table>
</div>

<div class="floatingActionButton click1">
    <div class="icon">
        <?php echo $plus; ?>
    </div>
</div>