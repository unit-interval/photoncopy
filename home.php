<?php

/** 
 * main page for user activities
 */

/** turn on output buffering */
ob_start();

include './config.php';
include './inc/function.php';
include './inc/page.php';
include './inc/module.php';
include './inc/database.php';

session_name(SESSNAME);
session_start();

if($_SESSION['logged_in'] != true) {
	include './inc/auth.php';
	cookie_auth();
	if($_SESSION['logged_in'] != true)
	err_redir('请先登录');
}

$link['css'][] = 'style';
$link['css'][] = 'styleHome';
$link['js'][] = 'jquery';
$link['js'][] = 'jquery-ui';
$link['js'][] = 'jquery.scrollTo';
$link['js'][] = 'script';
$link['js'][] = 'scriptHome';

/* global arrays to hold necessary info */
$orders = array();
$stores = array();
$credit = array();

/* all orders for current user */
$query = "select * from `order` where `uid` = {$_SESSION['uid']}
	order by `id` desc";
if($result = $db->query($query)) {
	while($row = $result->fetch_assoc())
	$orders[$row['id']] = $row;
	$result->free();
}
/* all partners in current location */
$query = "select `id`, `name`, `region`, `memo` from `partner`";
if($result = $db->query($query)) {
	while($row = $result->fetch_assoc())
	$stores[$row['id']] = $row;
	$result->free();
}
/* user credit */
$query = "select `pid`, `credit` from `credit` where `uid` = {$_SESSION['uid']}";
if(!($result = $db->query($query)))
	err_redir("db error({$db->errno}). query:$query", '/error.php');
while($row = $result->fetch_assoc())
	$credit[$row['pid']] = $row['credit'];
$result->free();

$_SESSION['credit'] = $credit;

/** TODO
 * work on notif system
 * $_SESSION['notif'] = array();
 */

page_meta();
page_nav();
page_home($orders, $stores);
page_footer();
script_home($stores);
page_close();

?>
