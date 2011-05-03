<?php

require '../config.php';

session_name(SESSNAME);
session_start();

if($_GET['become'] == 'admin') {
	$_SESSION['admin'] = true;
	echo '"Baby, I\'m mortal now. Time\'s a wastin\'."';
} else
	echo "Hey, Look! We found a witch! May we burn her?"

?>
