<?php

/** turn on output buffering */
ob_start();

include './config.php';
include './inc/function.php';
include './inc/module.php';
include './inc/page.php';

$input = array();

function user_exists($u) {
	global $db;
	$query = "select `id` from `user`
		where `email` = '{$db->real_escape_string($u)}'";
	if(!($result = $db->query($query)))
	err_redir("db error({$db->errno}).", '/error.php');
	$found = ($result->num_rows > 0);
	$result->free();
	return $found;
}
function verify_pro_form() {
	global $input;
	$input['name'] = $_POST['name'];
	$input['passwd'] = $_POST['passwd'];
	return true;
}
function verify_link() {
	return ($_GET['v'] == md5(SALT_REG . $_GET['n']));
}

session_name(SESSNAME);
session_start();

if($_SESSION['state'] === 'activating') {
	$_SESSION['state'] = 'reg';
	if(!verify_pro_form())
	err_redir('error occured', '/profile.php');
	include_once './inc/database.php';
	$query = "insert into `user` values (
		default,
		'{$db->real_escape_string($_SESSION['email'])}',
		'".md5($input['passwd'])."',
		'{$input['name']}',
		default
		)";
	if($db->query($query) !== TRUE)
	err_redir("db error({$db->errno}).", '/error.php');
	$uid = $db->insert_id;
	$query = "insert into `credit` values ($uid, 0, 0.5)";
	$_SESSION['logged_in'] = true;
	$_SESSION['uid'] = $uid;
	$_SESSION['name'] = $input['name'];
	unset($_SESSION['state']);
	err_redir('Congura-, your account is activated.', '/home.php');
}

if($_SESSION['logged_in'] !== true) {
	if(isset($_GET['n']) && isset($_GET['v'])) {
		if(!verify_link())
		err_redir('invalid activation link.');
		$email = base64_decode($_GET['n']);
		include_once './inc/database.php';
		if(user_exists($email))
		err_redir('email already activated. please login.');
		$_SESSION['email'] = $email;
		$_SESSION['state'] = 'activating';
		$reg = true;
	} elseif($_SESSION['state'] === 'reg') {
		$_SESSION['state'] = 'activating';
		$email = $_SESSION['email'];
		$reg = true;
	} else
	err_redir();
}

/** handle profile update here in the future */

$link['css'][] = 'style';

page_meta();
page_nav();
($reg === true) ? page_reg($email) : page_profile();
page_footer();
page_close();


?>
