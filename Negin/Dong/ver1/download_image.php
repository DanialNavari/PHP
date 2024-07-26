<?php
header("Content-type: image/jpeg");  
header("Cache-Control: no-store, no-cache");  
header('Content-Disposition: attachment; filename="finalreport.jpg"');

$key = $_GET['k'];
$id = $_GET['id'];
// $key = 'e6664a';

?>
<img src="https://api.screenshotmachine.com/?key=<?php echo $key; ?>&url=https%3A%2F%2Fnavarimachinary.ir%2FDong%2Ffinal_report.php%3Fid%3D<?php echo $id; ?>&device=desktop&dimension=800xfull&format=png&cacheLimit=0&delay=200" alt="finalReport">

