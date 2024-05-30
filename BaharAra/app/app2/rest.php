<?php require_once('public_css.php');
include_once('func.php');
?>

<link rel="stylesheet" href="static/css/lib/persian-datepicker.min.css" />
<link rel="stylesheet" href="static/css/main.css" />

<div class=" items">
    <fieldset>
        <legend>تاریخ مرخصی</legend>
        <table>
            <tr>
                <td>
                    <a class="btn btn-info btn-return v3 toggle_from">
                        <h5>تاریخ شروع: <span id="start_from_fa"></span>
                            <span id="start_from_en"></span>
                            <span id="start_unix"></span>
                        </h5>
                    </a>
                    <div class="range-from-example"></div>
                </td>
            </tr>
            <tr>
                <td>
                    <a class="btn btn-info btn-return v3 toggle_to">
                        <h5>تاریخ پایان: <span id="end_to_fa"></span>
                            <span id="end_to_en"></span>
                            <span id="end_unix"></span>
                        </h5>
                    </a>
                    <div class="range-to-example"></div>
                </td>
            </tr>
        </table>
    </fieldset>
</div>

<div class=" items">
    <fieldset>
        <legend>مرخصی ساعتی</legend>
        <table>
            <tr>
                <td>
                    از(ساعت):
                    <input type="time" class="form-control" id="from_rest_hour" />
                </td>
            </tr>
            <tr>
                <td>
                    تا(ساعت):
                    <input type="time" class="form-control" id="to_rest_hour" />
                </td>
            </tr>

        </table>
    </fieldset>
</div>

<div class=" items">
    <fieldset>
        <legend>سایر</legend>
        <table>
            <tr>
                <td>
                    علت:
                    <input type="text" class="form-control" id="reason" />
                </td>
            </tr>

        </table>
    </fieldset>
    <fieldset id="opr">
        <button class="btn btn-success" id="save" onclick="save()">ذخیره</button>
        <button class="btn btn-info" id="return" onclick="open_page('enter')">بازگشت</button>
    </fieldset>
</div>

<?php
$back = 1;
require_once('slider.php'); ?>
<input type=" hidden" id="uid" value="<?php echo $_COOKIE['uid']; ?>" />

<script src="./js/index.js"></script>
<script src="static/js/lib/persian-date.min.js"></script>
<script src="static/js/lib/persian-datepicker.min.js"></script>

<script>
    function date_diffrence() {
        d1 = parseInt($('#start_unix').text());
        d2 = parseInt($('#end_unix').text());
        var t1 = d1.getTime() / 1000
        var t2 = d2.getTime() / 1000
        var diff = Math.abs(d1 - d2);
        let final = diff / (60 * 60 * 24);
    }

    $(' .toggle_from').click(function() {
        $(".range-from-example").toggle(500);
        $(".range-to-example").hide(500);
        $('.month-grid-box .header').hide();
    });
    $('.toggle_to').click(function() {
        $(".range-from-example").hide(500);
        $(".range-to-example").toggle(500);
        $('.month-grid-box .header').hide();
    });
    var to, from;
    to = $(".range-to-example").persianDatepicker({
        inline: true,
        altField: '.range-to-example-alt',
        altFormat: 'LLLL',
        initialValue: false,
        onSelect: function(unix) {
            $('#end_unix').text(unix);
            const d = new Date(unix);
            var year = d.getFullYear();
            var month = ("0" + (d.getMonth() + 1)).slice(-2);
            var rooz = ("0" + d.getDate()).slice(-2);
            $.ajax({
                data: 'zaman=' + year + '-' + month + '-' + rooz,
                url: 'server.php',
                type: 'POST',
                success: function(result) {
                    $('#end_to_fa').text(result);
                    $('#end_to_en').text(year + '-' + month + '-' + rooz);
                }
            });
            to.touched = true;
            if (from && from.options && from.options.maxDate != unix) {
                var cachedValue = from.getState().selected.unixDate;
                from.options = {
                    maxDate: unix
                };
                if (from.touched) {
                    from.setDate(cachedValue);
                }
            }
        }
    });
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
            $.ajax({
                data: 'zaman=' + year + '-' + month + '-' + rooz,
                url: 'server.php',
                type: 'POST',
                success: function(result) {
                    $('#start_from_fa').text(result);
                    $('#start_from_en').text(year + '-' + month + '-' + rooz);
                }
            });
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

    function save() {
        let uid = $('#uids').val();
        let start_unix = $('#start_unix').text();
        let start_fa = $('#start_from_fa').text();
        let end_unix = $('#end_unix').text();
        let end_fa = $('#end_to_fa').text();
        let reason = $('#reason').val();
        let to_rest_hour = $('#to_rest_hour').val();
        let from_rest_hour = $('#from_rest_hour').val();

        if (start_unix == '' || end_unix == '' || reason == '') {
            alert('لطفا تمامی فیلد ها را تکمیل کنید');
        } else {
            $.ajax({
                data: 'rest=ok&uid=' + uid + '&s_unix=' + start_unix + '&s_fa=' + start_fa + '&e_unix=' + end_unix + '&e_fa=' + end_fa + '&from_hour=' + from_rest_hour + '&to_hour=' + to_rest_hour + '&reason=' + reason,
                url: 'server.php',
                type: 'GET',
                success: function(result) {
                    if (result == 1) {
                        alert('برگه مرخصی شما با موفقیت ثبت شد');
                        window.location.reload();
                    }
                }
            });
        }
    }
</script>

<style>
    #masir_field,
    #opr {
        margin-top: 0.6rem;
    }

    #opr {
        display: flex;
        flex-direction: column;
        align-items: stretch;
        gap: 0.5rem;
    }

    .month-grid-box .header {
        display: none;
    }

    fieldset {
        height: max-content;
    }

    .v3 svg {
        color: #fff;
    }

    .v3 {
        width: 100%;
        height: 2rem;
        margin-bottom: 0.5rem;
        background: #024f59;
        color: #fff;
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;
        justify-content: flex-start;
        align-items: stretch;
        gap: 0.2rem;
    }

    .show_date {
        display: block;
    }

    .range-from-example,
    .range-to-example {
        display: none;
        margin-bottom: 0.3rem;
    }

    select {
        width: 90% !important;
        font-size: 0.9rem;
    }

    #route {
        font-size: 0.7rem;
        width: 90%;
        padding: 0.3rem;
        display: flex;
        align-items: center;
        flex-wrap: nowrap;
        flex-direction: row;
        gap: 0.4rem;
        overflow: scroll;
    }

    fieldset {
        display: flex;
        flex-direction: column;
    }

    .gt {
        color: #fd1f1f;
        padding: 0.1rem;
        font-weight: bold;
        margin-left: 0.1rem;
    }

    .items {
        margin-bottom: -4rem;
        margin-top: 3rem;
    }

    table {
        width: 90%;
    }

    td {
        text-align: center;
        padding: 0.2rem;
        font-size: 0.9rem;
    }

    select {
        font-size: 0.9rem;
    }

    #start_from_en,
    #end_to_en,
    #start_unix,
    #end_unix {
        display: none;
    }

    #mission_name {
        width: 90%;
    }

    .pelak {
        display: flex;
        flex-direction: row-reverse;
        align-items: stretch;
        gap: 0.4rem;
        flex-wrap: nowrap;
    }

    .pelak input,
    .pelak select {
        text-align: center;
    }

    h5,
    .h5 {
        font-size: 0.9rem;
    }

    button#addCity {
        width: 19.2rem;
        border-radius: 0.2rem;
        margin-top: -0.3rem;
        margin-bottom: 0.5rem;
    }

    .route_box {
        background: #E0E0E0;
        width: fit-content;
        height: 2.6rem;
        padding: 0.3rem;
        border-radius: 0.2rem;
        color: #024f59;
        font-weight: bold;
        display: flex;
        align-items: center;
    }

    .btn-close {
        background: transparent url("img/close.png") center/1em auto no-repeat;
        width: 0.7rem;
        height: 0.7rem;
        outline: none;
        border: none;
        cursor: pointer;
        float: right;
        padding: 0.5rem;
        margin-left: 0.2rem;
    }

    a.btn.btn-info.btn-return.v3.toggle_from {
        border-radius: 0.3rem;
    }
</style>