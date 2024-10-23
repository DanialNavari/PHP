<?php

$data = array("merchant_id" => "aeba2dfe-1df6-4668-9390-3d35582e5bee",
    "amount" => $_GET['fee'],
    "callback_url" => "http://www.yoursite.com/verify.php",
    "description" => "خرید تست",
    "metadata" => [ "email" => "info@email.com","mobile"=>"09121234567"],
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

print_r($result);
// if ($err) {
//     echo "cURL Error #:" . $err;
// } else {
//     if (empty($result['errors'])) {
//         if ($result['data']['code'] == 100) {
//             header('Location: https://www.zarinpal.com/pg/StartPay/' . $result['data']["authority"]);
//         }
//     } else {
//          echo'Error Code: ' . $result['errors']['code'];
//          echo'message: ' .  $result['errors']['message'];

//     }
// }
?>