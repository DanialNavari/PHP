<!-- space from bottom -->
<div class="cat mb_4">
    <div class="card my_card border_none"></div>
</div>

<div class="rapid_access">
    <div class="item_" onclick="page('d','.','home')" id="home">
        <div class="item_circle">
            <div class="item_icon"><?php echo $home; ?></div>
        </div>
        <div class="item_title">خانه</div>
    </div>
    <div class="item_" id="wallet">
        <div class="item_circle">
            <div class="item_icon"><?php echo $wallet; ?></div>
        </div>
        <div class="item_title">کیف پول</div>
    </div>
    <div class="item_" onclick="page('r','_contacts','contact')" id="contact">
        <div class="item_circle">
            <div class="item_icon"><?php echo $contacts; ?></div>
        </div>
        <div class="item_title">مخاطبین</div>
    </div>
    <div class="item_" onclick="page('r','_newCourse','course')" id="newCourse">
        <div class="item_circle">
            <div class="item_icon"><?php echo $active_course; ?></div>
        </div>
        <div class="item_title">دوره جدید</div>
    </div>
    <div class="item_" onclick="page('r','_newTransaction','transaction')" id="transaction">
        <div class="item_circle">
            <div class="item_icon"><?php echo $bag_plus; ?></div>
        </div>
        <div class="item_title">ثبت خرید</div>
    </div>
</div>

</div>
<!-- end of container -->

<?php if (isset($_GET['h'])) {
    $h = $_GET['h'];
} else {
    $h = 'home';
}
?>
<input type="hidden" id="path_name" value="<?php echo $h; ?>">
<input type="hidden" id="prev_page" value="
<?php if (isset($_SERVER['HTTP_REFERER'])) {
    echo $_SERVER['HTTP_REFERER'];
} else {
    echo '';
} ?>">

<div class="alertBox">
    <div class="alert alert-danger alert-dismissible fade show sum1" role="alert">
        <?php echo $alert; ?>
        <span></span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</div>

<?php include_once('javascript.php'); ?>

</body>

</html>