<?php

/** site landing page */

/** turn on output buffering */
ob_start();

/** load global configurations */
include './config.php';
/** basic dependencies */
include './inc/function.php';
include './inc/module.php';
include './inc/page.php';

/** prepare session cookie */
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

/** list the external scripts to be loaded */
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
