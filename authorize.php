<?php

include './config.php';
include DIR_INC . 'database.php';
include DIR_INC . 'function.php';

function verify_link_reset() {
	return (($_GET['v'] == md5(SALT_REG . $_GET['a'] . $_GET['t'])) && (date_diff(date_create('@' . $_GET['t']), date_create())->h < 4));
}
function verify_link_signup() {
	return ($_GET['v'] == md5(SALT_REG . $_GET['a']));
}
function verify_login_form() {
//	TODO validate input client-side with js
	$input = array();
	$input['email'] = strtolower($_POST['email']);
	$input['passwd'] = md5($_POST['passwd']);
	$input['pub'] = (isset($_POST['pub']) ? true : false);
	return $input;
}
function verify_signup_form() {
//	TODO validate input client-side with js
	$input = array();
	$input['email'] = $_SESSION['email'];
	$input['name'] = $_POST['name'];
	$input['passwd'] = md5($_POST['passwd']);
	return $input;
}

session_name(SESSNAME);
session_start();

if($_GET['c'] == 'login') {
	if(!($input = verify_login_form()))
		err_redir('Invalid Login Information.');
	$query = "select `id`, `passwd`, `name` from `user`
		where `email` = '{$db->real_escape_string($input['email'])}'";
	if(($result = $db->query($query)) && ($result->num_rows > 0)) {
		$user = $result->fetch_assoc();
		$result->free();
		$logged_in = ($user['passwd'] == $input['passwd']);
	} else
		$logged_in = false;
	if(!$logged_in)
		err_redir('login fail.');
	$query = "select `pocket`, `amount` from `credit`
		where `id` = {$user['id']}";
	if($result = $db->query($query)) {
		$credit = array();
		while($row = $result->fetch_assoc())
			$credit[$row['pocket']] = $row['amount'];
		$result->free();
	}
	$_SESSION['logged_in'] = true;
	$_SESSION['uid'] = $user['id'];
	$_SESSION['name'] = $user['name'];
	$_SESSION['email'] = $input['email'];
	$_SESSION['credit'] = $credit;
	if(!$input['pub']) {
		$expire = time()+3600*24*30;
		$stamp = date('YmdHis');
		setcookie('email', $input['email'], $expire);
		setcookie('uid', $user['id'], $expire);
		setcookie('stamp', $stamp, $expire);
		setcookie('hash', md5(date('Y-M-').$user['id'].$stamp), $expire);
	} else
		setcookie('email', '', time()-3600);
	err_redir('', '/home.php');
} elseif($_GET['c'] == 'logout') {
	setcookie('hash', '', time()-3600);
	setcookie('uid', '', time()-3600);
	setcookie('stamp', '', time()-3600);
	$_SESSION = array();
	session_destroy();
	err_redir();
} elseif($_GET['c'] == 'signup' && isset($_GET['a']) && isset($_GET['v'])) {
	if(!verify_link_signup())
		err_redir('invalid activation link.');
	$email = base64_decode($_GET['a']);
	if(user_exists($email))
		err_redir("email already activated. please login. ($email)");
	$_SESSION['email'] = $email;
	$_SESSION['state'] = 'activate';
	err_redir('Welcome!', '/profile.php');
} elseif($_GET['c'] == 'reset' && isset($_GET['a']) && isset($_GET['t']) && isset($_GET['v'])) {
	if(!verify_link_reset())
		err_redir('your password reset link has expired.');
	$email = base64_decode($_GET['a']);
	if(!user_exists($email))
		err_redir("user not found. ($email)");
	$_SESSION['email'] = $email;
	$_SESSION['state'] = 'resetpw';
	err_redir('', '/profile.php');
} elseif($_SESSION['state'] === 'activate') {
	if(!($input = verify_signup_form()))
		err_redir('invalid input', '/profile.php');
	$query = "insert into `user` values (
		default,
		'{$db->real_escape_string($input['email'])}',
		'{$input['passwd']}',
		'{$db->real_escape_string($input['name'])}',
		default
		)";
	if($db->query($query) !== TRUE)
		err_redir("db error({$db->errno}).", '/error.php');
	$uid = $db->insert_id;
	$query = "insert into `credit` values ($uid, 0, 50)";
	if($db->query($query) !== TRUE)
		err_redir("db error({$db->errno}).", '/error.php');
	unset($_SESSION['state']);
	$_SESSION['logged_in'] = true;
	$_SESSION['uid'] = $uid;
	$_SESSION['name'] = $input['name'];
	$_SESSION['credit'] = array(0 => 50);
	err_redir('Conguratuations, your account is activated.', '/home.php');
} elseif($_SESSION['state'] === 'resetpw') {
} else {
	err_redir();
}

?>
