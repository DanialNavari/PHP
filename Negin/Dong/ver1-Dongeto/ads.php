<?php
require_once('func.php');
db();
UPDATE_ads($_GET['utm_ads']);
switch ($_GET['utm_ads']) {
    case 1:
        $ads =  "https://www.instagram.com/skincarefaezeh_n?igsh=MTg1MDN0cWh4a2hoMQ==";
}
?>
<script>
    window.location.assign("<?php echo $ads; ?>");
</script>