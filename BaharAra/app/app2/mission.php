<?php require_once('public_css.php');
include_once('func.php');
$masir = masir();
?>

<link rel="stylesheet" href="static/css/lib/persian-datepicker.min.css" />
<link rel="stylesheet" href="static/css/main.css" />

<div class=" items">
    <fieldset>
        <legend>عنوان ماموریت</legend>
        <input type="text" class="form-control" id="mission_name" />
    </fieldset>
    <fieldset id="masir_field">
        <legend>مسیر ماموریت</legend>
        <span id="route">
            <div class="route_box">
                مشهد
            </div>
        </span>
        <span id="route_array" style="display:none;"></span>
        <input type="text" id="search_box" class="form-control" style="width:90%" placeholder="نام شهر را وارد کنید" />
        <!-- <select class="form-control" id="masir_">
        </select> -->
        <button class="btn btn-info" id="addCity" onclick="addCity()">ثبت شهر</button>
    </fieldset>
</div>

<div class=" items">
    <fieldset>
        <legend>زمان اعزام</legend>
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
        <legend>وسیله نقلیه</legend>
        <table>
            <tr>
                <td>
                    کاربری:
                    <select id="device" class="form-control" style="width: 83vw !important;" onchange="vehicle_set()">
                        <option value="1">سواری</option>
                        <option value="2">وانت</option>
                        <option value="3">اتوبوس</option>
                    </select>
                </td>
            </tr>
            <tr class="device_plak">
                <td>
                    نام خودرو:
                    <input type="text" class="form-control" id="vehicle_name" />
                </td>
            </tr>
            <tr class="device_plak">
                <td>پلاک:</td>
            </tr>
            <tr class="device_plak">
                <td>
                    <div class="pelak">
                        <input type="number" class="form-control" id="pelak_2" maxlength="2" />
                        <select class="form-control" id="pelak_alph" readonly>
                            <option value="ب">ب</option>
                            <option value="ج">ج</option>
                            <option value="د">د</option>
                            <option value="س">س</option>
                            <option value="ص">ص</option>
                            <option value="ط">ط</option>
                            <option value="ق">ق</option>
                            <option value="ل">ل</option>
                            <option value="م">م</option>
                            <option value="ن">ن</option>
                            <option value="و">و</option>
                            <option value="هـ">هـ</option>
                            <option value="ی">ی</option>
                        </select>
                        <input type="number" class="form-control" id="pelak_3" maxlength="3" />
                        <input type="number" class="form-control" id="pelak_city" maxlength="2" /> ایران
                    </div>
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
//$page_title = 'فرم ماموریت پرسنل';
$back = 1;
require_once('slider.php'); ?>
<input type=" hidden" id="uid" value="<?php echo $_COOKIE['uid']; ?>" />

<script src="./js/index.js"></script>

<script>
    //$('#headTitle').text('فرم ماموریت پرسنل');
    document.getElementById('device').addEventListener("change", vehicle_set);

    function vehicle_set() {
        let device = $(this).val();
        if (device == 3) {
            $('.device_plak').hide();
            $('#vehicle_name').val('-');
            $('#pelak_2').val('-');
            $('#pelak_3').val('-');
            $('#pelak_alph').val('-');
            $('#pelak_city').val('-');
        } else {
            $('.device_plak').show();
            $('#vehicle_name').val('');
            $('#pelak_2').val('');
            $('#pelak_3').val('');
            $('#pelak_alph').val('');
            $('#pelak_city').val('');
        }
    }

    function search() {
        // Declare variables
        var input, filter, ul, li, a, i, txtValue;
        input = document.getElementById('search_box');
        filter = input.value;
        ul = document.getElementById("masir_");
        li = ul.getElementsByTagName('option');

        // Loop through all list items, and hide those who don't match the search query
        for (i = 0; i < li.length; i++) {
            a = li[i];
            txtValue = a.textContent || a.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                li[i].style.display = "";
            } else {
                li[i].style.display = "none";
            }
        }
    }

    function date_diffrence() {
        d1 = parseInt($('#start_unix').text());
        d2 = parseInt($('#end_unix').text());
        var t1 = d1.getTime() / 1000
        var t2 = d2.getTime() / 1000
        var diff = Math.abs(d1 - d2);
        let final = diff / (60 * 60 * 24);
    }

    function addCity() {
        let shahr = [];
        let cont = $('#search_box').val();
        if (cont == '' || cont == null) {
            alert('نام شهر را وارد کنید');
        } else {
            $.ajax({
                data: 'masir=' + cont,
                url: 'server.php',
                method: 'GET',
                success: function(result) {
                    if (result == 0) {
                        alert('شهر مورد نظر پیدا نشد');
                    } else {
                        let masirha = '';
                        const obj = JSON.parse(result);
                        var iid = obj[0]['id'];
                        masirha += "<div class='route_box " + iid + "'>" + obj[0]['city'] + "<button type='button' class='btn-close btn-close-white' aria-label='Close' onclick='closeCity(" + iid + ")'></button></div>";
                        let mas = $('#route').html();
                        $('#route').html(mas + masirha);
                        let address = $('#route_array').html();
                        $('#route_array').html(address + obj[0]['id'] + ',');
                        shahr.push(cont);
                        $('#search_box').val('');

                    }
                }
            });
        }
    }
</script>

<script src="static/js/lib/persian-date.min.js"></script>
<script src="static/js/lib/persian-datepicker.min.js"></script>

<script>
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
        let mission_name = $('#mission_name').val();
        let uid = $('#uids').val();
        let route = $('#route_array').text();
        let start_unix = $('#start_unix').text();
        let start_fa = $('#start_from_fa').text();
        let end_unix = $('#end_unix').text();
        let end_fa = $('#end_to_fa').text();
        let device = $('#device').val();
        let vehicle = $('#vehicle_name').val();
        let pelak_2 = $('#pelak_2').val();
        let pelak_alph = $('#pelak_alph').val();
        let pelak_3 = $('#pelak_3').val();
        let pelak_city = $('#pelak_city').val();
        if (route == '' || start_fa == '' || end_fa == '') {
            alert('لطفا تمامی فیلد ها را تکمیل کنید');
        } else {
            $.ajax({
                data: 'mission=' + mission_name + '&uid=' + uid + '&route=' + route + '&s_unix=' + start_unix + '&s_fa=' + start_fa + '&e_unix=' + end_unix + '&e_fa=' + end_fa + '&device=' + device + '&vehicle=' + vehicle + '&p_2=' + pelak_2 + '&p_al=' + pelak_alph + '&p_3=' + pelak_3 + '&p_city=' + pelak_city,
                url: 'server.php',
                type: 'GET',
                success: function(result) {
                    if (result == 1) {
                        alert('برگه ماموریت شما با موفقیت ثبت شد');
                        window.location.reload();
                    }
                }
            });
        }
    }

    function closeCity(id) {
        $('.' + id).remove();
        var txt = String(id) + ',';
        var route = $('#route_array').text();
        $('#route_array').text(route.replace(txt, ''));
    }
</script>

<style>
    a.btn.btn-info.btn-return.v3.toggle_from {
        border-radius: 0.3rem;
    }

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
</style>