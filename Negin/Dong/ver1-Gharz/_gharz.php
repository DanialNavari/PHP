<style>
    .pay_btn {
        width: 87vw;
        padding: 0.3rem;
        font-size: 0.7rem;
        left: calc(100vw / 33);
        height: fit-content;
    }

    .star {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        justify-content: space-between;
        flex-wrap: nowrap;
        width: 100%;
        color: #000 !important;
    }

    .my_card {
        margin: 0 auto 0.5rem auto;
    }

    .star2 {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        color: #000;
    }

    .btn:visited,
    .btn:link,
    .btn:hover,
    .btn:active {
        color: #fff;
    }

    .new_my_card {
        background-color: #263238 !important;
    }

    .record {
        background-color: transparent;
        background-color: transparent;
        border-bottom: 1px solid #bfbfbf8f;
        margin-bottom: 0.1rem;
        height: auto;
    }
</style>
<div class="row empty">قرض</div>
<?php
give_contacts_list_gharz($_COOKIE['uid'], "bedehkar");
give_contacts_list_gharz($_COOKIE['uid'], "talabkar");
?>
<div class="cat">
    <div class="card my_card">
        <table class="table">
            <tr>
                <td class="td_title">جمع کل طلب ها</td>
                <td class="font-weight-bold text-center" id="total_req"><?php echo sep3($_COOKIE['talab']); ?></td>
                <td class="font-weight-bold text-center">تومان</td>
            </tr>
            <tr>
                <td class="td_title">جمع کل بدهی ها</td>
                <td class="font-weight-bold text-center" id="total_debt"><?php echo sep3($_COOKIE['bedehi']); ?></td>
                <td class="font-weight-bold text-center">تومان</td>
            </tr>
        </table>
        <div class="mb-2"></div>
    </div>
    <button class="btn btn-firooze w-100 sum" onclick="add_new_gharz()">
        اضافه کردن
    </button>

</div>
<!-- <div class="cat mb-1">
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
                    <button class="btn btn-prime w-100 sum" id="btn_add_new_contact" onclick="addNewContact()">اضافه کردن مخاطب</button>
                </td>
            </tr>
        </table>
    </div>
</div> -->

<!-- <div class="cat mb-1">
    <div class="group_name">
        <h6 class="font-weight-bold">فیلتر</h6>
    </div>
</div> -->

<div class="row empty" style="margin-top: -1rem;">فیلتر</div>
<div class="cat">
    <div class="card my_card border_none">
        <table class="table">
            <tr class="white">
                <td>
                    <a class="btn btn-prime w-100 fs-0-75" style="padding:0.4rem" onclick="show_gharz('talabkari')">طلب</a>
                </td>
                <td>
                    <a class="btn btn-prime w-100 fs-0-75" style="padding:0.4rem" onclick="show_gharz('bedehkari')">بدهی</a>
                </td>
                <td>
                    <a class="btn btn-prime w-100 fs-0-75" style="padding:0.4rem" onclick="show_gharz('all')">همه</a>
                </td>
            </tr>
        </table>
    </div>
</div>


<div class="users_box">
    <?php
    $contact_maker = $_COOKIE['uid'];
    echo give_contacts_list_gharz($contact_maker, "talabkar");
    ?>
</div>

<!-- users box -->
<div class="users_box">
    <?php
    $contact_maker = $_COOKIE['uid'];
    echo give_contacts_list_gharz($contact_maker, "bedehkar");
    ?>
</div>
<div class="last_item"></div>

<div class="add_fee hide">
    <table class="border_none mx-auto">
        <tr class="font-weight-bold">
            <td class="sum pl-3 w-30"></td>
        </tr>
    </table>
</div>

<!-- <div class="floatingActionButton" onclick="add_new_gharz()">
    <div class="icon">
        <?php echo $GLOBALS['loan']; ?>
        <span>قرض جدید</span>
    </div>
</div> -->

<div class="new_gharz force_hide">
    <div class="card my_card" style="background-color: rgba(235, 246, 255, 1);">
        <table class="table">
            <tr>
                <td class="td_title">انتخاب کاربر</td>
                <td class="font-weight-bold text-center" id="total_req"></td>
            </tr>
            <tr>
                <td class="td_title">مبلغ</td>
                <td class="font-weight-bold text-center"><span id="total_req">1,500,000 </span><span>تومان</span></td>
            </tr>
            <tr>
                <td class="td_title">تاریخ واریز</td>
                <td class="font-weight-bold text-center" id="total_req">1403/05/26</td>
                <td class="font-weight-bold text-center"><?php echo $GLOBALS['edit']; ?></td>
            </tr>
            <tr>
                <td class="td_title" style="width: 6rem;">تاریخ بازپرداخت</td>
                <td class="font-weight-bold text-center" id="total_req">1403/05/28</td>
                <td class="font-weight-bold text-center"><?php echo $GLOBALS['edit']; ?></td>
            </tr>
            <tr>
                <td class="td_title">نوع بدهی</td>
                <td class="font-weight-bold text-center" id="total_req" colspan="2" style="padding: 0.2rem;">
                    <div class="form-check form-switch" onclick="debt_type()">
                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked name="debt_type">
                        <label class="form-check-label" for="flexSwitchCheckChecked" style="font-size: 0.78rem;">از این فرد طلبکار هستم</label>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="td_title">بابت</td>
                <td class="font-weight-bold text-center" id="total_req" colspan="2">
                    <input type="text" class="form-control">
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <button class="btn btn-prime w-100 sum" id="saveNewGharz">ایجاد طلب جدید</button>
                </td>
            </tr>
        </table>
        <div class="mb-2"></div>
    </div>
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

    function show_gharz(class_name) {
        if (class_name == 'all') {
            $(".talabkari").show();
            $(".bedehkari").show();
        } else {
            $(".talabkari").hide();
            $(".bedehkari").hide();
            $("." + class_name).show()

        }
    }

    function debt_type() {
        var value = $("#flexSwitchCheckChecked").prop('checked');
        if (value == true) {
            $(".form-check-label").text("از این فرد طلبکار هستم");
            $("#saveNewGharz").text("ایجاد طلب جدید");
        } else {
            $(".form-check-label").text("به این  فرد بدهکار هستم");
            $("#saveNewGharz").text("ایجاد بدهی جدید");
        }
    }
</script>