<?php
require_once('func.php');

$x = $_GET['n'];

$fa_fmt = numfmt_create('fa', NumberFormatter::DECIMAL);
$ar_fmt = numfmt_create('ar', NumberFormatter::DECIMAL);

$output1 = numfmt_parse($fa_fmt, $x);
$output2 = numfmt_parse($ar_fmt, $x);


