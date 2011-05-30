<?php

include './config.php';
include './inc/database.php';
include './inc/function.php';
include './inc/module.php';
include './inc/page.php';

session_name(SESSNAME_P);
session_start();

$link['css'][] = 'style';
$link['js'][] = 'jquery';
$link['js'][] = 'script';

/** FIXME write partner pages */
if ($_GET['c'] == 'signup') {
	$link['css'][] = 'styleIndex';
	$link['css'][] = 'partnerLogin';
	$link['js'][] = 'scriptIndex';
	$state = 1;
} elseif($_GET['c'] == 'activate') {
	$state = 2;
} elseif($_GET['c'] == 'forget') {
	$state = 3;
} elseif($_SESSION['partner'] != true) {
	include './inc/auth.php';
	cookie_auth_par();
	if($_SESSION['partner'] !== true)
	err_redir('', '/partner.php?c=signup');
} elseif ($_GET['c'] == 'profile') {
	$link['css'][] = 'styleProfile';
	$link['js'][] = 'partnerProfile';
	$state = 4;
	$users = array();
	$credit = array();
	$query = "select `uid`, count(`id`) as `num_orders` from `order`
		where `pid` = {$_SESSION['pid']} group by `uid`";
	if(!($result = $db->query($query)))
		err_redir("db error({$db->errno}). query:$query", '/error.php');
	while($row = $result->fetch_assoc())
		$users[$row['uid']] = $row;
	$result->free();
	$query_part = '';
	foreach(array_keys($users) as $id)
		$query_part .= " `id` = $id or";
	$query_part = substr($query_part1, 0, -3);
	$query = "select `id`, `name` from `user` where" . $query_part;
	if(!($result = $db->query($query)))
		err_redir("db error({$db->errno}). query:$query", '/error.php');
	while($row = $result->fetch_assoc())
		$user[$row['id']]['name'] = $row['name'];
	$result->free();
	$query = "select `uid`, `credit` from `credit` where `pid` = {$user['id']}";
	if(!($result = $db->query($query)))
		err_redir("db error({$db->errno}). query:$query", '/error.php');
	while($row = $result->fetch_assoc())
		$credit[$row['uid']] = $row['credit'];
	$result->free();
	$_SESSION['credit'] = $credit;
} else {
	$link['css'][] = 'stylePartner';
	$link['js'][] = 'partner';
	$link['js'][] = 'scriptPartner';
	$orders = array();
	$users = array();
	$credit = array();
	$query = "select * from `order` where `pid` = {$_SESSION['pid']}
		order by `id` desc";
	if(!($result = $db->query($query)))
		err_redir("db error({$db->errno}). query:$query", '/error.php');
	while($row = $result->fetch_assoc()) {
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
	if(!($result = $db->query($query)))
		err_redir("db error({$db->errno}). query:$query", '/error.php');
	while($row = $result->fetch_assoc())
		$users[$row['id']] = $row;
	$result->free();
	$query = "select `uid`, `credit` from `credit` where `pid` = 0 and (" . $query_part2 . ")";
	if(!($result = $db->query($query)))
		err_redir("db error({$db->errno}). query:$query", '/error.php');
	while($row = $result->fetch_assoc())
		$users[$row['uid']]['credit'] = $row['credit'];
	$result->free();
	$query = "select `uid`, `credit` from `credit` where `pid` = {$user['id']}";
	if(!($result = $db->query($query)))
		err_redir("db error({$db->errno}). query:$query", '/error.php');
	while($row = $result->fetch_assoc())
		$credit[$row['uid']] = $row['credit'];
	$result->free();
	$_SESSION['credit'] = $credit;
}

page_meta();
page_nav('partner');
if($state === 1)
	page_par_signup();
elseif($state === 4)
	page_par_profile($users);
else
	page_par_home($orders, $users);
page_footer();
page_close();


?>
