<?php
require 'ippanel/vendor/autoload.php';
$apiKey = "WIsqaEu45JFhybtmDhwJqAlySO2DDanRt7F10rdo_5E=";
$client = new \IPPanel\Client($apiKey);

$patternVariables = [
    "customer_name" => $customer_name,
    "course_name" => $course_name,
    "manager_name" => $manager_name,
];
$rec = $tel;

$messageId = $client->sendPattern(
    "aiifnjgcx2irua4",    // pattern code
    "+983000505",      // originator
    "$rec",  // recipient
    $patternVariables,  // pattern values
); 
