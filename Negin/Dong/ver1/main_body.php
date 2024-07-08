<div class="row empty border_none"></div>
<div class="cat">
    <div class="group_name">
        <h6 class="font-weight-bold">وضعیت</h6>
    </div>
    <div class="box_cat_parent">
        <!-- <div class="box_cat" onclick="page('r','_myDebt')"> -->
        <div class="box_cat">
            <div class="box d-flex mt-2">
                <div class="box_icon"><?php echo $my_debt; ?></div>
                <div class="box_num text-danger">
                    <?php $debt =  MY_DEBT($_COOKIE['uid'], 'debt');
                    echo sep3(abs($debt));
                    ?>
                </div>
            </div>
            <div class="box_title">بدهی من</div>
        </div>
        <!-- <div class="box_cat" onclick="page('r','_myReq')"> -->
        <div class="box_cat">
            <div class="box d-flex mt-2">
                <div class="box_icon"><?php echo $my_request; ?></div>
                <div class="box_num text-success"><?php $req =  MY_DEBT($_COOKIE['uid'], 'req');
                                                    echo sep3($req); ?></div>
            </div>
            <div class="box_title">طلب من</div>
        </div>
        <div class="box_cat">
            <?php
            $acc = $req + $debt;
            if ($acc < 0) {
                $accs = 'acc_debt';
            } else {
                $accs = 'acc_req';
            }
            ?>
            <div class="box d-flex mt-2 <?php echo $accs; ?>">
                <div class="box_icon"><?php echo $my_account; ?></div>
                <div class="box_num text-dark"><?php echo sep3(abs($acc)); ?></div>
            </div>
            <div class="box_title">حساب من</div>
        </div>
    </div>
</div>
<div class="cat">
    <div class="group_name">
        <h6 class="font-weight-bold">دوره ها</h6>
    </div>
    <div class="box_cat_parent">
        <div class="box_cat" onclick="page('r','_activeCourse')">
            <div class="box d-flex mt-2">
                <div class="box_icon">
                    <?php 
                    echo $active_course;
                    $uids = $_COOKIE['uid']; 
                    ?>
                </div>
                <div class="box_num text-danger">
                    <?php echo active_courses("$uids", 'active'); ?>
                </div>
            </div>
            <div class="box_title">دوره فعال</div>
        </div>
        <!-- <div class="box_cat" onclick="page('r','_inactiveCourse')"> -->
        <div class="box_cat">
            <div class="box d-flex mt-2">
                <div class="box_icon"><?php echo $inactive_course; ?></div>
                <div class="box_num text-success"><?php echo active_courses("$uids", 'finished'); ?></div>
            </div>
            <div class="box_title">دوره خاتمه یافته</div>
        </div>
        <div class="box_cat">
            <div class="box d-flex mt-2">
                <div class="box_icon"><?php echo $all_course; ?></div>
                <div class="box_num text-dark"><?php echo active_courses("$uids", 'disabled'); ?></div>
            </div>
            <div class="box_title">دوره های غیرفعال</div>
        </div>
    </div>
</div>
<!-- <div class="cat">
    <div class="group_name">
        <h6 class="font-weight-bold">افراد</h6>
    </div>
    <div class="box_cat_parent">
        <div class="box_cat" onclick="page('r','_userDebt')">
        <div class="box_cat">
            <div class="box d-flex mt-2">
                <div class="box_icon"><?php echo $person_debt; ?></div>
                <div class="box_num text-danger">3</div>
            </div>
            <div class="box_title">افراد بدهکار</div>
        </div>
        <div class="box_cat">
            <div class="box d-flex mt-2" onclick="page('r','_userReq')">
            <div class="box d-flex mt-2">
                <div class="box_icon"><?php echo $person_request; ?></div>
                <div class="box_num text-success">5</div>
            </div>
            <div class="box_title">افراد طلبکار</div>
        </div>
        <div class="box_cat">
            <div class="box d-flex mt-2">
                <div class="box_icon"><?php echo $all_person; ?></div>
                <div class="box_num text-dark">8</div>
            </div>
            <div class="box_title">همه افراد</div>
        </div>
    </div>
</div> -->

<div class="cat mb-1 h-1"></div>