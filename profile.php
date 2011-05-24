<?php

/** turn on output buffering */
ob_start();

include './config.php';
include DIR_INC . 'database.php';
include DIR_INC . 'function.php';
include DIR_INC . 'module.php';
include DIR_INC . 'page.php';

session_name(SESSNAME);
session_start();

if($_SESSION['state'] === 'activate')
	$state = 1;
elseif($_SESSION['state'] === 'resetpw')
	$state = 2;
elseif($_SESSION['logged_in'] !== true)
	err_redir('', '/home.php');

$link['css'][] = 'style';
$link['css'][] = 'styleProfile';
$link['js'][] = 'jquery';
$link['js'][] = 'script';
$link['js'][] = 'profile';

page_meta();
page_nav('user');
if($state === 1)
	page_activate();
elseif($state === 2)
	page_resetpasswd();
else
	page_profile();
page_footer();
page_close();


?>
