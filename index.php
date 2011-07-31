<?php

header('Location: http://huozr.com/');
die;

/** turn on output buffering */
ob_start();

include './config.php';
include './inc/function.php';
include './inc/module.php';
include './inc/page.php';

session_name(SESSNAME);
session_start();

/** don't log user in at index.php to reduce db requests
 *
if($_SESSION['logged_in'] != true) {
	include './inc/database.php';
	include './inc/auth.php';
	cookie_auth();
	if($_SESSION['logged_in'] == true)
	err_redir('', '/home.php');
}
 */

$link['css'][] = 'style';
$link['css'][] = 'styleIndex';
$link['js'][] = 'jquery';
$link['js'][] = 'script';
$link['js'][] = 'scriptIndex';

page_meta();
page_nav();
page_index();
page_footer();
page_close();


?>
