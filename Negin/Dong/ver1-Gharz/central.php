<?php require_once("symbol.php"); ?>

<div style="margin-top: 3.6rem;"></div>

<div class="cat">
    <div class="group_name">
        <h6 class="font-weight-bold">به دونگتو خوش آمدید</h6>
    </div>
    <div class="box_cat_parent">
        <div class="box_cat" onclick="window.location.assign('./?route=main_body&bm=dongeto')">
            <div class="box_cat">
                <div class="box d-flex mt-2 ">
                    <div class="box_icon">
                        <?php echo $share; ?>
                    </div>
                    <div class="box_num text-danger"></div>
                </div>
                <div class="box_title">دونگ دورهمی</div>
            </div>
        </div>

        <div class="box_cat">
            <div class="box_cat">
                <div class="box d-flex mt-2 none_click_box">
                    <div class="box_icon">
                        <?php echo $loan; ?>
                    </div>
                    <div class="box_num text-danger"></div>
                </div>
                <div class="box_title">قرض و طلب</div>
            </div>
        </div>

    </div>

    <div class="box_cat_parent">
        <div class="box_cat">
            <div class="box_cat">
                <div class="box d-flex mt-2 none_click_box">
                    <div class="box_icon">
                        <?php echo $home_loan; ?>
                    </div>
                    <div class="box_num text-danger"></div>
                </div>
                <div class="box_title">وام خونگی</div>
            </div>
        </div>
        <div class="box_cat">
            <div class="box_cat">
                <div class="box d-flex mt-2 none_click_box">
                    <div class="box_icon">
                        <?php echo $luggage; ?>
                    </div>
                    <div class="box_num text-danger"></div>
                </div>
                <div class="box_title">مدیر تور</div>
            </div>
        </div>

        <div class="box_cat">
            <div class="box_cat">
                <div class="box d-flex mt-2 none_click_box">
                    <div class="box_icon">
                        <?php echo $building; ?>
                    </div>
                    <div class="box_num text-danger"></div>
                </div>
                <div class="box_title">مدیر ساختمون</div>
            </div>
        </div>

    </div>
</div>

<div class="cat">
    <div class="group_name">
        <h6 class="font-weight-bold">پشتیبانی</h6>
    </div>
    <div class="box_cat_parent">
        <div class="box_cat" onclick="window.location.assign('tg://resolve?domain=dongeto')">
            <div class="box_cat">
                <div class="box d-flex mt-2 ">
                    <div class="box_icon"><img src="./image/telegram.svg" alt="bale"></div>
                    <div class="box_num text-danger"></div>
                </div>
                <div class="box_title">چت</div>
            </div>
        </div>
        <div class="box_cat">
            <div class="box_cat">
                <div class="box d-flex mt-2 none_click_box">
                    <div class="box_icon"><?php echo $GLOBALS['letter']; ?></div>
                    <div class="box_num text-danger"></div>
                </div>
                <div class="box_title">تیکت</div>
            </div>
        </div>
        <div class="box_cat" onclick="window.location.assign('tg://resolve?domain=dongetobot')">
            <div class="box_cat">
                <div class="box d-flex mt-2 ">
                    <div class="box_icon"><?php echo $GLOBALS['robot']; ?></div>
                    <div class="box_num text-danger"></div>
                </div>
                <div class="box_title">ربات تلگرام</div>
            </div>
        </div>
    </div>
</div>

<div class="cat">
    <div class="group_name">
        <h6 class="font-weight-bold">برنامه</h6>
    </div>
    <div class="box_cat_parent">
        <div class="box_cat" onclick="window.open('https://cafebazaar.ir/app/co.median.android.wjnnrx','_blank')">
            <div class="box_cat">
                <div class="box d-flex mt-2 ">
                    <div class="box_icon"><?php echo $GLOBALS['update']; ?></div>
                    <div class="box_num text-danger"></div>
                </div>
                <div class="box_title">آپدیت</div>
            </div>
        </div>
        <div class="box_cat" onclick="navigate('logout.php')">
            <div class="box_cat">
                <div class="box d-flex mt-2 exit_box">
                    <div class="box_icon"><?php echo $GLOBALS['logout']; ?></div>
                    <div class="box_num text-danger"></div>
                </div>
                <div class="box_title">خروج</div>

            </div>
        </div>
    </div>