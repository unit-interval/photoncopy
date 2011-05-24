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
$link['js'][] = 'partner';

/** FIXME write partner pages */
if ($_GET['c'] == 'signup') {
	$link['css'][] = 'styleIndex';
	$link['css'][] = 'partnerLogin';
	$link['js'][] = 'scriptIndex';
	$state = 1;
} elseif($_GET['c'] == 'activate') {
} elseif($_GET['c'] == 'forget') {
} elseif($_SESSION['partner'] != true) {
	include './inc/auth.php';
	cookie_auth_par();
	if($_SESSION['partner'] !== true)
	err_redir('', '/partner.php?c=signup');
} elseif ($_GET['c'] == 'profile') {
} else {
	$orders = array();
	$query = "select * from `order` where `pid` = {$_SESSION['pid']}
		order by `id` desc";
	if($result = $db->query($query)) {
		while($row = $result->fetch_assoc())
		$orders[$row['id']] = $row;
		$result->free();
	}
	$link['css'][] = 'stylePartner';
	$link['js'][] = 'scriptPartner';
}

page_meta();
page_nav('partner');
if($state === 1)
	page_par_signup();
else
	page_par_home($orders);
page_footer();
page_close();


?>
