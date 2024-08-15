<meta charset="UTF-8">
به نام خدا
<?php

// 0
// include autoloader
require_once 'dompdf/autoload.inc.php';

// reference the Dompdf namespace
use Dompdf\Dompdf;

$dompdf = new Dompdf();

// ---------------------------------make pdf from file

$dompdf->loadHtml("به نام خدا");

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream();
