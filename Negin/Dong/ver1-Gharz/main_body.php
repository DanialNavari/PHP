<style>
    .box_num img {
        width: 2rem;
    }
</style>
<?php
if (isset($_COOKIE['page'])) {
    $_COOKIE['page'] = "dongeto";
} else {
    setcookie("page", "dongeto", time() + 604800, "/");
}
?>

<div class="row empty border_none" style="min-height: 0;"></div>
<div class="cat">
    <div class="group_name">
        <h6 class="font-weight-bold">اطلاعات دورهمی ها</h6>
    </div>
    <div class="box_cat_parent">

        <div class="box_cat b1">
            <div class="box_cat inactive_option">
                <div class="box d-flex mt-2 none_click_box">
                    <div class="box_num text-danger rotate_invert1">
                        <?php $debt =  MY_DEBT($_COOKIE['uid'], 'req');
                        echo sep3(abs($debt));
                        ?>
                    </div>
                </div>
            </div>
            <div class="box_title">طلب من</div>
        </div>

        <div class="box_cat b1">
            <div class="box_cat inactive_option">
                <div class="box d-flex mt-2 none_click_box">
                    <div class="box_num text-danger rotate_invert1">
                        <?php $debt =  MY_DEBT($_COOKIE['uid'], 'debt');
                        echo sep3(abs($debt));
                        ?>
                    </div>
                </div>
            </div>
            <div class="box_title">بدهی من</div>
        </div>

        <?php
        $acc = 0; //$req + $debt;
        if ($acc < 0) {
            $accs = 'acc_debt';
        } else {
            $accs = 'acc_req';
        }
        ?>

        <div class="box_cat b1">
            <div class="box_cat inactive_option">
                <div class="box d-flex mt-2 none_click_box">
                    <div class="box_num text-danger rotate_invert1">
                        <?php $debt =  MY_DEBT($_COOKIE['uid'], 'debt');
                        echo sep3(abs($debt));
                        ?>
                    </div>
                </div>
            </div>
            <div class="box_title">حساب من</div>
        </div>

    </div>

</div>

<div class="cat">
    <div class="box_cat_parent">

        <div class="box_cat b1">
            <div class="box_cat inactive_option">
                <div class="box d-flex mt-2 none_click_box">
                    <div class="box_num text-danger rotate_invert1">
                        <?php
                        $uids = $_COOKIE['uid'];
                        echo active_courses("$uids", 'active');
                        ?>
                    </div>
                </div>
            </div>
            <div class="box_title">فعال</div>
        </div>

        <div class="box_cat b1">
            <div class="box_cat inactive_option">
                <div class="box d-flex mt-2 none_click_box">
                    <div class="box_num text-danger rotate_invert1">
                        <?php
                        $uids = $_COOKIE['uid'];
                        echo active_courses("$uids", 'disabled');
                        ?>
                    </div>
                </div>
            </div>
            <div class="box_title">غیر فعال</div>
        </div>

        <div class="box_cat b1">
            <div class="box_cat inactive_option">
                <div class="box d-flex mt-2 none_click_box">
                    <div class="box_num text-danger rotate_invert1">
                        <?php
                        $uids = $_COOKIE['uid'];
                        echo active_courses("$uids", 'finished');
                        ?>
                    </div>
                </div>
            </div>
            <div class="box_title">خاتمه یافته</div>
        </div>

    </div>
</div>

<div class="cat mt-3">
    <div class="group_name">
        <h6 class="font-weight-bold">دورهمی های من</h6>
    </div>
    <div class="box_cat_parent">

        <div class="box_cat b1" onclick="navigate('./?route=_newCourse&h=course&id=null')">
            <div class="box_cat">
                <div class="box d-flex mt-2">
                    <div class="box_num text-danger rotate_invert1">
                        <img src="./image/dorehami.png" alt="list course">
                    </div>
                </div>
            </div>
            <div class="box_title">ایجاد دورهمی</div>
        </div>

        <div class="box_cat b1" onclick="navigate('./?route=_activeCourse&bm=dongeto')">
            <div class="box_cat">
                <div class="box d-flex mt-2">
                    <div class="box_num text-danger rotate_invert1">
                        <img src="./image/list.png" alt="list course">
                    </div>
                </div>
            </div>
            <div class="box_title">لیست دورهمی ها</div>
        </div>
        <div class="box_cat b1">
            <div class="box_cat inactive_option">
                <div class="box d-flex mt-2 none_click_box">
                    <div class="box_num text-danger rotate_invert1">
                        <img src="./image/list.png" alt="list course">
                    </div>
                </div>
            </div>
            <div class="box_title">خاطرات دورهمی ها</div>
        </div>

    </div>
</div>

<div class="cat mb-1 h-1"></div>