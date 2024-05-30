<table style="margin: 0 auto;width: 90%;" class="rest">
    <tr style="background: #4DB6AC; color: #353535;font-weight:bold">
        <td style="cursor:pointer" colspan="9" onclick="toggle('rest')">فرم مساعده</td>
    </tr>
    <tr id="first_row">
        <td>ردیف</td>
        <td>بازاریاب</td>
        <td>تاریخ</td>
        <td>شماره سند</td>
        <td>مساعده</td>
        <td>تایید سرپرست</td>
        <td>تایید مدیر</td>
        <td>تایید مدیریت</td>
        <td>تایید حسابداری</td>
    </tr>
    <?php
    $donate = [];
    $c_m__ = 0;
    function donate($date, $type)
    {
        db();
/*         if ($date == '') {
            $dates = '`start_unix`>=1710892800000';
        } else {
        } */
        $dates = 'date LIKE "%' . $date . '%"';

        $sql = "SELECT * FROM mission WHERE $dates AND `type` = '$type' ORDER BY id DESC";
        $result = mysqli_query($GLOBALS['conn'], $sql);
        if ($result) {
            $num = mysqli_num_rows($result);
            $GLOBALS['c_m__'] = $num;
            if ($num > 0) {
                for ($i = 0; $i < $num; $i++) {
                    $r = mysqli_fetch_assoc($result);
                    $GLOBALS['donate'][$i] = [
                        'id' => $r['id'],
                        'uid' => $r['uid'],
                        'mission_name' => $r['mission_name'],
                        'date' => $r['date'],
                        's_fa' => $r['start_fa'],
                        'e_fa' => $r['end_fa'],
                        'route' => $r['route'],
                        'vehicle_name' => $r['vehicle_name'],
                        'vehicle_num' => $r['vehicle_num'],
                        'home' => $r['home'],
                        'food' => $r['food'],
                        'travel' => $r['travel'],
                        'sign' => $r['sign'],
                        'accept_time' => $r['accept_time'],
                    ];
                }
            }
        }
    }

    donate($_GET['date'], 3);

    $GLOBALS['c_m_'] = count($donate);
    for ($j = 0; $j < $GLOBALS['c_m_']; $j++) {
        $sign = explode(',', $donate[$j]['sign']);
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
        $xxx = explode(' ', $donate[$j]['date']);
        $timestamp = strtotime($xxx[0]);
        $jalali_date = jdate("Y/m/d", $timestamp);
        $m_id = $donate[$j]['id'];
        $reason = $donate[$j]['home'];
        $start = $donate[$j]['home'];
        $donate_name  = $donate[$j]['mission_name'];
        $from  = $donate[$j]['s_fa'];
        $to  = $donate[$j]['e_fa'];
        $fee  = $donate[$j]['home'];

        users($donate[$j]['uid']);
        $user_line = $users[6];

        echo "
                                            <tr class='donate l" . $user_line . " " . $super . " " . $manager . " " . $both . " " . $acc . "'>
                                                <td>" . $l . "</td>
                                                <td>" . $users[0] . "</td>
                                                <td>" . $jalali_date . "</td>
                                                <td><a target='_blank' href='formDonate1.php?id=" . $m_id . "&type=donate'>" . $donate[$j]['id'] . "</a></td>
                                                <td>" . sep3($fee) . " ریال</td>
                                                <td>" . $super_ . "</td>
                                                <td>" . $manager_ . "</td>
                                                <td>" . $both_ . "</td>
                                                <td>" . $acc_ . "</td>
                                            </tr>
                                            ";
        $city_list = '';
        $sum_this_mission = 0;
    }
    ?>
</table>