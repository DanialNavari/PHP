<?php
setcookie("uid", "", time() - 3600, "/", null, true);
?>
<script>
    window.location.assign('.');
</script>";