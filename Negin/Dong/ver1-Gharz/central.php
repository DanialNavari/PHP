<?php require_once("symbol.php");
if (isset($_COOKIE['page'])) {
    $page = $_COOKIE['page'];
} else {
    setcookie("page", "", time() + 604800, "/");
    $page = $_COOKIE['page'];
}
?>

<div style="margin-top: 3.6rem;"></div>

<div class="cat">
    <!-- <div class="group_name">
        <h6 class="font-weight-bold">به دونگتو خوش آمدید</h6>
    </div> -->
    <div class="box_cat_parent">

        <div class="box_cat b1" onclick="window.location.assign('./?route=main_body&bm=dongeto')">
            <div class="box_cat">
                <div class="box d-flex mt-2 ">
                    <div class="box_icon">
                        <img src="./image/party.png" alt="party">
                    </div>
                    <div class="box_num text-danger"></div>
                </div>
            </div>
            <div class="box_title">دونگ دورهمی</div>
        </div> 

        <div class="box_cat b1" onclick="window.location.assign('./?route=_gharz&bm=gharz')">
            <div class="box_cat">
                <div class="box d-flex mt-2">
                    <div class="box_icon">
                        <?php echo $loan; ?>
                    </div>
                    <div class="box_num text-danger"></div>
                </div>
            </div>
            <div class="box_title">قرض و طلب</div>
        </div>

        <div class="box_cat b1 inactive_option">
            <div class="box_cat">
                <div class="box d-flex mt-2 none_click_box">
                    <div class="box_icon">
                        <?php echo $home_loan; ?>
                    </div>
                    <div class="box_num text-danger"></div>
                </div>
            </div>
            <div class="box_title">وام خونگی</div>
        </div>

    </div>
</div>

<div class="cat">
    <div class="box_cat_parent">

        <div class="box_cat b1 inactive_option">
            <div class="box_cat">
                <div class="box d-flex mt-2 none_click_box">
                    <div class="box_icon">
                        <?php echo $luggage; ?>
                    </div>
                    <div class="box_num text-danger"></div>
                </div>
            </div>
            <div class="box_title">مدیر تور</div>
        </div>

        <div class="box_cat b1 inactive_option">
            <div class="box_cat">
                <div class="box d-flex mt-2 none_click_box">
                    <div class="box_icon">
                        <?php echo $building; ?>
                    </div>
                    <div class="box_num text-danger"></div>
                </div>
            </div>
            <div class="box_title">مدیر ساختمان</div>
        </div>

        <div class="box_cat b1 inactive_option">
            <div class="box_cat">
                <div class="box d-flex mt-2 none_click_box">
                    <div class="box_icon">
                        <?php echo $chart; ?>
                    </div>
                    <div class="box_num text-danger"></div>
                </div>
            </div>
            <div class="box_title">حساب یار</div>
        </div>

    </div>
</div>

<div class="cat">
    <div class="box_cat_parent">

        <div class="box_cat b1" onclick="window.location.assign('tg://resolve?domain=dongeto')">
            <div class="box_cat">
                <div class="box d-flex mt-2 ">
                    <div class="box_icon"><img src="./image/telegram.svg" alt="bale" style="width: 1.5rem;"></div>
                    <div class="box_num text-danger"></div>
                </div>
            </div>
            <div class="box_title">پشتیبانی</div>
        </div>

        <div class="box_cat b1" onclick="window.location.assign('tg://resolve?domain=dongetobot')">
            <div class="box_cat">
                <div class="box d-flex mt-2 ">
                    <div class="box_icon"><?php echo $GLOBALS['robot']; ?></div>
                    <div class="box_num text-danger"></div>
                </div>
            </div>
            <div class="box_title">ربات تلگرام</div>
        </div>

        <div class="box_cat b1 inactive_option">
            <div class="box_cat">
                <div class="box d-flex mt-2 none_click_box">
                    <div class="box_icon"><?php echo $GLOBALS['update']; ?></div>
                    <div class="box_num text-danger"></div>
                </div>
            </div>
            <div class="box_title">آپدیت</div>
        </div>


    </div>
</div>

<div class="cat">
    <div class="box_cat_parent">

        <div class="box_cat b1 inactive_option" onclick="navigate('logout.php')">
            <div class="box_cat">
                <div class="box d-flex mt-2 none_click_box">
                    <div class="box_icon"><?php echo $GLOBALS['update']; ?></div>
                    <div class="box_num text-danger"></div>
                </div>
            </div>
            <div class="box_title">خروج</div>
        </div>

    </div>
</div>