<div class="row empty">دوره ها > دوره های فعال > مسافرت جنوب > گزارش</div>
<div class="cat">
    <?php echo final_report($_GET['id']); ?>
</div>

<?php include_once('javascript.php'); ?>

<script>
    let users_debt = $('#users_sum_debt').val();
    $('#remain_debt').text(users_debt);
</script>