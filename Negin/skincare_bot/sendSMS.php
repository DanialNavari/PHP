<?php
require 'ippanel/vendor/autoload.php';
$apiKey = "WIsqaEu45JFhybtmDhwJqAlySO2DDanRt7F10rdo_5E=";
$client = new \IPPanel\Client($apiKey);
$pattern = $_GET['pattern'];
$rec = $_GET['tel'];
switch ($pattern) {
    case "vjkuvy2di4tflas":
        $patternVariables = [
            "customer_name" => $_GET['name'],
        ];
        break;
    case "gjvd1z0qvsjky7h":
        $patternVariables = [
            "customer_name" => $_GET['name'],
            "percent" => $_GET['percent'],
        ];
        break;
    case "l3zzf48271bb0c9":
        $patternVariables = [
            "customer_name" => $_GET['name'],
            "percent" => $_GET['percent'],
        ];
        break;
}


$messageId = $client->sendPattern(
    "$pattern",    // pattern code
    "+983000505",      // originator
    "$rec",  // recipient
    $patternVariables,  // pattern values
);
