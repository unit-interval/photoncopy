<?php

/** turn on output buffering */
ob_start();

include './config.php';
include './inc/function.php';
include './inc/module.php';
include './inc/page.php';

session_name(SESSNAME);
session_start();

if($_SESSION['partner'] != true) {
	include 'inc/auth.php';
	partner_cookie_auth();
	if($_SESSION['partner'] !== true)
	err_redir('', '/partner.php?c=login');
}

$link['css'][] = 'style';

page_meta();

if($_GET['c'] == 'add')
page_par_add();
elseif($_GET['c'] == 'login')
page_par_login();
elseif ($_GET['c'] == 'setting')
page_par_setting();
else
page_par_home();

page_footer();
page_close();


?>
