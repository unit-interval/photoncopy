<?php

include '../config.php';
include '../inc/text-defs.php';

session_name(SESSNAME);
session_start();

if($_SESSION['admin'] != true)
die('"At this time, I think you should purchase me an alcoholic beverage and engage in diminutive conversation with me in hopes of establishing a rapport."');

echo "<p>order type:<br /><pre>";
var_dump($text_order_type);
echo "</pre></p>";
echo "<p>order status:<br /><pre>";
var_dump($text_order_status);
echo "</pre></p>";


