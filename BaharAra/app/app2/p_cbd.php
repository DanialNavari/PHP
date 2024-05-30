<?php
$x = getUidInfo($_COOKIE['uid']);
$line = $x['line'];
if ($line == '5') {
    $postCode = '
    <span>کد پستی :</span>
    <div>
        <input type="tel" id="codem" class="form-control" />
    </div>';
    $shop__ = '
    <span style="margin-top:1rem">نام فروشگاه : </span>
    <div>
        <input type="text" id="shop_name" class="form-control" value="مشتریان فضای مجازی(0490014)" disabled/>
        <input type="hidden" id="loc_id" class="form-control" value="' . $_GET['loc'] . '" />
        <input type="hidden" id="login_shop" class="form-control" value="' . date('Y-m-d H:i:s') . '" />
        <input type="hidden" id="factor_id" class="form-control" value="' . date('ymd') . date('His') . time() . '" />
    </div>';
    $buy_ = '<button class="btn btn-warning" id="positive">+</button>';
    $insta_id = '
        <span style="margin-top:1rem">آیدی اینستاگرام  : </span>
        <div>
            <input type="text" id="insta_id" class="form-control" value=""/>
        </div>';
} else {
    $postCode = '
    <span>کدملی :</span>
    <div>
        <input type="tel" id="codem" class="form-control" />
    </div>';
    $shop__ = '
    <span style="margin-top:1rem">نام فروشگاه : </span>
    <div>
        <input type="text" id="shop_name" class="form-control" />
        <input type="hidden" id="loc_id" class="form-control" value="' . $_GET['loc'] . '" />
        <input type="hidden" id="login_shop" class="form-control" value="' . date('Y-m-d H:i:s') . '" />
        <input type="hidden" id="factor_id" class="form-control" value="' . date('ymd') . date('His') . time() . '" />
        <input type="hidden" id="insta_id" class="form-control" value=""/>
    </div>';
    $buy_ = '
    <button class="btn btn-warning" id="positives">+</button>
    <button class="btn btn-warning" id="negetives">-</button>
    ';
    $insta_id = '';
}
?>
<fieldset class='hor' style="height: inherit;" id="cdb_form">
    <legend>ثبت گزارش ویزیت</legend>
    <?php echo $shop__; ?>
    <span>نام مشتری : </span>
    <div>
        <input type="text" id="shop_manager" class="form-control" />
    </div>
    <?php echo $insta_id; ?>
    <span>آدرس: </span>
    <div style="margin-bottom: 1rem;">
        <input type="text" id="shop_addr" class="form-control" />
    </div>

    <?php echo $postCode; ?>

    <span>تلفن :</span>
    <div>
        <input type="tel" id="shop_tel" class="form-control" />
    </div>
    <!-- <span>مشتری :</span> -->
    <div id="customer_types" style="display:none">
        <label for="customer_old">قدیم</label><input type="radio" id="customer_old" name="customer" class="form-control" onclick="customer(0)" />
        <label for="customer_new">جدید</label><input type="radio" id="customer_new" name="customer" checked class="form-control" onclick="customer(1)" />
        <input type="hidden" id="customer_type" value="new" />
    </div>
    <span>وضعیت خرید :</span>
    <div id="buy_pos">
        <?php echo $buy_; ?>
    </div>
    <button class="btn btn-info" id="return" onclick="open_page('cbd')">بازگشت</button>
</fieldset>

<script>
    function checkCodem() {
        let codem = $('#codem').val();
        const sp = codem.split("");
        let len = sp.length;
        let jaam = 0;

        for (i = 0; i <= 8; i++) {
            jaam += (parseInt(sp[i]) * (10 - i));
        }

        let dev = (jaam % 11);

        if (dev >= 2) {
            mande = 11 - dev;
        } else {
            mande = dev;
        }

        if (sp[9] == dev) {
            return 1;
        } else {
            return 0;
        }
    }

    $('#negetive').click(function() {
        if (
            $("#shop_name").val() == "" ||
            $("#shop_manager").val() == "" ||
            $("#shop_tel").val() == "" ||
            $("#customer_type").val() == ""
        ) {

        } else {
            var loc = $("#loc_id").val();
            if (loc > 0) {
                loc = $("#loc_id").val();
            } else {
                loc = 0;
            }
        }
    });

    $('#codem').focusout(function() {
        let checkCodems = checkCodem();
        if (checkCodems == 0) {
            alert('کد ملی نادرست است');
            $('#codem').val("");
        }
    });

    $("#positives").click(function() {
        codem = $('#codem').val();
        if (codem.length > 0) {
            customer(1);
            order(1);
            $(".return_home").hide();
        } else {
            alert('لطفا همه فیلدها را کامل کنید');
        }
    });

    $("#negetives").click(function() {
        customer(1);
        order(0);
        $(".return_home").hide();
    });
</script>

<style>
    .page {
        margin-bottom: 2rem;
    }
</style>