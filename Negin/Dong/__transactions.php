<div class="row empty">دوره ها > دوره های فعال > مسافرت جنوب > تراکنش ها</div>

<div class="cat">
    <?php //active_transactions($_GET['id']); ?>
</div>

<div class="add_payments">
    <!-- set by ajax and connect to transaction_detail php function -->
    <?php transaction_detail(1);?>
</div>

<div class="floatingActionButton click1">
    <div class="icon">
        <?php echo $plus; ?>
    </div>
</div>