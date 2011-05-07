<?php

include './config.php';
include './inc/database.php';
include './inc/function.php';

session_name(SESSNAME_P);
session_start();

if($_SESSION['partner'] !== true)
die;

if(isset($_GET['oid']) && isset($_GET['act'])) {
	$oid = intval($_GET['oid']);
	$act = intval($_GET['act']);
} else
die;

$query = "select `status` from `order`
	where `id` = $oid and `pid` = {$_SESSION['pid']}";
$result = $db->query($query);
if($result->num_rows == 0)
die;

$row = $result->fetch_row();
$result->free();

$to = text_queue_action_par($row[0]);

if(!in_array($act, text_queue_action_par($row[0])))
die;

$query = "update `order` set `status` = ".to_status_par($act)."
	where `id` = $oid";
if($db->query($query) !== TRUE)
	err_redir("db error({$db->errno}).", '/error.php');

err_redir('', '/partner.php');
