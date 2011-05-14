<?php

include '../config.php';

session_name(SESSNAME);
session_start();

if($_SESSION['logged_in'] != true) {
	header('HTTP/1.0 403 Forbidden');
	die;
}

if(!isset($_GET['id'])) {
	header('HTTP/1.0 400 Bad Request');
	die;
}

$info = uploadprogress_get_info($_GET['id']);
$r = array();
if($info !== null) {
	$r['id'] = $_GET['id'];
	$r['percentage'] = floor($info['bytes_uploaded']*200/$info['bytes_total']);
	$r['estimate'] = $info['est_sec'];
} else
	$r['id'] = 0;

header('content-type: application/json');

echo json_encode($r);

?>
