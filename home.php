<?php

/** turn on output buffering */
ob_start();

require './config.php';
require './inc/function.php';
require './inc/page.php';
require './inc/module.php';

session_name(SESSNAME);
session_start();

if($_SESSION['logged_in'] != true) {
	require 'inc/auth.php';
	cookie_auth();
	if($_SESSION['logged_in'] != true)
		err_redir('Please Login.');
}

$link['css'][] = 'style';
$link['css'][] = 'styleHome';
$link['js'][] = 'jquery';
$link['js'][] = 'scriptHome';

$tasks = array();
$stores = array();

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($mysqli->connect_error)
	err_redir("mysql connect error({$mysqli->connect_errno}).",'/error.php');
if (!$mysqli->set_charset("utf8"))
	err_redir("db error({$mysqli->errno}).", '/error.php');
$query = "select `id`, `pid`, `status`, `type`, `cost` from `order`
	where `uid` = {$_SESSION['uid']}";
if($result = $mysqli->query($query)) {
	while($row = $result->fetch_assoc())
		$tasks[$row['id']] = $row;
	$result->free();
}
$query = "select `id`, `name` from `partner`";
if($result = $mysqli->query($query)) {
	while($row = $result->fetch_assoc())
		$stores[$row['id']] = $row;
	$result->free();
}
$mysqli->close();

page_meta();
page_nav();
page_home($tasks, $stores);
page_footer();
page_close();

?>
