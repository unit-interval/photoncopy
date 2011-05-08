<?php

include '../config.php';
include '../inc/database.php';
include '../inc/function.php';
include '../inc/module.php';

session_name(SESSNAME_P);
session_start();

if($_SESSION['partner'] != true) {
	header('HTTP/1.0 403 Forbidden');
	echo '123';
	die;
}

$oid = intval($_GET['since']);

$query = "select * from `order`
	where `id` > $oid and `pid` = {$_SESSION['pid']}
	order by `id` desc";
$result = $db->query($query);
if($result->num_rows == 0) {
	header('HTTP/1.0 204 No Content');
	die;
}

while($row = $result->fetch_assoc())
	echo unit_order_par($row);
$result->free();





?>
