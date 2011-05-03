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

page_meta();
page_nav();
page_home();
page_footer();
page_close();

?>
