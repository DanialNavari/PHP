<table style="margin: 0 auto;width: 90%;" class="mamoriat">
    <tr style="background: #4DB6AC; color: #353535;font-weight:bold">
        <td style="cursor:pointer" colspan="11" onclick="toggle('mamoriat')">فرم ماموریت</td>
    </tr>
    <tr id="first_row">
        <td>ردیف</td>
        <td>بازاریاب</td>
        <td>عنوان فرم</td>
        <td>تاریخ</td>
        <td>شماره سند</td>
        <td>مبلغ(ریال)</td>
        <td>بانک</td>
        <td>تایید سرپرست</td>
        <td>تایید مدیر</td>
        <td>تایید مدیریت</td>
        <td>تایید حسابداری</td>
    </tr>
    <?php
    mission($_GET['date'], 1);
    $GLOBALS['c_m'] = count($mission1);
    for ($i = 0; $i < $c_m; $i++) {
        $sign = explode(',', $mission1[$i]['sign']);
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


        $rtr = explode(',', $mission1[$i]['route']);
        $rt = count($rtr) - 1;
        for ($k = 0; $k < $rt; $k++) {
            if ($k == $rt - 1) {
                $city_list .= masir($rtr[$k]);
            } else {
                $city_list .= masir($rtr[$k]) . ' > ';
            }
        }

        $sum_this_mission = intval($mission1[$i]['home']) + intval($mission1[$i]['food']) + intval($mission1[$i]['travel']);

        $j = $i + 1;
        $xxx = explode(' ', $mission1[$i]['date']);
        $timestamp = strtotime($xxx[0]);
        $jalali_date = jdate("Y/m/d", $timestamp);
        $m_id = $mission1[$i]['id'];

        if ($mission1[$i]['mission_name'] == '') {
            $mission1_name = '-';
        } else {
            $mission1_name = $mission1[$i]['mission_name'];
        }

        users($mission1[$i]['uid']);
        //$ud = explode(',', $user_datas);
        $bank = banks(substr($users[5], 2, 3));
        $user_line = $users[6];

        echo "
                                            <tr class='mission l" . $user_line . " " . $super . " " . $manager . " " . $both . " " . $acc . "'>
                                                <td>" . $j . "</td>
                                                <td>" . $users[0] . "</td>
                                                <td>" . $mission1_name . "</td>
                                                <td>" . $jalali_date . "</td>
                                                <td><a target='_blank' href='formDetail1.php?id=" . $m_id . "&type=mission'>" . $mission1[$i]['id'] . "</a></td>
                                                <td>" . sep3($sum_this_mission) . "</td>
                                                <td><img src='../img/bank/" . $bank . ".jpg' style='width: 3rem;'/></td>
                                                <td>" . $super_ . "</td>
                                                <td>" . $manager_ . "</td>
                                                <td>" . $both_ . "</td>
                                                <td>" . $acc_ . "</td>
                                            </tr>
                                            <tr class='mission l" . $user_line . " " . $super . " " . $manager . " " . $acc . " " . $both . "'>
                                                <td colspan='11' class='desc' style='background: #EEEEEE;'>مسیر: " . $city_list . " | رفت: " . $mission1[$i]['s_fa'] . " - برگشت: " . $mission1[$i]['e_fa'] . " | خودرو: " . $mission1[$i]['vehicle_name'] . "</td>
                                            </tr>
                                            ";
        $city_list = '';
        $sum_this_mission = 0;
    }
    ?>
</table>