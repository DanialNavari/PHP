<link rel="stylesheet" href="static/css/lib/persian-datepicker.min.css" />
<link rel="stylesheet" href="static/css/main.css" />
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
        height: 4.9rem;
        overflow: hidden;
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

    #set_tarikh {
        position: fixed;
        top: 22vh;
        z-index: 9;
        padding: 1rem;
        width: 100%;
        height: 22rem;
        background: #ffffff;
    }

    select {
        font-size: 0.75rem !important;
    }

    #new_contact {
        display: none;
    }
</style>
<div class="row empty">قرض</div>
<?php
give_contacts_list_gharz($_COOKIE['uid'], "talabkar");
give_contacts_list_gharz($_COOKIE['uid'], "bedehkar");
$bedehi = $_COOKIE['bedehi'];
$talab = $_COOKIE['talab'];
$jaam_hesab = abs(intval($talab) - intval($bedehi));

if ($jaam_hesab > 0) {
    $jh = "طلبکار";
} else {
    $jh = "بدهکار";
}
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

<div class="row empty" style="margin-top: -1rem;">فیلترها</div>
<div class="cat">
    <div class="card my_card border_none">
        <table class="table">
            <tr class="white">
                <td>
                    <a class="btn btn-prime w-100 fs-0-75 TalabK" style="padding:0.4rem" onclick="show_gharz('talabkari','TalabK')">طلب دارم</a>
                </td>
                <td>
                    <a class="btn btn-prime w-100 fs-0-75 BedehK" style="padding:0.4rem" onclick="show_gharz('bedehkari','BedehK')">بدهی دارم</a>
                </td>
                <td>
                    <a class="btn btn-prime w-100 fs-0-75 TasvI" style="padding:0.4rem" onclick="show_gharz('tasviyei','TasvI')">تسویه شده</a>
                </td>
                <td>
                    <a class="btn btn-warning w-100 fs-0-75 alLI" style="padding:0.4rem" onclick="show_gharz('all','alLI')">همه</a>
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
    echo give_contacts_list_gharz($contact_maker, "bedehkar");
    ?>
</div>

<div class="users_box">
    <?php
    echo give_contacts_list_gharz($contact_maker, "tasviye");
    ?>
</div>
<!-- <div class="last_item"></div> -->

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
    <div class="card my_card" style="background-color: rgba(235, 246, 255, 1);height:max-content;">
        <table class="table">
            <tr>
                <td class="td_title va_middle">انتخاب کاربر</td>
                <td class="font-weight-bold text-center" id="total_req" colspan="2">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="myContacts" checked onclick="change_karbar_pos()">
                        <label class="form-check-label" for="myContacts" id="karbar_pos">مخاطبین من</label>
                    </div>
                </td>
            </tr>
            <tr id="old_contact">
                <td colspan="3">
                    <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="gharz_users">
                        <?php
                        echo SELECT_GHARZ_users();
                        ?>
                    </select>
                </td>
            </tr>
            <tr id="new_contact">
                <td colspan="3">
                    <input type="text" id="newContactName" class="input_group_height text-right form-control sum" placeholder="نام مخاطب" aria-label="Username" aria-describedby="addon-wrapping">
                    <input type="tel" id="newContactTel" class="mt-1 input_group_height text-right form-control sum" placeholder="شماره مخاطب" aria-label="Username" aria-describedby="addon-wrapping">
                </td>
            </tr>
            <!-- <tr>
                <td class="td_title va_middle">بدهی کاربر</td>
                <td class="font-weight-bold text-center">
                    <input id="bedehi_user" disabled type="tel" class="form-control sum form_sm" value="0" pattern="[0-9,]" onchange="separate_id('bedehi_user')" onfocus="clear_content('bedehi_user','in')" onfocusout="clear_content('bedehi_user','out')" />
                    <span id="plzwait" class="hide">لطفا کمی صبر کنید</span>
                </td>
                <td class="font-weight-bold text-center va_middle">تومان</td>
            </tr> -->
            <tr>
                <td class="td_title va_middle">مبلغ</td>
                <td class="font-weight-bold text-center">
                    <input id="fee" type="tel" class="form-control sum form_sm" value="0" pattern="[0-9,]" onkeyup="separate_id('fee')" onfocus="clear_content('fee','in')" onfocusout="clear_content('fee','out')" />
                </td>
                <td class="font-weight-bold text-center va_middle">تومان</td>
            </tr>
            <tr>
                <td class="td_title va_middle">تاریخ دریافت</td>
                <td class="font-weight-bold text-center va_middle" id="variz_date">****/**/**</td>
                <td class="font-weight-bold text-center" onclick="setDates_('variz')"><?php echo $GLOBALS['edit']; ?></td>
            </tr>
            <tr>
                <td class="td_title va_middle" style="width: 6rem;">تاریخ بازپرداخت</td>
                <td class="font-weight-bold text-center" id="repay_date">****/**/**</td>
                <td class="font-weight-bold text-center" onclick="setDates_('repay')"><?php echo $GLOBALS['edit']; ?></td>
            </tr>
            <tr>
                <td class="td_title va_middle">نوع بدهی</td>
                <td class="font-weight-bold text-center" colspan="2" style="padding: 0.2rem;">
                    <div class="form-check form-switch" onclick="debt_type()">
                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked name="debt_type">
                        <label class="form-check-label" for="flexSwitchCheckChecked" style="font-size: 0.78rem;" id="user_debt_desc">از این فرد طلبکار هستم</label>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="td_title va_middle">بابت</td>
                <td class="font-weight-bold text-center" colspan="2">
                    <input type="text" class="form-control form_sm" id="babat">
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

<div id="set_tarikh" class="hide">
    <span id="start_from_en" class="hide"></span>
    <span id="start_unix" class="hide"></span>
    <div class="range-from-example pwt-datepicker-input-element">
    </div>
    <div class="save_zaman">
        <input type="hidden" class="form-control" value="" id="date_type">
        <input type="hidden" class="form-control" value="" id="today">
        <button class="btn btn-warning sum w-100 btn_nice" onclick="saveDate_()" id="save_date">ذخیره</button>
    </div>
</div>

<div class="cat mb-1 h-1"></div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script src="static/js/lib/persian-date.min.js"></script>
<script src="static/js/lib/persian-datepicker.min.js"></script>

<script>
    function setDates_(type) {
        $("#set_tarikh").show();
        $(".range-from-example").show();
        $(".month-grid-box .header").hide();
        $(".header").css("display", "inline-block");
        $(".w-100").show();
        if (type == "variz") {
            $("#date_type").val("variz");
            $("#save_date").text("ثبت زمان واریز");
        } else {
            $("#date_type").val("repay");
            $("#save_date").text("ثبت زمان بازپرداخت");
        }
        return 1;
    }

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

    function show_gharz(class_name, this_class) {
        $("a").removeClass("btn-warning");
        $("a").addClass("btn-prime");
        $("a").css("color", "#fff");
        $("." + this_class).removeClass("btn-prime");
        $("." + this_class).addClass("btn-warning");
        $("." + this_class).css("color", "#000");

        if (class_name == 'all') {
            $(".talabkari").show();
            $(".bedehkari").show();
            $(".tasviyei").show();
        } else {
            $(".talabkari").hide();
            $(".bedehkari").hide();
            $(".tasviyei").hide();
            $("." + class_name).show()

        }
    }

    function clear_content(id, type) {
        value = parseInt($("#" + id).val());
        values = $("#" + id).val();
        if (type == "in") {
            if (value == 0) {
                $("#" + id).val("");
            }
        } else {
            if (values == NaN || values == "") {
                $("#" + id).val("0");
            }
        }
    }

    function debt_type() {
        var value = $("#flexSwitchCheckChecked").prop('checked');
        if (value == true) {
            $("#user_debt_desc").text("از این فرد طلبکار هستم");
            $("#saveNewGharz").text("ایجاد طلب جدید");
        } else {
            $("#user_debt_desc").text("به این  فرد بدهکار هستم");
            $("#saveNewGharz").text("ایجاد بدهی جدید");
        }
    }

    function saveDate_() {
        shamsi = $("td.selected").attr("data-date");
        today = $("td.today").attr("data-date");
        $("#today").val(today);
        if (shamsi.length > 0) {
            $("#start_from_fa").text(shamsi);
        } else {
            shamsi = $("td.today").attr("data-date");
        }


        shamsi_split = shamsi.split(",");
        let saal, maah, rooz;

        if (shamsi_split[1] < 10) {
            maah = "0" + shamsi_split[1];
        } else {
            maah = shamsi_split[1];
        }

        if (shamsi_split[2] < 10) {
            rooz = "0" + shamsi_split[2];
        } else {
            rooz = shamsi_split[2];
        }

        today = $("td.today").attr("data-date");
        $("#today").val(today);
        farsi_date = shamsi_split[0] + "/" + maah + "/" + rooz;
        $("#start_from_fa").text(farsi_date);
        date_type = $("#date_type").val();

        if (date_type == "variz") {
            $("#variz_date").text(farsi_date);
        } else {
            $("#repay_date").text(farsi_date);
        }

        $("#set_tarikh").hide();
    }

    $("#saveNewGharz").click(function() {
        var karbar_type_pos = $("#myContacts").prop('checked');
        var fee = commafy__($("#fee").val());
        var babat = $("#babat").val();
        var newContactName = $("#newContactName").val();
        var newContactTel = $("#newContactTel").val();

        if (fee > 0 && babat.length >= 2) {
            var variz_date = $("#variz_date").text();
            var repay_date = $("#repay_date").text();

            if (karbar_type_pos == true) {
                karbar = $("#gharz_users").val();
            } else {
                karbar = newContactName + "," + newContactTel;
            }

            alert(karbar);

            var flexswitch = String($("#flexSwitchCheckChecked").prop('checked'));

            if (variz_date == "****/**/**") {
                setDates_('variz');
                saveDate_();
                variz_date = $("#variz_date").text();
                $("#set_tarikh").hide();
            }

            if (repay_date == "****/**/**") {
                setDates_('repay');
                saveDate_();
                repay_date = $("#repay_date").text();
                $("#set_tarikh").hide();
            }

            var today = $("#today").val();

            $.ajax({
                url: "server.php",
                data: "newgharz=ok&today=" + today + "&karbar=" + karbar + "&fee=" + fee + "&variz_date=" + variz_date + "&repay_date=" + repay_date + "&switch=" + flexswitch + "&babat=" + babat,
                type: "POST",
                success: function(response) {
                    window.location.reload();
                }
            });
        } else {
            Toast_msg("مبلغ و بابت و زمان واریز را مشخص کنید", "alertBox", 3000);
        }
    });

    function estelam() {
        user_tel = $("#gharz_users").val();
        $("#bedehi_user").hide();
        $("#plzwait").show();
        $.ajax({
            data: "estelam_debt=ok&karbar=" + user_tel,
            type: "POST",
            url: "server.php",
            success: function(response) {
                $("#bedehi_user").val(response);
                $("#plzwait").hide();
                $("#bedehi_user").show();
            }
        });
    }

    $(document).ready(function() {
        estelam();
    });

    function ok_gharz(id, type) {
        if (type == 0) {
            title = "طلب";
        } else {
            title = "بدهی";
        }

        var result = confirm("آیا این " + title + " تسویه شده است؟");
        if (result == true) {
            $.ajax({
                url: "server.php",
                data: "gharz_tasviye=" + id,
                type: "POST",
                success: function(response) {
                    window.location.reload();
                }
            });
        }
    }

    function del_gharz(id) {
        var result = confirm("آیا از حذف این تراکنش مطمئن هستید؟");
        if (result == true) {
            $.ajax({
                url: "server.php",
                data: "gharz_del=" + id,
                type: "POST",
                success: function(response) {
                    window.location.reload();
                }
            });
        }
    }

    function change_karbar_pos() {
        var change_karbar_pos = $("#myContacts").prop('checked');
        if (change_karbar_pos == true) {
            $("#karbar_pos").text("مخاطبین من");
            $("#old_contact").show();
            $("#new_contact").hide();
        } else {
            $("#karbar_pos").text("مخاطب جدید");
            $("#old_contact").hide();
            $("#new_contact").show();
        }
    }

    $(".my_card").click(function() {
        $(".my_card").css("height", "4.9rem");
        $(this).css("height", "max-content");
    });
</script>