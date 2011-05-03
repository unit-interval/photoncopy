<?php

require '../config.php';

session_name(SESSNAME);
session_start();

if($_GET['become'] == 'admin') {
	$_SESSION['admin'] = true;
	echo "May Elune be with you.";
} else
	echo "En Taro Tassadar."

?>
