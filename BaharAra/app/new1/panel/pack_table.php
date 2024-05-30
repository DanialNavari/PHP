<table style="margin: 0 auto;width: 90%;" class="rest">
    <tr style="background: #4DB6AC; color: #353535;font-weight:bold">
        <td style="cursor:pointer" colspan="12" onclick="toggle('rest')"></td>
    </tr>
    <tr id="first_row">
        <td>ردیف</td>
        <td>گیرنده</td>
        <td>شهر</td>
        <td>تاریخ قرارداد</td>
        <td>تاریخ فاکتور</td>
        <td>تاریخ صدور</td>
        <td>تعداد کارتن ها</td>
        <td>تعداد محصولات</td>
        <td>نام باربری</td>
    </tr>
    <?php
    $pack = [];
    function pack($date, $type)
    {
        db();
        $sql = "SELECT * FROM packing_list WHERE `date` LIKE '%" . $date . "%' ORDER BY id DESC";
        $result = mysqli_query($GLOBALS['conn'], $sql);
        if ($result) {
            $num = mysqli_num_rows($result);
            if ($num > 0) {
                for ($i = 0; $i < $num; $i++) {
                    $r = mysqli_fetch_assoc($result);
                    $GLOBALS['pack'][$i] = [
                        'id' => $r['id'],
                        'factor_id' => $r['factor_id'],
                        'prod_id' => $r['prod_id'],
                        'customer' => $r['customer'],
                        'way' => $r['way'],
                        'freight_name' => $r['freight_name'],
                        'karton_num' => $r['karton_num'],
                        'karton_tedad' => $r['karton_tedad'],
                        'inbox_tedad' => $r['inbox_tedad'],
                        'total_prod' => $r['total_prod'],
                        'parent' => $r['parent'],
                        'driver' => $r['driver'],
                        'sign' => $r['sign'],
                        'accept_time' => $r['accept_time'],
                        'tarikh' => $r['tarikh'],
                    ];
                }
            }
        }
    }

    for ($j = 0; $j < $GLOBALS['c_m_']; $j++) {
        $sign = explode(',', $pack[$j]['sign']);
        if (count($sign) - 1 > 0) {
            if ($sign[0] > 0) {
                $super_ = $ok;
                $super = 'super_ok';
            } else {
                $super_ = $no;
                $super = 'super_no';
            }

            if (isset($sign[1]) && $sign[1] > 0) {
                $manager_ = $ok;
                $manager = 'manager_ok';
            } else {
                $manager_ = $no;
                $manager = 'manager_no';
            }

            if (isset($sign[2]) && $sign[2] > 0) {
                $both_ = $ok;
                $both = 'both_ok';
            } else {
                $both_ = $no;
                $both = 'both_no';
            }

            if (isset($sign[3]) && $sign[3] > 0) {
                $acc_ = $ok;
                $acc = 'acc_ok';
            } else {
                $acc_ = $no;
                $acc = 'acc_no';
            }
        } else {
            $super = 'super_no';
            $manager = 'manager_no';
            $both = 'both_no';
            $acc = 'both_no';
            $super_ = $no;
            $manager_ = $no;
            $both_ = $no;
            $acc_ = $no;
        }


        $l = $j + 1;
        $xxx = explode(' ', $rest[$j]['date']);
        $timestamp = strtotime($xxx[0]);
        $jalali_date = jdate("Y/m/d", $timestamp);
        $m_id = $rest[$j]['id'];
        $reason = $rest[$j]['home'];
        $start = $rest[$j]['home'];
        $rest_name  = $rest[$j]['mission_name'];
        $from  = $rest[$j]['s_fa'];
        $to  = $rest[$j]['e_fa'];

        users($rest[$j]['uid']);
        $user_line = $users[6];

        echo "
                                            <tr class='mission l" . $user_line . " " . $super . " " . $manager . " " . $both . " " . $acc . "'>
                                                <td>" . $l . "</td>
                                                <td>" . $users[0] . "</td>
                                                <td>" . $jalali_date . "</td>
                                                <td><a target='_blank' href='formRest1.php?id=" . $m_id . "&type=rest'>" . $rest[$j]['id'] . "</a></td>
                                                <td>$from</td>
                                                <td>$to</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        
                                            ";
        $city_list = '';
        $sum_this_mission = 0;
    }
    ?>
</table>