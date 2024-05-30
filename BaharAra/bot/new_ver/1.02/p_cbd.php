<fieldset class='hor' style="height: inherit;" id="cdb_form">
    <legend>ثبت گزارش ویزیت</legend>
    <span style="margin-top:1rem">نام فروشگاه : </span>
    <div>
        <input type="text" id="shop_name" class="form-control" />
        <input type="hidden" id="loc_id" class="form-control" value="<?php echo $_GET['loc']; ?>" />
        <input type="hidden" id="login_shop" class="form-control" value="<?php echo date('Y-m-d H:i:s'); ?>" />
        <input type="hidden" id="factor_id" class="form-control" value="<?php echo date('ymd') . date('His'); ?>" />
    </div>
    <span>نام مسئول : </span>
    <div>
        <input type="text" id="shop_manager" class="form-control" />
    </div>
    <span>آدرس: </span>
    <div style="margin-bottom: 1rem;">
        <textarea id="shop_addr" class="form-control" style="width: 15rem;"></textarea>
    </div>
    <span>کدملی :</span>
    <div>
        <input type="tel" id="codem" class="form-control" />
    </div>
    <span>تلفن :</span>
    <div>
        <input type="tel" id="shop_tel" class="form-control" />
    </div>
    <span>مشتری :</span>
    <div id="customer_type">
        <label for="customer_old">قدیم</label><input type="radio" id="customer_old" name="customer" class="form-control" onclick="customer(0)" />
        <label for="customer_new">جدید</label><input type="radio" id="customer_new" name="customer" class="form-control" onclick="customer(1)" />
        <input type="hidden" id="customer_type" value="" />
    </div>
    <span>وضعیت خرید :</span>
    <div id="buy_pos">
        <button class="btn btn-warning" id="positive">+</button>
        <button class="btn btn-warning" id="negetive">-</button>
    </div>
    <button class="btn btn-info" id="return" onclick="open_page('cbd')">بازگشت</button>
</fieldset>

<script>
    $('#negetive').click(function() {
        if (
            $("#shop_name").val() == "" ||
            $("#shop_manager").val() == "" ||
            $("#shop_tel").val() == "" ||
            $("#customer_type").val() == ""
        ) {
            alert("لطفا همه فیلد ها را تکمیل کنید");
        } else {
            var loc = $("#loc_id").val();
            if (loc > 0) {
                loc = $("#loc_id").val();
            } else {
                loc = 0;
            }
        }
    });
</script>

<style>
    .page {
        margin-bottom: 2rem;
    }
</style>