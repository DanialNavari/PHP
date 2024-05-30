<?php
include_once('../func.php');

$m = $_GET['m'];
$f = $_GET['f'];
$data = array(
    "merchant_id" => "aeba2dfe-1df6-4668-9390-3d35582e5bee",
    "amount" => $_GET['pg'],
    "callback_url" => "http://perfumeara.com/webapp/app_new/panel/verify.php",
    "description" => "فاکتور " . $f,
    "metadata" => ["mobile" => "$m"],
);
$jsonData = json_encode($data);
$ch = curl_init('https://api.zarinpal.com/pg/v4/payment/request.json');
curl_setopt($ch, CURLOPT_USERAGENT, 'ZarinPal Rest Api v1');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($jsonData)
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
            $x = PG($f, $result['data']["authority"]);
            echo $x;
            if ($x == 1) {
                header('Location: https://www.zarinpal.com/pg/StartPay/' . $result['data']["authority"]);
            }
        }
    } else {
        echo 'Error Code: ' . $result['errors']['code'];
        echo 'message: ' .  $result['errors']['message'];
    }
}
