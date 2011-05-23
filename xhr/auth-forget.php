<?php

include '../config.php';
include DIR_INC . 'database.php';
include DIR_INC . 'function.php';

/**
 * errno:
 * 0	no error
 * 1	invalid email addr
 * 2	database error
 * 3	user doesn't exist
 * 4	failed sending email
 */
//header('content-type: application/json');

function send_forget_mail($to) {
	$addr = base64_encode($to);
	$time = time();
	$hash = md5( SALT_REG . $addr . $time);
	$link = URL_BASE . "profile.php?c=signup&a=" . rawurlencode($addr). "&t=$time&v=$hash";
	$subject = CODE_NAME . ' - 密碼重置';
	$time = date('Y-m-d H:i:s');
	$body = <<<EOT
you requested to reset your passwd on $time .
click the link below to reset your password.
	
	$link

the link will expire in 2 hours.

Cheers,

photoncopy team

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

if(!($email = sanitize_email($_POST['email'])))
	die(json_encode(array('errno' => 1,)));

setcookie('email', $email, time()+3600*24*3);

if(!user_exists($email))
	die(json_encode(array('errno' => 3,)));

if(!send_forget_mail($email))
	die(json_encode(array('errno' => 4,)));

echo(json_encode(array('errno' => 0,)));


?>

