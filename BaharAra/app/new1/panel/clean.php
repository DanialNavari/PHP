<?php
require_once '../func.php';
db();

$n = 0;

$sql = "SELECT * FROM `cbd` WHERE `buy_pos` = '+' ORDER BY `id` DESC";
$result = mysqli_query($GLOBALS['conn'], $sql);
$num = mysqli_num_rows($result);
$n = 0;
for ($i = 0; $i < $num; $i++) {
    $row = mysqli_fetch_array($result);

    $sqli = "SELECT * FROM `factor` WHERE `factor_id` = " . $row['factor_id'] . " ORDER BY `id` DESC";
    $resulti = mysqli_query($GLOBALS['conn'], $sqli);
    $numi = mysqli_num_rows($resulti);
    if ($numi == 0) {
        $n++;
        $sqlw = "UPDATE `cbd` SET `buy_pos` = '-' WHERE `cbd`.`id` =" . $row['id'];
        $resultw = mysqli_query($GLOBALS['conn'], $sqlw);
        if ($resultw) {
            echo 'cbd: ' . $row['id'] . '    factor:' . $row['factor_id'] . '<br/>';
        }
    }
}

/* delete factors without tedad,offer,tester */
$sqll = "SELECT * FROM `factor` WHERE tedad = 0 AND offer = 0 AND tester = 0;";
$ww = mysqli_query($GLOBALS['conn'], $sqll);
$nn = mysqli_num_rows($ww);

$sqll = "DELETE FROM `factor` WHERE tedad = 0 AND offer = 0 AND tester = 0;";
$ww = mysqli_query($GLOBALS['conn'], $sqll);


/* delete admin cbd, factor, log */
$sqlb = "SELECT * FROM `cbd` WHERE `uid` = 100";
$resultb = mysqli_query($GLOBALS['conn'], $sqlb);
$nnw = mysqli_num_rows($resultb);

$sqlb = "DELETE FROM `cbd` WHERE `uid` = 100";
$resultb = mysqli_query($GLOBALS['conn'], $sqlb);

$sqlb = "SELECT * FROM `factor` WHERE `uid` = 100";
$resultb = mysqli_query($GLOBALS['conn'], $sqlb);
$nnwa = mysqli_num_rows($resultb);

$sqlb = "DELETE FROM `factor` WHERE `uid` = 100";
$resultb = mysqli_query($GLOBALS['conn'], $sqlb);

$sqlb = "SELECT * FROM `seller_loc` WHERE `uid` = 100";
$resultb = mysqli_query($GLOBALS['conn'], $sqlb);
$nnwaa = mysqli_num_rows($resultb);

$sqlb = "DELETE FROM `seller_loc` WHERE `uid` = 100";
$resultb = mysqli_query($GLOBALS['conn'], $sqlb);

/* report */
echo '<br/>CBD without factor: ' . $n . '<br/>';
echo '<br/>Factors without tedad,offer,tester: ' . $nn . '<br/>';
echo '<br/>Admin cbd: ' . $nnw . '<br/>';
echo '<br/>Admin factors: ' . $nnwa . '<br/>';
echo '<br/>Admin loc: ' . $nnwaa . '<br/>';
