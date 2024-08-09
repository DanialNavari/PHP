<style>
    table {
        width: 100%;
        margin-bottom: 1rem;
    }

    td {
        border: 1px solid silver;
        padding: 0.3rem;
        text-align: center;
        font-weight: bold;
        font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
    }
</style>

<?php
include('db.php');
require_once('func.php');
db();
$data = array();
$subcollect_list = [3 => "سایر", 2 => "سالن", 1 => "فائزه"];
$tedad = count($subcollect_list);

for ($j = 0; $j < $tedad; $j++) {
    $new_radif = '';
    $sc = $j + 1;
    $x = Query("SELECT * FROM `customers` WHERE `subcollect` = '$sc' ORDER BY `id` DESC");
    $num = mysqli_num_rows($x);
    for ($i = 0; $i < $num; $i++) {
        $row = mysqli_fetch_assoc($x);
        $mobile = $row['mobile'];
        $recorder = $row['recorder'];
        $subcollect = $subcollect_list[$row['subcollect']];
        $r = Query("SELECT SUM(off) AS sum FROM `refer` WHERE `mobile` = '$mobile'");
        $rows = mysqli_fetch_assoc($r);
        $sum = $rows['sum'];
        $rs = Query("SELECT COUNT(id) AS count FROM `refer` WHERE `mobile` = '$mobile'");
        $rowss = mysqli_fetch_assoc($rs);
        $refer = $rowss['count'];
        $z = Query("SELECT * FROM `users` WHERE `uid` = '$recorder'");
        $rowz = mysqli_fetch_assoc($z);
        $birthday = substr($row['birthday'], 0, 4) . '/' . substr($row['birthday'], 4, 2) . '/' . substr($row['birthday'], 6, 2);

        $sc_name = $subcollect_list[$sc];
        if ($new_radif == '') {
            echo "
                <table>
                    <tr style='background: silver;'>
                        <td colspan='9'>$sc_name</td>
                    </tr>
                    <tr>
                        <td>ردیف</td>
                        <td>نام</td>
                        <td>موبایل</td>
                        <td>تاریخ تولد</td>
                        <td>تاریخ عضویت</td>
                        <td>تعداد مراجعه</td>
                        <td>ذخیره تخفیف</td>
                        <td>معرف</td>
                    </tr>
                    <tr>
                        <td>" . ($i + 1) . "</td>
                        <td>" . $row['esm'] . "</td>
                        <td>" . $mobile . "</td>
                        <td>" . $birthday . "</td>
                        <td>" . $row['date'] . "</td>
                        <td>" . $sum . "</td>
                        <td>" . $refer . "</td>
                        <td>" . $rowz['fa_name'] . "</td>
                    </tr>
                ";
            $new_radif = "$sc_name";
        } else {
            echo "
                    <tr>
                        <td>" . ($i + 1) . "</td>
                        <td>" . $row['esm'] . "</td>
                        <td>" . $mobile . "</td>
                        <td>" . $birthday . "</td>
                        <td>" . $row['date'] . "</td>
                        <td>" . $sum . "</td>
                        <td>" . $refer . "</td>
                        <td>" . $rowz['fa_name'] . "</td>
                    </tr>
                ";
        }
    }
    echo "</table>";
}


// function filterData(&$str)
// {
//     $str = preg_replace("/\t/", "\\t", $str);
//     $str = preg_replace("/\r?\n/", "\\n", $str);
//     if (strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
// }

// file name for download
// $fileName = "excel.xls";

// headers for download
// header("Content-Disposition: attachment; filename=\"$fileName\"");
// header("Content-Type: application/vnd.ms-excel");

// $flag = false;
// foreach ($data as $row) {
//     if (!$flag) {
//         // display column names as first row
//         echo implode("\t", array_keys($row)) . "\n";
//         $flag = true;
//     }
//     // filter data
//     array_walk($row, 'filterData');
//     echo implode("\t", array_values($row)) . "\n";
// }

?>