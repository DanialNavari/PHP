<?php
setcookie("uid", "", time() - 3600, "/", null, true);
?>
<script>
    open_page('login');
</script>";