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

    .please_wait {
        width: 93% !important;
    }
</style>
<?php
if (isset($_COOKIE['page'])) {
    $_COOKIE['page'] = "dongeto";
} else {
    setcookie("page", "dongeto", time() + 604800, "/");
}

require_once('func.php');
$settings = get_settings($_COOKIE['uid']);
$c_default = $settings['course_default'];
if (intval($c_default) > 0) {
    $c_d = 'display:flex';
    $c_dd = 'display:block';
    $c_d_id = $c_default;
} else {
    $c_d = 'display:none';
    $c_dd = 'display:none';
    $c_d_id = 0;
}

$my_tel = $_COOKIE['uid'];
$debt = 0;
$req = 0;

$x = Query("SELECT * FROM `course` WHERE `course_member` LIKE '%$my_tel%' AND `course_disabled` IS NULL AND `course_finish` IS NULL `course_del_course` IS NULL");
$n = mysqli_num_rows($x);
for ($ii = 0; $ii < $n; $ii++) {
    $f = mysqli_fetch_assoc($x);
    $course_id = $f['course_id'];
    $debt += 0;
    MY_DEBT($_COOKIE['uid'], 'debt', $course_id);
    $req += 0;
    MY_DEBT($_COOKIE['uid'], 'req', $course_id);
}
?>

<div class="row empty border_none" style="min-height: 0;"></div>

<div class="cat">
    <div class="group_name">
        <h6 class="font-weight-bold">وضعیت من</h6>
    </div>
    <div class="box_cat_parent">

        <div class="box_cat b1">
            <div class="box_cat inactive_option">
                <div class="box d-flex mt-2 none_click_box" style="width: 4rem; height: 4rem;">
                    <div class="box_num text-danger rotate_invert1 svg_title">
                        <?php
                        echo sep3(abs($req));
                        ?>
                        <div class="box_title">طلب</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="box_cat b1">
            <div class="box_cat inactive_option">
                <div class="box d-flex mt-2 none_click_box" style="width: 4rem; height: 4rem;">
                    <div class="box_num text-danger rotate_invert1 svg_title">
                        <?php
                        echo sep3(abs($debt));
                        ?>
                        <div class="box_title">بدهی</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- <div class="box_cat b1">
            <div class="box_cat inactive_option">
                <div class="box d-flex mt-2 none_click_box">
                    <div class="box_num text-danger rotate_invert1 svg_title">
                        0
                        <div class="box_title">حساب دوره</div>
                    </div>
                </div>
            </div>
        </div> -->

    </div>

    <!-- <div class="box_cat_parent">

        <div class="box_cat b1">
            <div class="box_cat inactive_option">
                <div class="box d-flex mt-2 none_click_box">
                    <div class="box_num text-danger rotate_invert1 svg_title">
                        0
                        <div class="box_title">قرض دادم</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="box_cat b1">
            <div class="box_cat inactive_option">
                <div class="box d-flex mt-2 none_click_box">
                    <div class="box_num text-danger rotate_invert1 svg_title">
                        0
                        <div class="box_title">قرض گرفتم</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="box_cat b1">
            <div class="box_cat inactive_option">
                <div class="box d-flex mt-2 none_click_box">
                    <div class="box_num text-danger rotate_invert1 svg_title">
                        0
                        <div class="box_title" style="font-size: 0.65rem;">حساب قرض</div>
                    </div>
                </div>
            </div>
        </div>

    </div> -->

</div>

<div class="cat">
    <div class="group_name">
        <h6 class="font-weight-bold">آمار دورهمی ها</h6>
    </div>
    <div class="box_cat_parent">
        <div class="box_cat_parent">
            <div class="box_cat b1" onclick="navigate('./?route=_activeCourse&bm=dongeto')">
                <div class="box_cat">
                    <div class="box d-flex mt-2 ">
                        <div class="box_num text-danger rotate_invert1 svg_title">
                            <?php
                            $uids = $_COOKIE['uid'];
                            echo active_courses("$uids", 'active');
                            ?>
                            <div class="box_title">فعال</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="box_cat b1" onclick="navigate('./?route=_oldCourse&bm=dongeto&h=inactive')">
                <div class="box_cat">
                    <div class="box d-flex mt-2">
                        <div class="box_num text-danger rotate_invert1 svg_title">
                            <?php
                            $uids = $_COOKIE['uid'];
                            echo active_courses("$uids", 'disabled');
                            ?>
                            <div class="box_title">غیر فعال</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="box_cat b1" onclick="navigate('./?route=_oldCourse&bm=dongeto&h=finished')">
                <div class="box_cat">
                    <div class="box d-flex mt-2">
                        <div class="box_num text-danger rotate_invert1 svg_title">
                            <?php
                            $uids = $_COOKIE['uid'];
                            echo active_courses("$uids", 'finished');
                            ?>
                            <div class="box_title">خاتمه یافته</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="cat" style="<?php echo $c_dd; ?>">
    <div class="group_name">
        <h6 class="font-weight-bold">دورهمی های من (برنامه - سفر - حساب کتاب گروهی)</h6>
    </div>

    <div class="box_cat_parent">
        <div class="box_cat b1" style="<?php echo $c_d; ?>" onclick="navigate('./?route=__payments&h=0&id=<?php echo $c_d_id; ?>')">
            <div class="box_cat">
                <div class="box d-flex mt-2">
                    <div class="box_num text-danger rotate_invert1 svg_title">
                        <?php echo $GLOBALS['payment']; ?>
                        <div class="box_title">پرداخت</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="box_cat b1" style="<?php echo $c_d; ?>" onclick="navigate('./?route=__transactions&h=0&id=<?php echo $c_d_id; ?>')">
            <div class="box_cat">
                <div class="box d-flex mt-2">
                    <div class="box_num text-danger rotate_invert1 svg_title">
                        <?php echo $GLOBALS['bag_plus']; ?>
                        <div class="box_title">خرید</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="box_cat b1" style="<?php echo $c_d; ?>" onclick="navigate('./?route=___report&h=0&id=<?php echo $c_d_id; ?>')">
            <div class="box_cat">
                <div class="box d-flex mt-2">
                    <div class="box_num text-danger rotate_invert1 svg_title">
                        <?php echo $GLOBALS['list']; ?>
                        <div class="box_title">گزارش</div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="cat">
    <div class="group_name">
        <h6 class="font-weight-bold">سایر امکانات</h6>
    </div>
    <div class="box_cat_parent">

        <div class="box_cat b1" onclick="navigate('./?route=_newCourse&h=course&id=null')">
            <div class="box_cat">
                <div class="box d-flex mt-2">
                    <div class="box_num text-danger rotate_invert1 svg_title">
                        <?php echo $GLOBALS['dorehami']; ?>
                        <div class="box_title">ایجاد</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="box_cat b1" onclick="navigate('./?route=_contacts&h=contacts&id=null')">
            <div class="box_cat">
                <div class="box d-flex mt-2">
                    <div class="box_num text-danger rotate_invert1 svg_title">
                        <?php echo $GLOBALS['contacts']; ?>
                        <div class="box_title">مخاطبین</div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- <div class="cat">
    <div class="group_name">
        <h6 class="font-weight-bold">آمار دورهمی ها</h6>
    </div>

    <div class="box_cat_parent">

        <div class="box_cat b1">
            <div class="box_cat inactive_option">
                <div class="box d-flex mt-2 none_click_box">
                    <div class="box_num text-danger rotate_invert1 svg_title">
                        0
                        <div class="box_title">برنامه ها</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="box_cat b1">
            <div class="box_cat inactive_option">
                <div class="box d-flex mt-2 none_click_box">
                    <div class="box_num text-danger rotate_invert1 svg_title">
                        0
                        <div class="box_title">دورهمی ها</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="box_cat b1">
            <div class="box_cat inactive_option">
                <div class="box d-flex mt-2 none_click_box">
                    <div class="box_num text-danger rotate_invert1 svg_title">
                        0
                        <div class="box_title">مسافرت ها</div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="box_cat_parent">
        <div class="box_cat b1">
            <div class="box_cat inactive_option">
                <div class="box d-flex mt-2 none_click_box">
                    <div class="box_num text-danger rotate_invert1 svg_title">
                        0
                        <div class="box_title">رتبه من</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="box_cat b1">
            <div class="box_cat inactive_option">
                <div class="box d-flex mt-2 none_click_box">
                    <div class="box_num text-danger rotate_invert1 svg_title">
                        0%
                        <div class="box_title">تجربه من</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="box_cat b1">
            <div class="box_cat inactive_option">
                <div class="box d-flex mt-2 none_click_box">
                    <div class="box_num text-danger rotate_invert1 svg_title">
                        0%
                        <div class="box_title">خوش سفر</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div> -->

<!-- <div class="cat">
    <div class="group_name">
        <h6 class="font-weight-bold">سایر امکانات</h6>
    </div>
    <div class="box_cat_parent" onclick="navigate('./?route=_gharz&bm=gharz')">
        <img src="./image/gharz.png" alt="gharz" class="img-responsive">
    </div>
    <div class="box_cat_parent">
        <img src="./image/album.png" alt="album" class="img-responsive">
        <img src="./image/bazaar.png" alt="album" class="img-responsive">
    </div>
    <div class="box_cat_parent">
        <img src="./image/memory.png" alt="album" class="img-responsive">
        <img src="./image/checklist.png" alt="album" class="img-responsive">
    </div>
</div> -->

<div class="please_wait">
    <h6>لطفا کمی صبر کنید</h6>
    <a id="download_link" onclick="download_btn()" class="btn btn-dark w-100" href="" download="report.jpg">دانلود فایل گزارش</a>
</div>


<!-- <div class="cat mb-1 h-1"></div> -->