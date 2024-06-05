<!-- space from bottom -->
<div class="cat mb_4">
    <div class="card my_card border_none"></div>
</div>

<div class="rapid_access">
    <div class="item_" onclick="page('d','.')">
        <div class="item_circle bg_purple">
            <div class="item_icon"><?php echo $home; ?></div>
        </div>
        <!-- <div class="item_title">خانه</div> -->
    </div>
    <div class="item_" onclick="page('r','_wallet')">
        <div class="item_circle bg_green">
            <div class="item_icon"><?php echo $wallet; ?></div>
        </div>
        <!-- <div class="item_title">کیف پول</div> -->
    </div>
    <div class="item_" onclick="page('r','_contacts')">
        <div class="item_circle bg_gray">
            <div class="item_icon"><?php echo $contacts; ?></div>
        </div>
        <!-- <div class="item_title">مخاطبین</div> -->
    </div>
    <div class="item_" onclick="page('r','_newCourse')">
        <div class="item_circle bg_orange">
            <div class="item_icon"><?php echo $active_course; ?></div>
        </div>
        <!-- <div class="item_title">دوره جدید</div> -->
    </div>
    <div class="item_" onclick="page('r','_newTransaction')">
        <div class="item_circle bg_blue">
            <div class="item_icon"><?php echo $bag_plus; ?></div>
        </div>
        <!-- <div class="item_title">خرید جدید</div> -->
    </div>
</div>

</div><!-- end of container -->
<?php include_once('javascript.php'); ?>

</body>

</html>