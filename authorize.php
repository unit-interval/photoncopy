<?php

include './config.php';
include './inc/function.php';

function send_reg_mail($to) {
	$addr = base64_encode($to);
	$hash = md5( SALT_REG . $addr );
	$link = URL_BASE . "profile.php?n=" . rawurlencode($addr). "&v=$hash";
	$subject = 'photoncopy - '.CODE_NAME.' - activate your account';
	$body = <<<EOT
To continue your registration, click the link below, plz.
	
	$link

photoncopy is blahblah.
and this mail will be beautified with html.

Cheers,

photoncopy admin

=-=-=
中文字符測試
=-=-=

EOT;
	$header = "Content-type: text/plain; charset=utf-8\r\n";
	$header .= "From: " . CODE_NAME . " <noreply-reg@" .
	SERVER_HOST . ">\r\n";
	$header .= "Reply-To: " . CODE_NAME . " <noreply-reg@" .
	SERVER_HOST . ">\r\n";
	return mail($to, $subject, $body, $header);
}
function verify_email($m) {
	// write the actual check later.
	return true;
}


session_name(SESSNAME);
session_start();

if($_GET['c'] == 'login') {
	if(!($input = verify_login_form()))
	err_redir('Invalid Login Information.');
	include_once './inc/database.php';
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
	exit;
} elseif($_GET['c'] == 'logout') {
	setcookie('hash', '', time()-3600);
	setcookie('uid', '', time()-3600);
	setcookie('stamp', '', time()-3600);
	$_SESSION = array();
	session_destroy();
	err_redir();
} elseif($_GET['c'] == 'reg') {
	$email = strtolower($_POST['email']);
	if(!verify_email($email))
	err_redir('invalid email addr.');
	send_reg_mail($email);
	setcookie('email', $email, time()+3600*24*3);
	err_redir('email sent.');
} elseif($_GET['c'] == 'forget') {

} elseif($_GET['c'] == 'reset') {

} else {
	err_redir();
}

?>
