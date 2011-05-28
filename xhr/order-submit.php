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
//	TODO may need further check
function verify_order_form() {
	if (!isset($_POST['pid']))
	return FALSE;
	$o = array(
		'pid' => intval($_POST['pid']),
		'paper' => intval($_POST['paper']),
		'color' => intval($_POST['color']),
		'back' => intval($_POST['back']),
		'layout' => intval($_POST['layout']),
		'page' => intval($_POST['page']),
		'copy' => intval($_POST['copy']),
		'misc' => intval($_POST['misc']),
		'fid' => $_POST['fid'],
		'_fname' => str_replace('/', '_', $_POST['fname']),
		'_note' => $_POST['note'],
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
 * 1	cant locate file
 * 2	database error
 */
if(!($_fname = move_tmp_file($order['fid'], $order['_fname'])))
	die(json_encode(array('errno' => 1,)));

//$query = "select `region`, `name` from `partner` where `id` = {$order['pid']}";
//$result = $db->query($query);
//if($result->num_rows == 0) {
//	header('HTTP/1.0 400 Bad Request');
//	die;
//}
//$row = $result->fetch_assoc();
//$result->free();
//$regions = text_defs('store_region');
//$order['ptext'] = $regions[$row['region']] . $row['name'];

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
	. "'" . $db->real_escape_string($order['_fname']) . "',"
	. "'" . $db->real_escape_string($_fname) . "',"
	. 'default, '
	. 'default, '
	. 'default, '
	. 'default, '
	. "'" . $db->real_escape_string($order['_note']) . "')";
if($db->query($query) !== TRUE)
	die(json_encode(array('errno' => 2,)));

$order['id'] = $db->insert_id;
$order['status'] = 0;
$order['flink'] = $_fname;
$order['fname'] = $order['_fname'];
$order['note'] = $order['_note'];

$html = unit_order($order);

$return = array('errno' => 0, 'html' => $html);
echo json_encode($return);

?>
