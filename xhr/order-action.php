<?php

include '../config.php';
include '../inc/database.php';
include '../inc/function.php';
include '../inc/module.php';

session_name(SESSNAME);
session_start();

/**
 * errno:
 * 0	no error
 * 1	not logged in
 * 2	wrong param
 * 3	wrong order
 * 4	status already cancelled
 * 5	status already changed
 * 6	database error
 * 3	failed sending email
 */
//header('content-type: application/json');

if($_SESSION['logged_in'] != true)
	die(json_encode(array('errno' => 1,)));

if(!isset($_POST['oid']) || !isset($_POST['act']))
	die(json_encode(array('errno' => 2,)));

$oid = intval($_GET['oid']);
$act = intval($_GET['act']);

$query = "select * from `order`
	where `id` = $oid and `uid` = {$_SESSION['uid']}";
$result = $db->query($query);
if($result->num_rows == 0)
	die(json_encode(array('errno' => 3,)));

$order = $result->fetch_assoc();
$result->free();

$return = array();

if($order['status'] != '0') {
	$return['errno'] = (($order['status'] == '1') ? 4 : 5);
} else {
	$query = "update `order` set `status` = 1 where `id` = $oid";
	if($db->query($query) !== true)
		die(json_encode(array('errno' => 6,)));
	$order['status'] = 1;
	$return['errno'] = 0;
}

$return['html'] = unit_order($order);
echo json_encode($return);

?>
