<?php
    $x = SELECT_course_id($_GET['id']);
    $c_name = $x['course_name'];
?>
<div class="row empty">دوره ها > دوره های فعال > <?php echo $c_name;?> > گزارش</div>
<div class="cat">
    <?php echo final_report($_GET['id']); ?>
</div>

<?php include_once('javascript.php'); ?>

<script>
    let users_debt = $('#users_sum_debt').val();
    $('#remain_debt').text(users_debt);
</script>

<iframe src="" id="screenshot"></iframe>