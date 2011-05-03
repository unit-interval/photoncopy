<?php

require './config.php';
require './inc/function.php';

session_name(SESSNAME);
session_start();

print_rh($_SESSION);

?>
