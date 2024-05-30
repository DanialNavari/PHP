<?php
require_once 'db.php';
$idd = $_GET['ID'];
$resullt = $con->query("SELECT * FROM setting WHERE 1");
$row = $resullt->fetch_assoc();
$afterTime = $row['afterTime'];

$result = $con->query("SELECT * FROM sms WHERE id=" . $idd);
$rows = $result->fetch_assoc();
$alan = time();
$sendTime = $rows['sendtime'];
$zaman = $rows['zaman'] * 3600;
$expire = $sendTime + $zaman;
if ($alan < $expire) {
    $fee = $rows['finalpay'];
} else {
    $fee = round($rows['fee'] * $afterTime, 0);
}
$res = $con->query("UPDATE sms SET acceptFee=" . $fee . " WHERE id=" . $idd);

if ($res) {
    $data = array("merchant_id" => "eaae8ad7-0302-4219-aa2e-dcda8739f35c",
        "amount" => $fee,
        "callback_url" => "https://www.baharara.com/verify.php",
        "description" => "وصول مطالبات",
        "metadata" => ["email" => "info@baharara.com", "mobile" => "05138768445"],
    );
    $jsonData = json_encode($data);
    $ch = curl_init('https://api.zarinpal.com/pg/v4/payment/request.json');
    curl_setopt($ch, CURLOPT_USERAGENT, 'ZarinPal Rest Api v1');
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($jsonData),
    ));

    $result = curl_exec($ch);
    $err = curl_error($ch);
    $result = json_decode($result, true, JSON_PRETTY_PRINT);
    curl_close($ch);

    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        if (empty($result['errors'])) {
            if ($result['data']['code'] == 100) {
                //header('Location: https://www.zarinpal.com/pg/StartPay/' . $result['data']["authority"]);
                $autCode =  $result['data']["authority"];
                $res = $con->query("UPDATE sms SET refID='" . $autCode . "' WHERE id=" . $idd);                
            }
        } else {
            echo 'Error Code: ' . $result['errors']['code'];
            echo 'message: ' . $result['errors']['message'];

        }
    }
} else {
    echo 'اطلاعات پرداخت نادرست است';
}