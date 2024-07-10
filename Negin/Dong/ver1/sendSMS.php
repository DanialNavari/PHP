<?php
require 'ippanel/vendor/autoload.php';
$apiKey = "WIsqaEu45JFhybtmDhwJqAlySO2DDanRt7F10rdo_5E=";
$client = new \IPPanel\Client($apiKey);

$vcode = mt_rand(111111, 999999);
$patternVariables = [
    "vcode" => $vcode,
];
$rec = $tel;

// $messageId = $client->sendPattern(
//     "nx5eglt0qa6352a",    // pattern code
//     "+983000505",      // originator
//     "$rec",  // recipient
//     $patternVariables,  // pattern values
// ); 

