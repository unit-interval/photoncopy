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
$link['css'][] = 'styleStore';
$link['js'][] = 'jquery';
$link['js'][] = 'script';
$link['js'][] = 'scriptStore';

if(!isset($_GET['id']))
err_redir('404','/home.php');

$id = intval($_GET['id']);
$query = "select `id`, `name`, `region`, `memo` from `partner`
	where `id` = $id";
if($result = $db->query($query)) {
	$store = $result->fetch_assoc();
	$result->free();
}

page_meta();
page_nav();
page_store($store);
page_footer();
page_close();

?>