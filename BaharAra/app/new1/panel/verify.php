<?php
include_once('../func.php');

if (isset($_GET['Authority']) && $_GET['Status'] == 'OK') {
    $Authority = $_GET['Authority'];
    $y = getPG($Authority);
    $xx = explode(',', $y);
    $data = array("merchant_id" => "aeba2dfe-1df6-4668-9390-3d35582e5bee", "authority" => $Authority, "amount" => $xx[0] * 10);
    $jsonData = json_encode($data);
    $ch = curl_init('https://api.zarinpal.com/pg/v4/payment/verify.json');
    curl_setopt($ch, CURLOPT_USERAGENT, 'ZarinPal Rest Api v4');
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($jsonData)
    ));

    $result = curl_exec($ch);
    curl_close($ch);
    $result = json_decode($result, true);
    if ($result['data']['code'] == 100 || $result['data']['code'] == 101) {
        $card = $result['data']['card_pan'];
        $ref_id = $result['data']['ref_id'];
        $x = setPG($Authority, $card, $ref_id);
        if ($x == 1) {
            $factor_code = $xx[1];
            echo '
            <div>
                <p>فاکتور شماره ' . $factor_code . ' به مبلغ ' . sep3($xx[0]) . ' تومان  با کد پیگیری : ' . $ref_id . ' پرداخت گردید</p>
                <br/>
                <p><a href="https://perfumeara.com">بازگشت به سایت</a></p>
            </div>';
            //paid
        } else {
            echo $x;
            //no paid
        }
    }
} else {
}
?>
<link rel="stylesheet" href="../css/index.css" />

<style>
    p,
    a {
        font-family: iransans;
        font-size: 1.3rem;
        direction: rtl;
        text-align: center;
        padding: 2rem;
        color: #FFEB3B;
        text-decoration: none;
    }
</style>