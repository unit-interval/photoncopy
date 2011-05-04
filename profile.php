<?php

/** turn on output buffering */
ob_start();

require './config.php';
require './inc/function.php';
require './inc/module.php';
require './inc/page.php';

$input = array();

function user_exists($u) {
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	if ($mysqli->connect_error)
		err_redir("mysql connect error({$mysqli->connect_errno}).",'/error.php');
	if (!$mysqli->set_charset("utf8"))
		err_redir("db error({$mysqli->errno}).", '/error.php');
	$query = "select `id` from `user`
		where `email` = '{$mysqli->real_escape_string($u)}'";
	if(!($result = $mysqli->query($query)))
		err_redir("db error({$mysqli->errno}).", '/error.php');
	$found = ($result->num_rows > 0);
	$result->free();
	$mysqli->close();
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
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	if ($mysqli->connect_error)
		err_redir("mysql connect error({$mysqli->connect_errno}).",'/error.php');
	if (!$mysqli->set_charset("utf8"))
		err_redir("db error({$mysqli->errno}).", '/error.php');
	$query = "insert into `user` values (
		default,
		'{$mysqli->real_escape_string($_SESSION['email'])}',
		'".md5($input['passwd'])."',
		'{$input['name']}',
		default
		)";
	if($mysqli->query($query) !== TRUE)
		err_redir("db error({$mysqli->errno}).", '/error.php');
	$uid = $mysqli->insert_id;
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
		$email = rawurldecode(base64_decode($_GET['n']));
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
