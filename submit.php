<?php

include './config.php';
include './inc/function.php';
include './inc/database.php';

session_name(SESSNAME);
session_start();

if($_SESSION['logged_in'] != true)
	err_redir('Please Login.');

if($order = verify_order_form()) {
	if($_FILES['document']['error'] === UPLOAD_ERR_OK) {
		if(!($fname = save_upload_file()))
		err_redir('uploading failed.', '/home.php');
		$query = "insert into `order` values (default,"
			. $_SESSION['uid'] . ','
			. $order['pid'] . ','
			. '0, '
			. $order['type'] . ','
			. $order['paper'] . ','
			. $order['color'] . ','
			. $order['double'] . ','
			. $order['copy'] . ','
			. $order['page'] . ','
			. $order['cost'] . ','
			. "'" . $db->real_escape_string($fname) . "',"
			. "'" . $db->real_escape_string($order['_note']) . "')";
		if($db->query($query) !== TRUE)
		err_redir("db error({$db->errno}).", '/error.php');
		$oid = $db->insert_id;
		err_redir("order #$oid successfully submitted.", '/home.php');
	}
} elseif(isset($_GET['oid']) && isset($_GET['act'])) {
	$oid = intval($_GET['oid']);
	$act = intval($_GET['act']);

$query = "select `status` from `order`
	where `id` = $oid and `uid` = {$_SESSION['uid']}";
$result = $db->query($query);
if($result->num_rows == 0)
err_redir('无效订单', '/home.php');

$row = $result->fetch_row();
$result->free();

if($act !==0)
err_redir('无效订单', '/home.php');

$query = "update `order` set `status` = 1
	where `id` = $oid";
if($db->query($query) !== TRUE)
	err_redir("db error({$db->errno}).", '/error.php');
} else
	err_redir('无效订单', '/home.php');

err_redir('成功修改订单状态', '/home.php');

function verify_order_form() {
	if (!isset($_POST['store']))
	return FALSE;
	$o = array(
		'pid' => intval($_POST['store']),
		'type' => intval($_POST['type']),
		'paper' => intval($_POST['paper']),
		'color' => intval($_POST['color']),
		'double' => intval($_POST['double']),
		'copy' => intval($_POST['copy']),
		'page' => intval($_POST['page']),
		'cost' => intval($_POST['cost']),
		'_note' => $_POST['note'],
	);
//	TODO may need further check
	return $o;
}
function save_upload_file() {
	$n = "ID_{$_SESSION['uid']}_" . substr(base64_encode(md5(rand())), 0, 5) . '_' . mb_substr($_FILES['document']['name'], -50);
	if(move_uploaded_file($_FILES['document']['tmp_name'], DIR_UPLD . $n))
	return $n;
	else
	return false;
}
