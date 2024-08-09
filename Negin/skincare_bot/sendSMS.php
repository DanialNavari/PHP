<?php
require 'ippanel/vendor/autoload.php';
$apiKey = "WIsqaEu45JFhybtmDhwJqAlySO2DDanRt7F10rdo_5E=";
$client = new \IPPanel\Client($apiKey);

$patternVariables = [
    "customer_name" => $_GET['name'],
    "percent" => $_GET['percent'],
];
$rec = $_GET['tel'];

$messageId = $client->sendPattern(
    "gjvd1z0qvsjky7h",    // pattern code
    "+983000505",      // originator
    "$rec",  // recipient
    $patternVariables,  // pattern values
); 

