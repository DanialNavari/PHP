<?php
require_once("symbol.php");
require_once("main_top.php");

$ip = $_SERVER['REMOTE_ADDR'];

$ipdat = @json_decode(file_get_contents(
    "http://www.geoplugin.net/json.gp?ip=" . $ip
));

$country = $ipdat->geoplugin_countryName;
$city = $ipdat->geoplugin_city;
$continent = $ipdat->geoplugin_continentName;
$latitude = $ipdat->geoplugin_latitude;
$longitude = $ipdat->geoplugin_longitude;
$countryCode = $ipdat->geoplugin_countryCode;

if ($countryCode != "IR") {
    $security = false;
    echo '<div class="row empty"></div>
<div class="cat">
    <div class="card my_card px_1 text-center text-primary">
        <h4>لطفا فیلتر شکنتو خاموش کن</h4>
    </div>
</div>
';
} else {
    $security = true;
    echo '<script>window.location.assign(".")</script>';
}
?>

<?php include_once('javascript.php'); ?>