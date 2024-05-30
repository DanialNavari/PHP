<?php
require_once '../func.php';
require_once 'jdf.php';

function get_factor_($shop_id)
{
    db();
    $sqlc = "SELECT * FROM base WHERE id=" . $shop_id;
    $resc = mysqli_query($GLOBALS['conn'], $sqlc);
    $rc = mysqli_fetch_assoc($resc);
    if (strlen($rc['city']) > 2) {
        if (isset($GLOBALS['manategh'][$rc['city']])) {
            $manateg = $GLOBALS['manategh'][$rc['city']];
            $manateg += 1;
            $GLOBALS['manategh'][$rc['city']] = $manateg;
        } else {
            $GLOBALS['manategh'][$rc['city']] = 1;
        }
    }
}
