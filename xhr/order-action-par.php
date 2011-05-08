<?php

include '../config.php';
include '../inc/database.php';
include '../inc/function.php';
include '../inc/module.php';

session_name(SESSNAME_P);
session_start();

if($_SESSION['partner'] != true) {
	header('HTTP/1.0 403 Forbidden');
	die;
}

if(!isset($_GET['oid']) || !isset($_GET['act'])) {
	header('HTTP/1.0 400 Bad Request');
	die;
}

$oid = intval($_GET['oid']);
$act = intval($_GET['act']);

$query = "select * from `order`
	where `id` = $oid and `pid` = {$_SESSION['pid']}";
$result = $db->query($query);
if($result->num_rows == 0) {
	header('HTTP/1.0 403 Forbidden');
	die;
}

$row = $result->fetch_assoc();
$result->free();

if(!in_array($act, text_queue_action_par($row['status']))) {
	header('HTTP/1.0 400 Bad Request');
	die;
}
$status = to_status_par($act);
$query = "update `order` set `status` = $status
	where `id` = $oid";
if($db->query($query) !== TRUE) {
	header('HTTP/1.0 500 Internal Server Error');
	die;
}

$row['status'] = $status;
echo unit_order_par($row);

?>
