<?php

include '../config.php';
include '../inc/database.php';
include '../inc/function.php';
include '../inc/module.php';

session_name(SESSNAME);
session_start();

if($_SESSION['logged_in'] != true) {
	header('HTTP/1.0 403 Forbidden');
	die;
}

if(!isset($_GET['oid']) || !isset($_GET['status'])) {
	header('HTTP/1.0 400 Bad Request');
	die;
}

$oid = intval($_GET['oid']);
$status = intval($_GET['status']);

$query = "select * from `order`
	where `id` = $oid and `uid` = {$_SESSION['uid']}";
$result = $db->query($query);
if($result->num_rows == 0) {
	header('HTTP/1.0 403 Forbidden');
	die;
}

$row = $result->fetch_assoc();
$result->free();

if($row['status'] == $status) {
	header('HTTP/1.0 204 No Content');
	die;
} else {
	$query = "select `name` from `partner`
		where `id` = {$row['pid']}";
	$result = $db->query($query);
	$store = $result->fetch_assoc();
	$result->free();
	echo unit_order($row, $store);
}

?>
