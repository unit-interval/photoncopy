<?php

include '../config.php';
include DIR_INC . 'database.php';
include DIR_INC . 'function.php';
include DIR_INC . 'module.php';

function move_tmp_file($fid, $fname) {
	$tmpname = DIR_UPLD_TMP . $_SESSION['uid'] . '-' . $fid;
	if(!file_exists($tmpname))
		return false;
	$n = "P-{$_SESSION['uid']}-" . substr($fid, 0, 4) . '_' . mb_substr($fname, -50);
	if(rename($tmpname, DIR_UPLD . $n))
		return $n;
	else
		return false;
}
function reach_new_badge($count) {
	$map = badge_criteria('num_submit');
	if(isset($map[$count]))
		return $map[$count];
	else
		return false;
}
//	TODO may need further check
function verify_order_form() {
	if (!isset($_POST['pid']))
	return FALSE;
	$needle = array('/', ' ', "\t");
	$o = array(
		'pid' => intval($_POST['pid']),
		'paper' => intval($_POST['paper']),
		'color' => intval($_POST['color']),
		'back' => intval($_POST['back']),
		'layout' => intval($_POST['layout']),
		'page' => intval($_POST['page']),
		'copy' => intval($_POST['copy']),
		'misc' => intval($_POST['misc']),
		'fid' => strip_tags($_POST['fid']),
		'fname' => strip_tags(str_replace($needle, '_', $_POST['fname'])),
		'note' => strip_tags($_POST['note']),
	);
	return $o;
}

session_name(SESSNAME);
session_start();

if($_SESSION['logged_in'] != true) {
	header('HTTP/1.0 403 Forbidden');
	die;
}

if(!($order = verify_order_form())) {
	header('HTTP/1.0 400 Bad Request');
	die;
}

//header('content-type: application/json');

/**
 * errno:
 * 0	no error
 * 1	cant locate file
 * 2	database error
 */
$return = array();
if(!($fname = move_tmp_file($order['fid'], $order['fname'])))
	die(json_encode(array('errno' => 1,)));

$query = "insert into `order` values (default,"
	. $_SESSION['uid'] . ','
	. $order['pid'] . ','
	. '0, '
	. $order['paper'] . ','
	. $order['color'] . ','
	. $order['back'] . ','
	. $order['layout'] . ','
	. '0, '
	. $order['copy'] . ','
	. $order['misc'] . ','
	. 'default, '
	. 'default, '
	. "'" . $db->real_escape_string($order['fname']) . "',"
	. "'" . $db->real_escape_string($fname) . "',"
	. 'default, '
	. 'default, '
	. 'default, '
	. 'default, '
	. "'" . $db->real_escape_string($order['note']) . "')";
if($db->query($query) !== TRUE)
	die(json_encode(array('errno' => 2,)));

$order['id'] = $db->insert_id;
$order['status'] = 0;
$order['flink'] = $_fname;

$return['html'] = unit_order($order);

$query = "select count(`id`) from `order` where `uid` = {$_SESSION['uid']}";
if(!($result = $db->query($query)))
	die(json_encode(array('errno' => 2,)));
list($count) = $result->fetch_row();
if($bid = reach_new_badge($count)) {
	$query = "insert into `badge-won` (`uid`, `bid`) values ({$_SESSION['uid']}, $bid)";
	if($db->query($query) !== TRUE)
		die(json_encode(array('errno' => 2,)));
	$query = "select `type`, `name` from `badge` where `id` = $bid";
	if(!($result = $db->query($query)))
		die(json_encode(array('errno' => 2,)));
	$badge = $result->fetch_assoc();
	$return['badge'] = $badge;
	$result->free();
	$query = "update `badge` set `count` = `count` + 1 where `id` = $bid";
	if($db->query($query) !== TRUE)
		die(json_encode(array('errno' => 2,)));
	switch ($badge['type']){
		case 1: $credit=50; break;
		case 2: $credit=20; break;
		default: $credit=10;
	}
	$query = "update `credit` set `credit` = `credit` + $credit where `uid` = {$_SESSION['uid']} and `pid` = 0";
	$db->query($query);
	$_SESSION['credit'][0] += $credit;
}

$return['errno'] = 0;
echo json_encode($return);

?>
