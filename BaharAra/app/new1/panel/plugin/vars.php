<?php
$data_user = [];
$data_log = [];
$zaman = $_GET['date'];

$total_visit_time = 0;
$total_route_time = 0;

$dis_km = 0;
$dis_time = 0;

$visit_plus = 0;
$visit_neg = 0;

$route_morning = '';
$route_evening = '';

$tedad_mo = 0;
$tedad_ev = 0;

$old_customer = [];
$old_customer_count = 0;
$new_customer_count = 0;

$base = [];
$loc = [];

$manategh = [];
