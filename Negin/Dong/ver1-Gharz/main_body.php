<style>
    .box_num img {
        width: 2.5rem;
    }

    .seprator {
        border: 1px solid #1473bd;
    }

    img.img-responsive {
        width: 49%;
        border-radius: 0.5rem;
        padding: 0.2rem;
        margin: 0.5rem auto;
        box-shadow: 0px 0px 1px 1px silver
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
        <h6 class="font-weight-bold">اطلاعات مالی</h6>
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

        <div class="box_cat b1">
            <div class="box_cat inactive_option">
                <div class="box d-flex mt-2 none_click_box">
                    <div class="box_num text-danger rotate_invert1" style="filter: invert(1); display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 0.5rem;">
                        <span class=""><?php echo $GLOBALS['star']; ?></span>
                        <span class="">0</span>
                    </div>
                </div>
            </div>
            <div class="box_title">امتیاز من</div>
        </div>

    </div>
</div>

<div class="cat">
    <div class="group_name">
        <h6 class="font-weight-bold">دورهمی های من (برنامه - سفر - حساب کتاب گروهی)</h6>
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
                <div class="box d-flex mt-2 ">
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

<div class="cat">
    <div class="seprator"></div>
    <div class="box_cat_parent">
        <img src="./image/album.png" alt="album" class="img-responsive">
        <img src="./image/bazaar.png" alt="album" class="img-responsive">
    </div>
    <div class="box_cat_parent">
        <img src="./image/memory.png" alt="album" class="img-responsive">
        <img src="./image/checklist.png" alt="album" class="img-responsive">
    </div>
</div>


<!-- <div class="cat mb-1 h-1"></div> -->