<?php

include './config.php';
include './inc/function.php';

session_name(SESSNAME);
session_start();
$s = $_SESSION;
session_write_close(); 
session_name(SESSNAME_P);
session_start();

print_re(array($s, $_SESSION));

?>
