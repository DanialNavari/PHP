<?php
require_once 'db.php';
$id=0;
if (isset($_POST['lastCode'])) {
    $result = $con->query("SELECT * FROM sms WHERE 1 ORDER BY id DESC");
    $row = $result->fetch_assoc();
    if (is_null($row['id'])) {
        $id = 0;
    } else {
        $id = $row['id'];
    }
    echo $id + 1;
} elseif (isset($_POST['phone'])) {
    $idd = $id+1;
    $esm = $_POST['esm'];
    $phone = $_POST['phone'];
    $zaman = $_POST['zaman'];
    $less = $_POST['less'];
    $finalpay = $_POST['finalpay'];
    $fee = $_POST['fee'];
    $matn = $_POST['matn'];
    $result = $con->query('UPDATE `sms` SET `esm`="'.$esm.'",`phone`='.$phone.',`fee`='.$fee.',
    `zaman`=' . $zaman . ',`less`='.$less.',`finalpay`='.$finalpay.',
    `matn`="'.$matn.'",`sendtime`="'.time().'" WHERE `id`=' . $idd);
    if ($result) {
        echo '
    <div class="row result alert alert-success">
پیامک با موفقیت ارسال شد
    </div>';
    }
} else {
    $esm = $_SESSION['name'];
    $rule = $_SESSION['rule'];
    echo '
<div class="row login">
    <fieldset>
        <legend class="text-primary">
            پنل ' . $esm . '<br />
            <span class="subtitle">(' . $rule . ')</span>
        </legend>

            <!-- contact name -->
            <label for="esm">
                نام مخاطب :
            </label>
            <input type="text" name="esm" id="esm" class="form-control"><br />

            <!-- contact number -->
            <label for="phone">
                شماره مخاطب :
            </label>
            <input type="number" name="phone" id="phone" class="form-control"><br />

            <!-- contact fee -->
            <label for="fee">
                مبلغ فاکتور (ریال) :
            </label>
            <input type="number" name="fee" id="fee" class="form-control" onchange="nerkh()"><br />

            <!-- contact zaman -->
            <label for="zaman">
                زمان تخصیص درصد کسر :
            </label>
            <input type="number" name="zaman" id="zaman" class="form-control"><br />

            <!-- contact less -->
            <label for="less">
                درصد کسر تا زمان مشخص شده:
            </label>
            <input type="number" name="less" id="less" class="form-control" onchange="nerkh()"><br />

            <!-- contact pay -->
            <label for="pay">
                مبلغ پرداختی (ریال) :
            </label>
            <br /><br /><span id="pay">0</span><br />
            <input type="hidden" name="pay" id="finalpay" class="form-control"><br />

            <input type="submit" value="تایید" class="btn btn-success" id="nextLevel">
            <input type="reset" value="فرم جدید" class="btn btn-primary" id="clearForm">

    </fieldset>
    <br /><br />
</div>

<div class="row final">
    <fieldset>
        <legend class="text-primary">
            پنل ' . $esm . '<br />
            <span class="subtitle">(' . $rule . ')</span>
        </legend>
        <!-- contact matn -->
            <label for="matn" class="matn">
                متن پیامک :
            </label>
            <textarea name="matn" id="matn" class="form-control matn"></textarea><br />
            <input type="submit" value="ارسال پیامک" class="btn btn-success" id="sendSMS">
<br/><div id="result"></div>
    </fieldset>
</div>
';

}
