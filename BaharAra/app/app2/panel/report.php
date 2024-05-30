<?php require_once('report_header.php'); ?>

<?php echo visit_log($s, $e); ?>
<?php echo visit_hour($s, $e); ?>


<style>
    td span {
        font-size: 0.75rem;
    }
</style>
</div>

</div>
<?php require_once('report_footer.php'); ?>