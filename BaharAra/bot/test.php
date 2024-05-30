<?php
function convertPersianToEnglish($string)
{
    $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
    $english = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];


    $output = str_replace($persian, $english, $string);
    return substr($output, 1);
}

convertPersianToEnglish('۰۹۱۵۲۴۵۵۸۷');
