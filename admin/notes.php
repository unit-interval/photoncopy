<?php

include '../config.php';
include '../inc/function.php';

session_name(SESSNAME);
session_start();

if($_SESSION['admin'] != true)
die('"At this time, I think you should purchase me an alcoholic beverage and engage in diminutive conversation with me in hopes of establishing a rapport."');

echo "<pre>";
print_r(text_defs('',true));
echo "</pre></p>";



