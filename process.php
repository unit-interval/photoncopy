<?php

/**
 * file to handle orders
 */

include './config.php';
include './inc/database.php';
include './inc/function.php';

session_name(SESSNAME_P);
session_start();

if($_SESSION['partner'] !== true)
err_redir('未登錄', '/partner.php');

if(isset($_GET['oid']) && isset($_GET['act'])) {
	$oid = intval($_GET['oid']);
	$act = intval($_GET['act']);
} else
err_redir('無效訂單', '/partner.php');

$query = "select `status` from `order`
	where `id` = $oid and `pid` = {$_SESSION['pid']}";
$result = $db->query($query);
if($result->num_rows == 0)
err_redir('無效訂單', '/partner.php');

$row = $result->fetch_row();
$result->free();

if(!in_array($act, text_queue_action_par($row[0])))
err_redir('無效訂單', '/partner.php');

$query = "update `order` set `status` = ".to_status_par($act)."
	where `id` = $oid";
if($db->query($query) !== TRUE)
	err_redir("db error({$db->errno}).", '/error.php');

err_redir('成功修改訂單狀態', '/partner.php');
