<?php
$now_course_id = $_GET['id'];
$x = SELECT_course_id($_GET['id']);
$c_name = $x['course_name'];
?>

<div class="row empty">دوره ها > دوره های فعال > <?php echo $c_name; ?> > پرداخت ها</div>

<div class="cat">
    <?php active_payments($_GET['id']); ?>
</div>

<div class="add_payments">
    <!-- set by ajax and connect to transaction_detail php function -->
    <?php //transaction_detail(1);
    ?>
</div>

<div class="floatingActionButton" onclick="window.location.assign('./?route=_newPayment&h=payments&id=<?php echo $now_course_id;?>')">
    <div class="icon">
        <?php echo $GLOBALS['payment']; ?>
        <span>واریز جدید</span>
    </div>
</div>
