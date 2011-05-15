<?php

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
	err_redir('Please Login.');
}

$link['css'][] = 'style';
$link['css'][] = 'styleHome';
$link['js'][] = 'jquery';
$link['js'][] = 'jquery-ui';
$link['js'][] = 'jquery.scrollTo';
$link['js'][] = 'scriptHome';
$link['js'][] = 'home';

$orders = array();
$stores = array();

$query = "select * from `order` where `uid` = {$_SESSION['uid']}
	order by `id` desc";
if($result = $db->query($query)) {
	while($row = $result->fetch_assoc())
	$orders[$row['id']] = $row;
	$result->free();
}
$query = "select `id`, `name`, `region`, `memo` from `partner`";
if($result = $db->query($query)) {
	while($row = $result->fetch_assoc())
	$stores[$row['id']] = $row;
	$result->free();
}

page_meta();
page_nav();
page_home($orders, $stores);
page_footer();
page_close();

?>
