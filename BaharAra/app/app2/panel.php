<style>
    body {
        color: #fff;
    }
</style>


<?php
if (isset($_COOKIE['uid'])) {
    require_once('enter.php');
} else {
    echo '<script>open_page("login");</script>';
}
?>