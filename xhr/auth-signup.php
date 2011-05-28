<?php

include '../config.php';
include DIR_INC . 'database.php';
include DIR_INC . 'function.php';

/**
 * errno:
 * 0	no error
 * 1	invalid email addr
 * 2	database error
 * 3	user exists
 * 4	failed sending email
 */
//header('content-type: application/json');

function send_reg_mail($to) {
	$addr = base64_encode($to);
	$hash = md5( SALT_REG . $addr );
	$link = URL_BASE . "authorize.php?c=signup&a=" . rawurlencode($addr). "&v=$hash";
	$subject = CODE_NAME . ' - 注册确认函';
	$body = <<<EOT
		<table width="650" align="center" style="color: #444; margin: 30px auto; font-size: 14px; font-family: 'Microsoft Yahei',Tahoma,Arial,Helvetica,STHeiti; box-shadow: 0 0 10px gray; border-radius: 4px; -moz-border-radius: 4px; -webkit-border-radius: 4px; overflow: hidden" cellpadding="0" cellspacing="0">
			<tbody><tr id="header">
				<td height="102" background="/media/images/email/header_bg.png" bgcolor="#E6F1FB" align="center">
					<table width="95%">
						<tbody><tr>
							<td align="left">
								<img src="http://photoncopy.com/media/images/email/email_logo.png">
							</td>
						</tr>
					</tbody></table>
				</td>
			</tr>
			<tr id="content">
				<td bgcolor="#F4FAFF" align="center">
					<table width="95%" cellpadding="30">
						<tbody><tr>
							<td align="left">
								您好，<br>
								<br>
								感谢您注册光子复制，请点击确认<a style="color: #1F75CC; text-decoration: none" href="$link" target="_blank">绑定邮箱</a>。
								<br><br><font size="-1" color="gray">如果链接无效，请将以下链接复制到浏览器地址栏访问：<br>$link</font>
								<br>
								<br>
								光子复制团队 敬上<br>
							</td>
						</tr>
					</tbody></table>
				</td>
			</tr>
		</tbody></table>	
EOT;
	$header = "Content-type: text/html; charset=utf-8\r\n";
	$header .= "From: " . CODE_NAME . " <noreply-reg@" .
	SERVER_HOST . ">\r\n";
	$header .= "Reply-To: " . CODE_NAME . " <noreply-reg@" .
	SERVER_HOST . ">\r\n";
	return mail($to, $subject, $body, $header);
}

if(!($email = sanitize_email($_POST['email'])))
	die(json_encode(array('errno' => 1,)));

setcookie('email', $email, time()+3600*24*3);

if(user_exists($email))
	die(json_encode(array('errno' => 3,)));

if(!send_reg_mail($email))
	die(json_encode(array('errno' => 4,)));

echo(json_encode(array('errno' => 0,)));


?>
