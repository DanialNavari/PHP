<div class="row empty border_none" style="min-height: 0;"></div>
<div class="cat">
    <div class="group_name">
        <h6 class="font-weight-bold">وضعیت</h6>
    </div>
    <div class="box_cat_parent">
        <!-- <div class="box_cat" onclick="page('r','_myDebt')"> -->
        <div class="box_cat">
            <div class="box d-flex mt-2 none_click_box">
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
            <div class="box d-flex mt-2 none_click_box">
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
            <div class="box d-flex mt-2 none_click_box">
                <div class="box_icon"><?php echo $my_account; ?></div>
                <div class="box_num text-dark"><?php echo sep3(abs($acc)); ?></div>
            </div>
            <div class="box_title">حساب من</div>
        </div>
    </div>
</div>
<div class="cat">
    <div class="group_name">
        <h6 class="font-weight-bold">دوره (سفر ، دورهمی ، خوابگاه)</h6>
    </div>
    <div class="box_cat_parent">
        <div class="box_cat" onclick="page('r','_activeCourse')">
            <div class="box d-flex mt-2">
                <div class="box_icon">
                    <?php
                    echo $active_course1;
                    $uids = $_COOKIE['uid'];
                    ?>
                </div>
                <div class="box_num text-danger">
                    <?php echo active_courses("$uids", 'active'); ?>
                </div>
            </div>
            <div class="box_title">فعال</div>
        </div>
        <!-- <div class="box_cat" onclick="page('r','_inactiveCourse')"> -->
        <div class="box_cat">
            <div class="box d-flex mt-2 none_click_box">
                <div class="box_icon"><?php echo $all_course; ?></div>
                <div class="box_num text-dark"><?php echo active_courses("$uids", 'disabled'); ?></div>
            </div>
            <div class="box_title">غیرفعال</div>
        </div>
        <div class="box_cat">
            <div class="box d-flex mt-2 none_click_box">
                <div class="box_icon"><?php echo $inactive_course; ?></div>
                <div class="box_num text-success"><?php echo active_courses("$uids", 'finished'); ?></div>
            </div>
            <div class="box_title">خاتمه یافته</div>
        </div>

    </div>
</div>

<div class="cat">
    <div class="group_name">
        <h6 class="font-weight-bold">دسترسی سریع دوره پیش فرض</h6>
    </div>
    <div class="box_cat_parent">
        <div class="box_cat" onclick="navigate('./?route=__payments&h=0&id=<?php echo $c_default; ?>')">
            <div class="box d-flex mt-2">
                <div class="box_icon"><?php echo $payment_;?></div>
                <div class="box_num text-danger"></div>
            </div>
            <div class="box_title">پرداخت ها</div>
        </div>
        <div class="box_cat" onclick="navigate('./?route=__transactions&h=0&id=<?php echo $c_default; ?>')">
            <div class="box d-flex mt-2">
                <div class="box_icon"><?php echo $buy; ?></div>
                <div class="box_num text-dark"></div>
            </div>
            <div class="box_title">خرید ها</div>
        </div>
        <div class="box_cat" onclick="show_report()">
            <div class="box d-flex mt-2">
                <div class="box_icon"><?php echo $final_report; ?></div>
                <div class="box_num text-success"></div>
            </div>
            <div class="box_title">گزارش</div>
        </div>

    </div>
</div>


<!-- <div class="cat">
    <div class="group_name">
    </div>
    <div class="box_cat_parent">
        <div class="box_cat">
            <div class="box_cat">
                <div class="box d-flex mt-2 w-100">
                    <div class="box_icon">
                        <a href="https://www.instagram.com/skincarefaezeh_n?igsh=MTg1MDN0cWh4a2hoMQ==" rel="nofollow"><img src="./image/ads.jpg" alt="ads" srcset="./image/ads.jpg" id="ads" class="img-responsive"></a>
                    </div>
                    <div class="box_num text-danger"></div>
                </div>
                <div class="box_title"></div>
            </div>
        </div>
    </div>
</div> -->

<div class="cat mb-1 h-1"></div>