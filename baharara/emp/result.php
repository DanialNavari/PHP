<?php
require_once '../db_result.php';
$sql = "DELETE FROM utm WHERE utm_source LIKE '%sanitized%'";
$result = mysqli_query($conn, $sql);

function count_num($arr)
{
    global $sum;
    $c = count(($arr));
    $sum = 0;
    foreach ($arr as $key => $value) {
        $sum += $value;
    }
}

function print_arr($arr)
{
    foreach ($arr as $key => $value) {
        print($key . " = " . $value . "<br/>");
    }
}

function get_location($arr)
{
    global $country;
    $country = [];
    foreach ($arr as $key => $value) {
        $x = file_get_contents('https://baharara.com/data.php?ip=' . $key);
            $country[$x] += $value;
    }
}

$zaman = $_GET['date'];
$device = [];
$brand = [];
$model = [];
$saat = [];

$utm_source = [];
$utm_medium = [];
$utm_campaign = [];
$utm_content = [];
$utm_term = [];

$page = [];
$platform = [];
$ip = [];
$ip_loc = [];

$sql = "SELECT * FROM utm WHERE zaman LIKE '%" . $zaman . "%' ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
if ($result) {
    $num = mysqli_num_rows($result);
    for ($i = 0; $i < $num; $i++) {
        $row = mysqli_fetch_assoc($result);
        //utm_source--------------------------------------
        if ($utm_source[$row['utm_source']] > 0) {
            $utm_source[$row['utm_source']] += 1;
        } else {
            $utm_source[$row['utm_source']] = 1;
        }

        //utm_medium--------------------------------------
        if ($utm_medium[$row['utm_medium']] > 0) {
            $utm_medium[$row['utm_medium']] += 1;
        } else {
            $utm_medium[$row['utm_medium']] = 1;
        }

        //utm_medium--------------------------------------
        if ($utm_campaign[$row['utm_campaign']] > 0) {
            $utm_campaign[$row['utm_campaign']] += 1;
        } else {
            $utm_campaign[$row['utm_campaign']] = 1;
        }

        //utm_content--------------------------------------
        if ($utm_content[$row['utm_content']] > 0) {
            $utm_content[$row['utm_content']] += 1;
        } else {
            $utm_content[$row['utm_content']] = 1;
        }

        //utm_term--------------------------------------
        if ($utm_term[$row['utm_term']] > 0) {
            $utm_term[$row['utm_term']] += 1;
        } else {
            $utm_term[$row['utm_term']] = 1;
        }

        //page--------------------------------------
        $pages = explode('/', $row['page']);
        if ($page[$pages[2]] > 0) {
            $page[$pages[2]] += 1;
        } else {
            $page[$pages[2]] = 1;
        }

        //saat--------------------------------------
        $zamani = explode(' ', $row['zaman']);
        $saati = explode(':', $zamani[1]);
        if ($saat[$saati[0]] > 0) {
            $saat[$saati[0]] += 1;
        } else {
            $saat[$saati[0]] = 1;
        }

        //platform--------------------------------------
        $platforms = explode('(', $row['device']);
        $sys_type = explode(';', $row['device']);
        $ios = strpos($sys_type[1], 'iPhone');
        if ($ios) {
            $device_brand = 'IPhone';
            $device_model = explode(' ', $sys_type[1])[3];
        } else {
            $device_brand = $sys_type[6];
            $device_model = $sys_type[7];
        }

        $mac = strpos($sys_type[1], 'iPhone');
        if ($ios) {
            $device_brand = 'IPhone';
            $device_model = explode(' ', $sys_type[1])[3];
        } else {
            $device_brand = $sys_type[6];
            $device_model = $sys_type[7];
        }

        $p1 = $platforms[1];
        $p2 = explode(')', $p1);
        $p3 = explode(';', $p2[0]);
        $plat = $p3[0];

        if ($platform[$plat] > 0) {
            $platform[$plat] += 1;
        } else {
            $platform[$plat] = 1;
        }

        if ($brand[$device_brand] > 0) {
            $brand[$device_brand] += 1;
        } else {
            $brand[$device_brand] = 1;
        }

        if ($model[$device_model] > 0) {
            $model[$device_model] += 1;
        } else {
            $model[$device_model] = 1;
        }

        //ip--------------------------------------
        if ($ip[$row['ip']] > 0) {
            $ip[$row['ip']] += 1;
        } else {
            $ip[$row['ip']] = 1;
        }
    }
    //rsort($saat);
    arsort($utm_source);
    arsort($utm_medium);
    arsort($utm_campaign);
    arsort($utm_content);
    arsort($utm_term);
    arsort($page);
    arsort($saat);
    arsort($ip);
    arsort($platform);
    arsort($brand);
    arsort($model);

}

count_num($utm_source);
echo "<h2>utm_source(Instagram): " . count($utm_source) . "</h2>------------------------------------------<br/>";
print_arr($utm_source);
echo "<br/>======<br/>";
print($sum);
echo "<br/>";

count_num($utm_medium);
echo "<h2>utm_medium(Story / Highlight)</h2>------------------------------------------<br/>";
print_arr($utm_medium);
echo "<br/>======<br/>";
print($sum);
echo "<br/>";

count_num($utm_campaign);
echo "<h2>utm_campaign(Campaign name)</h2>------------------------------------------<br/>";
print_arr($utm_campaign);
echo "<br/>======<br/>";
print($sum);
echo "<br/>";

count_num($utm_content);
echo "<h2>utm_content(Product name / Shop filter)</h2>------------------------------------------<br/>";
print_arr($utm_content);
echo "<br/>======<br/>";
print($sum);
echo "<br/>";

count_num($utm_term);
echo "<h2>utm_term(Brand)</h2>------------------------------------------<br/>";
print_arr($utm_term);
echo "<br/>======<br/>";
print($sum);
echo "<br/>";

count_num($page);
echo "<h2>page</h2>------------------------------------------<br/>";
print_arr($page);
echo "<br/>======<br/>";
print($sum);
echo "<br/>";

count_num($saat);
echo "<h2>saat</h2>------------------------------------------<br/>";
print_arr($saat);
echo "<br/>======<br/>";
print($sum);
echo "<br/>";

count_num($platform);
echo "<h2>platform</h2>------------------------------------------<br/>";
print_arr($platform);
echo "<br/>======<br/>";
print($sum);
echo "<br/>";

count_num($brand);
echo "<h2>Brand</h2>------------------------------------------<br/>";
print_arr($brand);
echo "<br/>======<br/>";
print($sum);
echo "<br/>";

count_num($model);
echo "<h2>Model</h2>------------------------------------------<br/>";
print_arr($model);
echo "<br/>======<br/>";
print($sum);
echo "<br/>";

count_num($ip);
echo "<h2>ip</h2>------------------------------------------<br/>";
get_location($ip);
arsort($GLOBALS['country']);
print_arr($GLOBALS['country']);
echo "<br/>======<br/>";
print($sum);

?>
<script src="./lib/js/jquery-3.4.1.min.js"></script>
<script>
    $('span').on('click',function(){
    matn = $(this).html();
    $.ajax({
        url:'data.php',
        data:'ip=' + $(this).html(),
        type:'GET',
        success:function(result){
            matn = matn + " " + result;
        }
    });
});
</script>
