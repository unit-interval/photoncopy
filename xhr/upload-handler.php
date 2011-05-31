<?php

include '../config.php';

session_name(SESSNAME);
session_start();

if($_SESSION['logged_in'] != true) {
	header('HTTP/1.0 403 Forbidden');
	die;
}

//	TODO may need further check
if(!isset($_POST['UPLOAD_IDENTIFIER'])) {
	header('HTTP/1.0 400 Bad Request');
	die;
}

$fid = strip_tags($_POST['UPLOAD_IDENTIFIER']);


if ($_FILES["file"]["error"] === UPLOAD_ERR_OK) {
	if(!move_uploaded_file($_FILES['file']['tmp_name'], DIR_UPLD_TMP . $_SESSION['uid'] . '-' . $fid))
		die("<p id='result'>fail</p><p id='err'>filesystem error<p>");
	$name = basename($_FILES['file']['name']);
	$size = $_FILES['file']['size'];
	if($size < 1024)
		$size_h = "$size Bytes";
	elseif($size < 1048576)
		$size_h = floor($size / 1024) . ' KiB';
	else
		$size_h = floor($size / 1048576) . ' MiB';
	echo "<p id='upload-result'>success</p>";
	echo "<p id='upload-name'>$name</p>";
	echo "<p id='upload-size'>$size_h</p>";
} else
	die("<p id='result'>fail</p><p id='err'>{$_FILES["file"]["error"]}</p>");

?>

