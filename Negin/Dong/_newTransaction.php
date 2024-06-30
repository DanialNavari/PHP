<link rel="stylesheet" href="static/css/lib/persian-datepicker.min.css" />
<link rel="stylesheet" href="static/css/main.css" />

<div class="row empty">
    <?php
    if (isset($_GET['id']) && $_GET['id'] > 0) {
        echo 'ویرایش خرید';
    } else {
        echo 'خرید جدید';
    }
    ?>
</div>

<div class="cat">
    <div class="card my_card">
        <?php
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            trans_edit($_GET['id']);
            share($_GET['id']);
        } else {
        }
        ?>
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

<!-- selected users -->
<div class="cat mb-1">
    <div class="card my_card border_none selected_user">

    </div>
</div>

<!-- users box -->
<?php trans_get_contact_share($_GET['id']); ?>

<div class="add_payments hide">
    <table class="border_none mx-auto">
        <tr class="font-weight-bold">
            <td class="sum pl-3 w-30">خرید کننده</td>
            <td>
                <select class="form-select sum font-weight-bold" aria-label="Default select example">
                    <option value="1">اشکان توکلی</option>
                    <option value="2">دانیال نواری</option>
                    <option value="3">علیرضا صالحی</option>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <button class="btn btn-success btn-sm w-100" id="savedate">ثبت</button>
            </td>
        </tr>
    </table>
</div>

<div class="add_course hide">
    <table class="border_none mx-auto">
        <tr class="font-weight-bold">
            <td class="sum pl-3 w-30">نام دوره</td>
            <td>
                <select class="form-select sum font-weight-bold" aria-label="Default select example">
                    <option value="1">سفر شمال</option>
                    <option value="2" selected>سفر جنوب</option>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <button class="btn btn-success btn-sm w-100" id="savedate">ثبت</button>
            </td>
        </tr>
    </table>
</div>

<div class="add_fee hide">
    <table class="border_none mx-auto">
        <tr class="font-weight-bold">
            <td class="sum pl-3 w-30">مبلغ تراکنش(ريال)</td>
            <td>
                <input class="form-control sum font-weight-bold" type="number" />
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <button class="btn btn-success btn-sm w-100" id="savedate">ثبت</button>
            </td>
        </tr>
    </table>
</div>

<div class="cat mb-1 h-1"></div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script src="static/js/lib/persian-date.min.js"></script>
<script src="static/js/lib/persian-datepicker.min.js"></script>

<script>
    function sep(id) {
        fee = $('#user-' + id).val();
        if (fee == '' || fee == null) {
            $('#user-' + id).val(0);
        } else {
            setTimeout(function() {
                $.ajax({
                    data: 'seps=' + fee,
                    url: 'server.php',
                    type: 'POST',
                    success: function(response) {
                        $('#user-' + id).val(response);
                    }
                });
            }, 200);
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
</script>