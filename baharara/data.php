<?php
$path = "https://ip-api.ir/info/" . $_GET['ip'] . "/status,message,country,regionName,city,query";
$cont = file_get_contents($path);
$js = json_decode($cont, true);
$country = $js['country'];
print($country);
