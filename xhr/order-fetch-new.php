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

if(!isset($_GET['since'])) {
	header('HTTP/1.0 400 Bad Request');
	die;
}

$orders = array();
$users = array();
$oid = intval($_GET['since']);

$query = "select * from `order`
	where `id` > $oid and `pid` = {$_SESSION['pid']}
	order by `id` desc";
$result = $db->query($query);
if($result->num_rows == 0) {
	header('HTTP/1.0 204 No Content');
	die;
}
while($row = $result->fetch_assoc()){
	$orders[$row['id']] = $row;
	$users[] = $row['uid'];
}
$result->free();
$users = array_unique($users, SORT_NUMERIC);
$query_part1 = '';
$query_part2 = '';
foreach($users as $id) {
	$query_part1 .= " `id` = $id or";
	$query_part2 .= " `uid` = $id or";
}
$query_part1 = substr($query_part1, 0, -3);
$query_part2 = substr($query_part2, 0, -3);
$users = array();
$query = "select `id`, `name` from `user` where" . $query_part1;
$result = $db->query($query);
while($row = $result->fetch_assoc())
	$users[$row['id']] = $row;
$result->free();
$query = "select `uid`, `credit` from `credit` where `pid` = 0 and (" . $query_part2 . ")";
$result = $db->query($query);
while($row = $result->fetch_assoc())
	$users[$row['uid']]['credit'] = $row['credit'];
$result->free();

foreach ($orders as $o)
	echo unit_order_par($o, $users[$o['uid']]);

?>
