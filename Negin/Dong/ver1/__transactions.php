<?php
    $x = SELECT_course_id($_GET['id']);
    $c_name = $x['course_name'];
?>
<div class="row empty">دوره ها > دوره های فعال > <?php echo $c_name;?>  > خرید ها</div>

<div class="cat">
    <?php active_transactions($_GET['id']); ?>
</div>

<div class="add_payments">
    <!-- set by ajax and connect to transaction_detail php function -->
    <?php //transaction_detail(1);?>
</div>



