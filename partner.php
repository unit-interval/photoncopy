<?php

include './config.php';
include './inc/database.php';
include './inc/function.php';
include './inc/module.php';
include './inc/page.php';

session_name(SESSNAME_P);
session_start();

$noLogin = array('activate','forget','login','reg','signup');

if($_SESSION['partner'] != true && !in_array($_GET['c'], $noLogin)) {
	include './inc/auth.php';
	cookie_auth_par();
	if($_SESSION['partner'] !== true)
	err_redir('', '/partner.php?c=signup');
}

$link['css'][] = 'style';
$link['css'][] = 'styleIndex';
$link['css'][] = 'stylePartner';
$link['js'][] = 'jquery';
$link['js'][] = 'partner';
$link['js'][] = 'script';
$link['js'][] = 'scriptIndex';
$link['js'][] = 'scriptPartner';


page_meta();
page_nav('partner');

/** FIXME write partner pages */
if($_GET['c'] == 'activate') {
} elseif($_GET['c'] == 'forget') {
} elseif($_GET['c'] == 'login') {
	if(!($input = verify_login_form()))
	err_redir('Invalid Login Information.','/partner.php');
	$query = "select `id`, `passwd`,`passphrase`, `name`, `region`, `memo` from `partner`
		where `email` = '{$db->real_escape_string($input['email'])}'";
	if(($result = $db->query($query)) && ($result->num_rows > 0)) {
		$user = $result->fetch_assoc();
		$result->free();
		$logged_in = ($user['passwd'] == $input['passwd']);
	} else
	$logged_in = false;
	if(!$logged_in)
	err_redir('login fail.','/partner.php');
	$_SESSION['partner'] = true;
	$_SESSION['pid'] = $user['id'];
	$_SESSION['passphrase'] = $user['passphrase'];
	$_SESSION['name'] = $user['name'];
	$_SESSION['region'] = $user['region'];
	$_SESSION['memo'] = $user['memo'];
	$_SESSION['email'] = $input['email'];
	$expire = time()+3600*24*7;
	setcookie('email_p', $input['email'], $expire);
	setcookie('pid', $user['id'], $expire);
	setcookie('hash_p', md5(SALT_REG . $user['id']), $expire);
	err_redir('', '/partner.php');
} elseif($_GET['c'] == 'logout') {
	setcookie('hash_p', '', time()-3600);
	setcookie('pid', '', time()-3600);
	$_SESSION = array();
	session_destroy();
	err_redir();
} elseif ($_GET['c'] == 'profile') {
} elseif ($_GET['c'] == 'reg') {
} elseif ($_GET['c'] == 'signup') {
	page_par_signup();
} else {
	$orders = array();
	$query = "select * from `order` where `pid` = {$_SESSION['pid']}
		order by `id` desc";
	if($result = $db->query($query)) {
		while($row = $result->fetch_assoc())
		$orders[$row['id']] = $row;
		$result->free();
	}
	page_par_home($orders);
}

page_footer();
page_close();


?>
