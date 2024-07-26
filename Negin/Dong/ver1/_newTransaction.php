<link rel="stylesheet" href="static/css/lib/persian-datepicker.min.css" />
<link rel="stylesheet" href="static/css/main.css" />
<style>
    .click {
        color: #f5faff !important;
        cursor: pointer;
    }

    .dore {
        color: #1d5da9 !important;
        cursor: pointer;
    }
</style>

<div class="row empty">
    خرید جدید
</div>

<div class="cat">
    <div class="card my_card">
        <table class="table table-hover">
            <tr class="">
                <td class="td_title va_middle w-6">نام دوره</td>
                <td class="font-weight-bold text-white text-center w-9">
                    <span class="text-center text-primary" id="course_name_show">***</span>
                </td>
                <td class="text-center dore" onclick="select_course()"><?php echo $GLOBALS['edit']; ?></td>
            </tr>
            <tr>
                <td class="td_title tarikh">تاریخ خرید</td>
                <td class="font-weight-bold text-center">
                    <span id="start_from_fa">****/**/**</span>
                </td>
                <td class="text-center click" onclick="setDate()"><?php echo $GLOBALS['edit']; ?></td>
            </tr>
            <tr id="set_tarikh" class="hide">
                <td colspan="3">
                    <span id="start_from_en" class="hide"></span>
                    <span id="start_unix" class="hide"></span>
                    <div class="range-from-example" class="hide"></div>
                </td>
            </tr>
            <tr class="hide w-100" id="calendar_">
                <td colspan="3">
                    <button class="btn btn-success btn-sm w-100" id="savedate">ثبت تاریخ</button>
                </td>
            </tr>
            <tr>
                <td class="td_title tarikh">خرید کننده</td>
                <td class="font-weight-bold text-center" id="consumer_name">
                    *****
                </td>
                <td class="text-center click" onclick="buyers('variz')"><?php echo $GLOBALS['edit']; ?></td>
                <input type="hidden" id="buyer_person" value="">
                <input type="hidden" id="sum_all_sahm" value="">
            </tr>
            <tr id="variz_konande">
                <td class="td_title tarikh">مصرف کننده</td>
                <td class="font-weight-bold text-center" id="reciver_name">

                </td>
                <td class="text-center click" onclick="buyers('recieve')"><?php echo $GLOBALS['edit']; ?></td>
            </tr>
            <tr>
                <td class="td_title">جمع مبلغ واریزی</td>
                <td class="font-weight-bold text-center" colspan="2">
                    <span id="moneyLimits">0</span> <span class="unit">
                        <?php
                        if (isset($_COOKIE['selected_course'])) {
                            $x = SELECT_course_id($_COOKIE['selected_course']);
                            echo $x['course_money_unit'];
                        } else {
                            echo 'ريال';
                        }
                        ?>
                    </span>
                </td>
            </tr>
            <!-- <tr class="force_hide">
                <td class="td_title"></td>
                <td class="font-weight-bold text-center" colspan="2">
                    <span>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="mablagh" value="mablagh">
                            <label class="form-check-label" for="mablagh"><span>مبلغ (ريال)</span></label>
                        </div>
                    </span>
                </td>
            </tr> -->
            <tr>
                <td class="td_title va_middle">توضیحات</td>
                <td class="font-weight-bold text-center" colspan="2">
                    <textarea class="form-control sum" rows="3" id="trans_desc"></textarea>
                </td>
            </tr>
        </table>
        <input type="hidden" id="buyer" value="' . $trans_buyer_code . '" />

    </div>
    <input type="hidden" id="trans_person" value="">
    <input type="hidden" id="trans_person_co" value="">

    <button class="btn btn-prime w-100 sum" onclick="addNewPayment3()" disabled><span></span> ذخیره</button>
</div>

<div class="cat mb-2">
    <div class="group_name">
        <h6 class="font-weight-bold">دریافت کنندگان</h6>
    </div>
</div>

<!-- selected users -->
<div class="cat mb-1">
    <div class="card my_card border_none selected_user" id="selected_user_rounded">

    </div>
</div>

<!-- users box -->
<div class="contacts">
</div>

<div class="add_payments hide">
    <table class="border_none mx-auto w-100">
        <tr class="font-weight-bold">
            <td class="sum pl-3 w-30">خرید کننده</td>
            <td>
                <select class="form-select sum font-weight-bold" aria-label="Default select example" id="consumers">

                </select>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <button class="btn btn-success btn-sm w-100" id="savedate2">ثبت</button>
            </td>
        </tr>
    </table>
</div>

<div class="add_course hide">
    <table class="border_none mx-auto w-100">
        <tr class="font-weight-bold">
            <td class="sum pl-3 w-30 text-center pt-1 pb-1">نام دوره را انتخاب کنید</td>
        </tr>
        <tr class="font-weight-bold">
            <td>
                <select class="form-select sum font-weight-bold" aria-label="Default select example" id="course_name">
                    <?php
                    $x = SELECT_course($_COOKIE['uid']);
                    $n = mysqli_num_rows($x);
                    for ($i = 0; $i < $n; $i++) {
                        $fet = mysqli_fetch_assoc($x);
                        $course_name = $fet['course_name'];
                        $course_id = $fet['course_id'];
                        echo '<option value="' . $course_id . '" onclick="selectSetCourse()">' . $course_name . '</option>';
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td class="user_img"></td>
        </tr>
        <tr>
            <td colspan="2">
                <button class="btn btn-success btn-sm w-100" id="setCourses">ثبت</button>
            </td>
        </tr>
    </table>
</div>

<div class="add_fee hide">
    <table class="border_none mx-auto">
        <tr class="font-weight-bold">
            <td class="sum pl-3 w-30">مبلغ تراکنش(ريال)</td>
            <td>
                <input class="form-control sum font-weight-bold" type="text" id="trans_cost" />
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <button class="btn btn-success btn-sm w-100" id="savedate1">ثبت</button>
            </td>
        </tr>
    </table>
</div>

<div class="add_manager variz">
    <div class="popup_header">
        <h6 class="popup_header_title"></h6>
        <div id="popup_trans_type" class="force_hide">
            <div class="form-check popup_group" onclick="">
                <input class="form-check-input" type="radio" id="zarib" name="type">
                <label class="form-check-label mr_1 ml-2 text-center w-100" for="zarib">ضریب</label>
            </div>
            <div class="form-check popup_group" onclick="">
                <input class="form-check-input" type="radio" id="mablagh" name="type">
                <label class="form-check-label mr_1 ml-2 text-center w-100" for="mablagh">مبلغ</label>
            </div>
        </div>
        <div class="popup_btn">
            <div class="end_course bg-white w-5" id="div_sabt">
                <div class="btn btn-default click1 w-100" id="div_cal" onclick="focus_out()">ثبت</div>
            </div>
            <div class="end_course bg-white w-5">
                <div class="btn btn-warning click1 w-100" onclick="cancelManager()">بازگشت</div>
            </div>
        </div>
        <div id="popup_sum">
            <?php $x = SELECT_course_id($_COOKIE['selected_course']);
            if ($x) {
                $money_unit = $x['course_money_unit'];
            } else {
                $money_unit = 'ريال';
            }
            ?>
            <div class="div_all">
                <div class="div_summ_all">
                    <h6>مبلغ خرید : </h6><input class="form-control w-9 d-ltr" type="text" id="sum_variz" onkeyup="commafy('sum_variz')">
                    <h6><?php echo $money_unit; ?></h6>
                </div>
                <div class="div_share">
                    <!-- <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="zaribs">
                        <label class="form-check-label" for="zaribs">
                        ضریب
                        </label>
                    </div> -->
                    <div class="form-check force_hide">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="mablaghs" checked>
                        <label class="form-check-label" for="mablaghs">
                            مبلغ
                        </label>
                    </div>
                    <div class="form-check" onclick="buy_for_all()">
                        <input class="form-check-input" type="checkbox" name="buyforall" id="buyforall" checked>
                        <label class="form-check-label" for="buyforall">
                            خرید برای همه
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="popup_body"></div>
</div>

<div class="course_id"></div>
<div class="cat mb-1 h-1"></div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script src="static/js/lib/persian-date.min.js"></script>
<script src="static/js/lib/persian-datepicker.min.js"></script>
<input type="hidden" value="<?php echo $_GET['id']; ?>" id="trans_id" />

<script>
    $(document).ready(function() {
        $("#karbaran").val("");
    });

    $('#zarib').hide();
    $('label').filter("[for='zarib']").hide();
    $('#mablagh').hide();
    $('label').filter("[for='mablagh']").hide();

    $('#savedate2').click(function() {
        consumers_code = $('#consumers').val();
        consumers_name = $('#consumers option:selected').text();
        $('#buyer').val(consumers_code);
        $('#consumer_name').text(consumers_name);
        $('.gray_layer').click();

        $.ajax({
            data: "buyer=" + consumers_code,
            url: "server.php",
            type: "POST",
            success: function(response) {},
        });
    });

    $('#savedate1').click(function() {
        fee = $('#trans_cost').val();
        if (parseInt(fee) > 0) {
            $.ajax({
                data: "seps=" + fee,
                url: "server.php",
                type: "POST",
                success: function(response) {
                    $('#moneyLimit').text(response);
                },
            });
            $('.gray_layer').click();
            $('#trans_cost').val('');
        } else {
            $('.gray_layer').click();
        }
    });

    $(':radio').click(function() {
        radio_btn = $(this).attr('id');
        trans_id = $('#trans_id').val();

        if (radio_btn == 'zarib') {
            trans_value = 'coefficient';
        } else {
            trans_value = 'amount';
        }

        $.ajax({
            data: 'list_type=' + trans_value,
            url: 'server.php',
            type: 'POST',
            success: function(response) {
                $('.contacts').html(response);
                $(".btn").removeAttr("disabled");
            }
        });
    });

    function sep(id) {
        fee = $('#' + id).val();
        if (fee == '' || fee == null) {
            $('#' + id).val(0);
        } else {
            setTimeout(function() {
                $.ajax({
                    data: 'seps=' + fee,
                    url: 'server.php',
                    type: 'POST',
                    success: function(response) {
                        $('#' + id).val(response);
                    }
                });
            }, 100);
        }
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

    $('#setCourses').click(function() {
        let course_value_id = $("#course_name").val();
        let course_id = $(".course_id").text(course_value_id);
        let course_value_text = $("#course_name option:selected").text();

        $("#course_name_show").text(course_value_text);
        $(".add_course").hide();
        $(".gray_layer").click();
        $("td.click").addClass("dore");
        $("#consumer_name").text("****");
        $(".contacts").empty();
        $('#savedate').click();

        $.ajax({
            data: "getContactList=" + course_value_id,
            url: "server.php",
            type: "POST",
            success: function(response) {
                $("#zarib").show();
                $("label").filter("[for='zarib']").show();
                $("#mablagh").show();
                $("label").filter("[for='mablagh']").show();
                $("#karbaran").remove();
                $("#mablagh").click();

                $.ajax({
                    data: "setContactList=" + course_value_id,
                    url: "server.php",
                    type: "POST",
                    success: function(response) {
                        $("#consumers").html(response);
                    },
                });
            },
        });
    });

    function default_course_data(tel) {
        $('#savedate').click();
        $.ajax({
            data: "default_course_data=" + tel,
            type: "POST",
            url: "server.php",
            success: function(response) {
                x = response.split(',');
                $(".course_id").text(x[0]);
                $("#course_name_show").text(x[1]);
                $("option[value='" + x[0] + "']").attr('selected', 'selected');
                $('#setCourses').click();
            },
        });
    }

    default_course_data("<?php echo $_COOKIE['uid']; ?>");
</script>

<?php
if (isset($_COOKIE['selected_course'])) {
} else {
    echo '<script>window.location.reload();</script>';
}

?>