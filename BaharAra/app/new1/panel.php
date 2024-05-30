<style>
    body {
        color: #fff;
    }
</style>

<script>
    document.getElementById('headTitle').innerHTML = 'پنل کاربری';
</script>

<?php
if (isset($_COOKIE['uid'])) {
    require_once('enter.php');
} else {
    echo '<script>open_page("login");</script>';
}
?>