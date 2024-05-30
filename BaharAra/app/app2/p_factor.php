<?php require_once('func.php');
$info = getInfo($_COOKIE['uid']); ?>
<style>
    .page {
        margin-bottom: 5rem;
    }
</style>
<input type="hidden" id="f_id" value="<?php echo $info['factor_id']; ?>" />
<div class="show_factor" style="display: none;margin-right: -1.4rem;"></div>
<div style="text-align: center;margin-top: -2rem;">
    <?php get_cat(); ?>
</div>
<div style="text-align: center;width: 98%;">
    <button class="btn btn-danger" style="width: inherit; margin: 0.5rem auto;" onclick="cancel_order()">انصراف از سفارش</button>
</div>

<script>
    function cancel_order() {
        var darkhast = confirm("آیا می خواهید این فاکتور حذف شود؟");
        if (darkhast) {
            var f_id = $('#f_id').val();
            $.ajax({
                data: 'delete_order=ok&id=' + f_id,
                url: 'server.php',
                type: 'GET',
                success: function(result) {
                    window.location.reload();
                }
            });
        }
    }

    $('#headTitle').text('دسته بندی محصولات');
</script>