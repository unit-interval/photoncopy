<?php

/* user profile and etc"

/** turn on output buffering */
ob_start();

include './config.php';
include DIR_INC . 'database.php';
include DIR_INC . 'function.php';
include DIR_INC . 'module.php';
include DIR_INC . 'page.php';

session_name(SESSNAME);
session_start();

/**
if($_SESSION['state'] === 'activate')
elseif($_SESSION['state'] === 'resetpw')
elseif($_SESSION['logged_in'] == true) {
} else
 */
if($_SESSION['state'] === 'activate')
	$state = 1;
elseif($_SESSION['state'] === 'resetpw')
	$state = 2;
elseif($_SESSION['logged_in'] == true) {
	$badges = array();
	$badges_won = array();
	$num_orders = array();
	$stores = array();
	$credit = array();
	$query = "select * from `badge`";
	if(!($result = $db->query($query)))
		err_redir("db error({$db->errno}). query:$query", '/error.php');
	while($row = $result->fetch_assoc())
		$badges[$row['id']] = $row;
	$result->free();
	$query = "select `bid`, `won` from `badge-won` where `uid` = {$_SESSION['uid']}";
	if(!($result = $db->query($query)))
		err_redir("db error({$db->errno}). query:$query", '/error.php');
	if($result->num_rows == 0)
		$badges_won = false;
	else
		while($row = $result->fetch_assoc())
			$badges_won[$row['bid']] = $row;
	$result->free();
	$query = "select `pid`, count(`id`) as 'count' from `order`
		where `uid` = {$_SESSION['uid']} and `status` = 5 group by `pid`";
	if(!($result = $db->query($query)))
		err_redir("db error({$db->errno}). query:$query", '/error.php');
	if($result->num_rows == 0)
		$num_orders = false;
	else
		while($row = $result->fetch_assoc())
			$num_orders[$row['pid']] = $row['count'];
	$result->free();
	$query = "select `id`, `name` from `partner`";
	if(!($result = $db->query($query)))
		err_redir("db error({$db->errno}). query:$query", '/error.php');
	while($row = $result->fetch_assoc())
		$stores[$row['id']] = $row;
	$result->free();
	$query = "select `pid`, `credit` from `credit` where `uid` = {$_SESSION['uid']}";
	if(!($result = $db->query($query)))
		err_redir("db error({$db->errno}). query:$query", '/error.php');
	while($row = $result->fetch_assoc())
		$credit[$row['pid']] = $row['credit'];
	$result->free();

	$_SESSION['credit'] = $credit;
} else
	err_redir('', '/home.php');

$link['css'][] = 'style';
$link['css'][] = 'styleProfile';
$link['js'][] = 'jquery';
$link['js'][] = 'script';
$link['js'][] = 'profile';
$link['js'][] = 'pswStrength';

page_meta();
page_nav('user');
if($state === 1)
	page_activate();
elseif($state === 2)
	page_resetpasswd();
else
	page_profile($badges, $badges_won, $num_orders, $stores);
page_footer();
page_close();


?>
