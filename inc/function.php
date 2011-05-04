<?php

/** predefined error messages might be needed */
function err_redir($err = '', $tar = '/') {
	if($tar == '/error.php')
	$_SESSION['err'] = $err;
	else
	$_SESSION['msg'] = $err;
	header("Location: $tar");
	die;
}

function print_rh($v) {
	echo "<pre>\n";
	print_r($v);
	echo "</pre>";
	die;
}

