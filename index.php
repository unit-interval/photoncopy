<?php

/** turn on output buffering */
ob_start();

require './config.php';
require './inc/function.php';
require './inc/module.php';
require './inc/page.php';

session_name(SESSNAME);
session_start();

if($_SESSION['logged_in'] != true) {
	require 'inc/auth.php';
	cookie_auth();
	if($_SESSION['logged_in'] == true)
		err_redir('', '/home.php');
}

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
