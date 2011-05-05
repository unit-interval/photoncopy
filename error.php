<?php

include './config.php';
include './inc/function.php';

session_name(SESSNAME);
session_start();

print_re($_SESSION);

?>
