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
if ($_SESSION['state'] === 'par_resetpw') {
	$link['css'][] = 'partnerProfile';
	$link['js'][] = 'partnerProfile';
	$state = 3;
}
elseif ($_GET['c'] == 'signup') {
	$link['css'][] = 'styleIndex';
	$link['css'][] = 'partnerLogin';
	$link['js'][] = 'partnerIndex';
	$state = 1;
} elseif($_GET['c'] == 'activate') {
	$link['css'][] = 'partnerProfile';
	$link['js'][] = 'partnerProfile';
	$state = 2;
} elseif($_SESSION['partner'] != true) {
	include './inc/auth.php';
	cookie_auth_par();
	if($_SESSION['partner'] !== true)
	err_redir('', '/partner.php?c=signup');
} elseif ($_GET['c'] == 'profile') {
	$link['css'][] = 'partnerProfile';
	$link['js'][] = 'partnerProfile';
	$state = 4;
} else {
	$orders = array();
	$users = array();
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
	$link['css'][] = 'stylePartner';
	$link['js'][] = 'partner';
	$link['js'][] = 'scriptPartner';
}

page_meta();
page_nav('partner');
switch ($state){
	case 1: page_par_signup(); break;
	case 2: page_par_activate(); break;
	case 3: page_resetpswd(); break;
	case 4: page_par_profile(); break;
	default: page_par_home($orders, $users); 
}
page_footer();
page_close();


?>
