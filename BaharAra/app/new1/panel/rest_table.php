<table style="margin: 0 auto;width: 90%;" class="rest">
    <tr style="background: #4DB6AC; color: #353535;font-weight:bold">
        <td style="cursor:pointer" colspan="12" onclick="toggle('rest')">فرم مرخصی</td>
    </tr>
    <tr id="first_row">
        <td>ردیف</td>
        <td>بازاریاب</td>
        <td>تاریخ</td>
        <td>شماره سند</td>
        <td>از</td>
        <td>تا</td>
        <td>تایید سرپرست</td>
        <td>تایید مدیر</td>
        <td>تایید مدیریت</td>
        <td>تایید حسابداری</td>
    </tr>
    <?php
    $rest = [];
    $c_m_ = 0;
    function rest($date, $type)
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
            $GLOBALS['c_m_'] = $num;
            if ($num > 0) {
                for ($i = 0; $i < $num; $i++) {
                    $r = mysqli_fetch_assoc($result);
                    $GLOBALS['rest'][$i] = [
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

    rest($_GET['date'], 2);
    $GLOBALS['c_m_'] = count($rest);
    for ($j = 0; $j < $GLOBALS['c_m_']; $j++) {
        $sign = explode(',', $rest[$j]['sign']);
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
                                                <td>" . $super_ . "</td>
                                                <td>" . $manager_ . "</td>
                                                <td>" . $both_ . "</td>
                                                <td>" . $acc_ . "</td>
                                            </tr>
                                            <tr class='mission l" . $user_line . " " . $super . " " . $manager . " " . $acc . " " . $both . "'>
                                                <td colspan='11' class='desc' style='background: #EEEEEE;'>" . $reason . "</td>
                                            </tr>
                                            ";
        $city_list = '';
        $sum_this_mission = 0;
    }
    ?>
</table>