<?php

include '../config.php';
include DIR_INC . 'database.php';
include DIR_INC . 'function.php';
include DIR_INC . 'module.php';

session_name(SESSNAME_P);
session_start();

/**
 * errno:
 * 0	no error
 * 1	not logged in
 * 2	wrong param
 * 3	wrong order
 * 4	status already changed
 * 5	database error
 */
//header('content-type: application/json');
//
if($_SESSION['partner'] != true)
	die(json_encode(array('errno' => 1,)));

if(!isset($_POST['oid']) || !isset($_POST['to']))
	die(json_encode(array('errno' => 2,)));

$oid = intval($_POST['oid']);
$to = intval($_POST['to']);

$query = "select * from `order`
	where `id` = $oid and `pid` = {$_SESSION['pid']}";
if(!($result = $db->query($query)))
	die(json_encode(array('errno' => 5)));	//, 'query' => $query)));
if($result->num_rows == 0)
	die(json_encode(array('errno' => 3)));	//, 'query' => $query)));
$order = $result->fetch_assoc();
$result->free();

$return = array();

if(in_array($to, order_status_map($order['status']))) {
	if(in_array($order['status'], order_status_map('require_form'))) {
		if(!isset($_POST['cost']) || !isset($_POST['paid']))
			die(json_encode(array('errno' => 2,)));
		$cost = intval($_POST['cost'] * 10);
		$paid = intval($_POST['paid'] * 10);
		$delta = $paid - $cost;
		$query = "update `credit` set `credit` = `credit` + $delta
			where `uid` = {$order['uid']} and `pid` = {$_SESSION['pid']}";
		if($db->query($query) !== TRUE)
			die(json_encode(array('errno' => 5, 'query' => $query)));
		$_SESSION['credit'][$order['uid']] += $delta;
		$query = "update `order` set `status` = $to, `cost` = $cost, `paid` = $paid
			where `id` = $oid";
		$order['cost'] = $cost;
		$order['paid'] = $paid;
	} else
		$query = "update `order` set `status` = $to
			where `id` = $oid";
	if($db->query($query) !== TRUE)
		die(json_encode(array('errno' => 5)));	//, 'query' => $query)));
	$order['status'] = $to;
	$return['errno'] = 0;
} else
	$return['errno'] = 4;

$query = "select `id`, `name` from `user` where `id` = {$order['uid']}";
if(!($result = $db->query($query)))
	die(json_encode(array('errno' => 5)));	//, 'query' => $query)));
$user = $result->fetch_assoc();
$result->free();

$query = "select `credit` from `credit` where `pid` = 0 and `uid` = {$order['uid']}";
if(!($result = $db->query($query)))
	die(json_encode(array('errno' => 5)));	//, 'query' => $query)));
$row = $result->fetch_row();
$result->free();
$user['credit'] = $row[0];

$return['html'] = unit_order_par($order, $user);
echo json_encode($return);

?>
