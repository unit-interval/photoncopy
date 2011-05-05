<?php

/** turn on output buffering */
ob_start();

include './config.php';
include './inc/database.php';
include './inc/function.php';
include './inc/module.php';
include './inc/page.php';

session_name(SESSNAME_P);
session_start();

if($_SESSION['partner'] != true) {
	include './inc/auth.php';
	partner_cookie_auth();
	if($_SESSION['partner'] !== true)
	err_redir('', '/partner.php?c=login');
}

$link['css'][] = 'style';
$link['css'][] = 'stylePartner';
$link['js'][] = 'query';
$link['js'][] = 'script';

page_meta();
page_nav();

/** FIXME write partner pages */
if($_GET['c'] == 'activate')
page_par_act();
elseif($_GET['c'] == 'login')
page_par_login();
elseif($_GET['c'] == 'logout')
page_par_logout();
elseif ($_GET['c'] == 'profile')
page_par_profile();
elseif ($_GET['c'] == 'reg')
page_par_reg();
else
page_par_home();

page_footer();
page_close();


?>
