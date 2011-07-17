<?php

include './config.php';
include './inc/function.php';

//	TODO
//	error handle
//	check all include paths

//session_name(SESSNAME);
//session_start();
//$s = $_SESSION;
//session_write_close(); 

session_name(SESSNAME_P);
session_start();

print_re(array($s, $_SESSION));


function print_re($v) {
	echo "<pre>\n";
	var_dump($v);
	echo "</pre>";
	die;
}

?>
