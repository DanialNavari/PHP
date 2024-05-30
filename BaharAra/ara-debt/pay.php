<?php

require_once 'db.php';
$idd = $_REQUEST['id'];
$fee = $_REQUEST['fee'];

    $data = array("merchant_id" => "aeba2dfe-1df6-4668-9390-3d35582e5bee",
        "amount" => $fee,
        "callback_url" => "https://www.baharara.com/verify.php",
        "description" => "وصول مطالبات",
        "metadata" => ["email" => "info@baharara.com", "mobile" => "09105005289"],
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
                $autCode =  $result['data']["authority"];
                $time = time();
                $sql = "UPDATE `order` SET `ref_code`='".$autCode."', `fee`='".$fee."',`order_date`='".$time."' WHERE `id`=$idd";
                $res = mysqli_query($conn,$sql);
                if($res){
                    //header('Location: https://www.zarinpal.com/pg/StartPay/' . $result['data']["authority"]);
                }
            }
        } else {
            echo 'Error Code: ' . $result['errors']['code'];
            echo 'message: ' . $result['errors']['message'];

        }
    }

?>