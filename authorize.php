<?php

/**
 * wapper file for user authorizaion
 * no output
 */

include './config.php';
include DIR_INC . 'database.php';
include DIR_INC . 'function.php';

session_name(SESSNAME);
session_start();

function send_confirm_email(){
	$addr = base64_encode($_SESSION['email']);
	$subject = CODE_NAME . ' - 欢迎来到光子复制';
	$body = "
		<table width='650' align='center' style='color: #444; margin: 30px auto; font-size: 14px; font-family: 'Microsoft Yahei',Tahoma,Arial,Helvetica,STHeiti; box-shadow: 0 0 10px gray; border-radius: 4px; -moz-border-radius: 4px; -webkit-border-radius: 4px; overflow: hidden' cellpadding='0' cellspacing='0'>
			<tr id='header'>
				<td height='102' background='http://photoncopy.com/media/images/email/header_bg.png' bgcolor='#E6F1FB' align='center'>
					<table width='95%'>
						<tr>
							<td align='left'>
								<img src='http://photoncopy.com/media/images/email/email_logo.png' />
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr id='content'>
				<td bgcolor='#F4FAFF' align='center'>
					<table width='95%' cellpadding='30'>
						<tr>
							<td align='left'>
								{$_SESSION['name']} ，您好，<br />
								<br />
								欢迎来到光子复制，光子复制为您提供如下服务：<br />
								<br />
								<table width='100%'>
									<tr>
										<td width='20'></td>
										<td>
											<font size='+1' color='#1F75CC'>让文印服务更便捷</font>
											<br />
											<img style='float: left; margin: 10px' width='64px' height='64px' src='http://photoncopy.com/media/images/email/paper_plane.png' alt='paper plane'>
											<br />还记得在打印店焦急等待的时光吗？还记得无数遗忘在打印店的U盘吗？还记得怀揣一把钢镚时的尴尬吗？时代在变，现在只需在线提交打印订单，行走间一切已经完成。<a style='color: #1F75CC; text-decoration: none' href='http://photoncopy.com/blog/tutorial' target='_blank'>想了解更多？</a>
										</td>
									</tr>
									<tr>
										<td width='20'></td>
										<td>
											<font size='+1' color='#1F75CC'>让用户体验更完美</font>
											<br />
											<img style='float: left; margin: 10px' width='64px' width='64px' height='64px' src='http://photoncopy.com/media/images/email/chrome.png' alt='google chrome'>
											<br />光子复制采用现代的互联网语言编写，为了让您获得更好的用户体验。
											<br />在此我们推荐您使用Google Chrome浏览器（<a style='color: #1F75CC; text-decoration: none' href='http://www.google.com/chrome' target='_blank'>了解 Google Chrome</a>）。
											<br />我们推荐IE深度用户使用360极速浏览器（<a style='color: #1F75CC; text-decoration: none' href='http://chrome.360.cn/' target='_blank'>了解 360极速</a>）。
										</td>
									</tr>
									<tr>
										<td width='20'></td>
										<td>
											<font size='+1' color='#1F75CC'>一切都是免费的</font>
											<br />
											<img style='float: left; margin: 10px' width='64px' width='64px' height='64px' src='http://photoncopy.com/media/images/email/free.png' alt='free'>
											<br />由于网站创始人都是大学生，所以光子复制可能是最了解您需求的。
											<br />本着服务大学生的想法，您得到的一切服务都将是免费的。
											<br />在此我们期望您能<a style='color: #1F75CC; text-decoration: none' href='http://photoncopy.com/blog/about' target='_blank'>加入我们</a>，贡献一份力量。
										</td>
									</tr>
								</table><br />想了解更多光子复制的相关讯息？请来<a style='color: #1F75CC; text-decoration: none' href='http://photoncopy.com/blog' target='_blank'>黑板报</a>看看。<br />
								<br />
								光子复制团队 敬上<br />
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
";
	$header = "Content-type: text/html; charset=utf-8\r\n";
	$header .= "From: " . CODE_NAME . " <service@" .
	SERVER_HOST . ">\r\n";
	$header .= "Reply-To: " . CODE_NAME . " <service@" .
	SERVER_HOST . ">\r\n";
	return mail($to, $subject, $body, $header);
}
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
	$input['name'] = strip_tags($_POST['name']);
	$input['location'] = intval($_POST['location']);
	$input['passwd'] = md5($_POST['passwd']);
	return $input;
}
function verify_update_location_form() {
//	TODO validate input client-side with js
	return intval($_POST['location']);
}
function verify_update_name_form() {
//	TODO validate input client-side with js
	$name=strip_tags($_POST['name']);
	if ($name == '') return false;
	return $name;
}
function verify_update_password_form() {
//	TODO validate input client-side with js
	return md5($_POST['passwd']);
}

/**
 * if($_GET['c'] == 'login') {
 * } elseif($_GET['c'] == 'logout') {
 * } elseif($_GET['c'] == 'signup' && isset($_GET['a']) && isset($_GET['v'])) {
 * } elseif($_GET['c'] == 'reset' && isset($_GET['a']) && isset($_GET['t']) && isset($_GET['v'])) {
 * } elseif($_GET['c'] == 'update-name'){
 * } elseif($_GET['c'] == 'update-password'){
 * } elseif($_SESSION['state'] === 'activate') {
 * } elseif($_SESSION['state'] === 'resetpw') {
 * } else
 */
if($_GET['c'] == 'login') {
	if(!($input = verify_login_form()))
		err_redir('邮箱或密码输入有误，请重新登录');
	$query = "select * from `user`
		where `email` = '{$db->real_escape_string($input['email'])}'";
	if(($result = $db->query($query)) && ($result->num_rows > 0)) {
		$user = $result->fetch_assoc();
		$result->free();
		$logged_in = ($user['passwd'] == $input['passwd']);
	} else
		$logged_in = false;
	if(!$logged_in)
		err_redir('登录失败，邮箱未被注册或用户名密码有误，请重新登录');
	$_SESSION['logged_in'] = true;
	$_SESSION['uid'] = $user['id'];
	$_SESSION['name'] = $user['name'];
	$_SESSION['email'] = $input['email'];
	$_SESSION['location'] = $user['location'];
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
		err_redir('您访问的激活链接无效');
	$email = strtolower(base64_decode($_GET['a']));
	if(user_exists($email))
		err_redir("邮箱($email)已在光子复制注册，请直接登录");
	$_SESSION['email'] = $email;
	$_SESSION['state'] = 'activate';
	err_redir('', '/profile.php');
} elseif($_GET['c'] == 'reset' && isset($_GET['a']) && isset($_GET['t']) && isset($_GET['v'])) {
	if(!verify_link_reset())
		err_redir('您的密码重置链接已失效');
	$email = strtolower(base64_decode($_GET['a']));
	if(($user=user_exists($email))==false)
		err_redir("邮箱 $email 尚未注册");
	$_SESSION['name'] = $user['name'];
	$_SESSION['uid'] = $user['id'];
	$_SESSION['location'] = $user['location'];
	$_SESSION['email'] = $email;
	$_SESSION['state'] = 'resetpw';
	err_redir('', '/profile.php');
} elseif($_GET['c'] == 'update-name'){
	if (!($input=verify_update_name_form()))
		err_redir('用户名格式有误', '/profile.php');
	$query = "update `user` set `name` = '" . $db->real_escape_string($input) . "' where `id` = {$_SESSION['uid']}";
	if($db->query($query) !== TRUE)
		err_redir("db error({$db->errno}).", '/error.php');
	$_SESSION['name'] = $db->real_escape_string($input);
	err_redir('用户信息更新成功', '/profile.php#1-1');
	if (!($input=verify_update_location_form()))
		err_redir('更新服务地区失败', '/profile.php');
	$query = "update `user` set `location` = '$input'
	   where `id` = {$_SESSION['uid']}";
	if($db->query($query) !== TRUE)
		err_redir("db error({$db->errno}).", '/error.php');
	$_SESSION['location'] = $input;
	err_redir('用户信息更新成功', '/profile.php#1-1');
} elseif($_GET['c'] == 'update-password'){
	$input=verify_update_password_form();
	$query = "update `user` set `passwd` = '" . $input . "' where `id` = {$_SESSION['uid']}";
	if($db->query($query) !== TRUE)
		err_redir("db error({$db->errno}).", '/error.php');
	err_redir('密码修改成功', '/profile.php#1-2');	
} elseif($_SESSION['state'] === 'activate') {
	if(!($input = verify_signup_form()))
		err_redir('您提供的信息有误，请重新输入', '/profile.php');
	$query = "insert into `user`
		(`email`, `name`, `passwd`, `location`) values (
		'{$db->real_escape_string($input['email'])}',
		'{$db->real_escape_string($input['name'])}',
		'{$input['passwd']}',
		{$input['location']}
		)";
	if($db->query($query) !== TRUE)
		err_redir("db error({$db->errno}).", '/error.php');
	$uid = $db->insert_id;
	$query = "insert into `credit` values ($uid, 0, 10)";
	if($db->query($query) !== TRUE)
		err_redir("db error({$db->errno}).", '/error.php');
	unset($_SESSION['state']);
	$_SESSION['logged_in'] = true;
	$_SESSION['uid'] = $uid;
	$_SESSION['name'] = $input['name'];
	$_SESSION['location'] = $input['location'];
	send_confirm_email();
	err_redir('恭喜您已成功注册光子复制帐号', '/home.php');
} elseif($_SESSION['state'] === 'resetpw') {
	$input=verify_update_password_form();
	$query = "update `user` set `passwd` = '" . $input . "' where `id` = {$_SESSION['uid']}";
	if($db->query($query) !== TRUE)
		err_redir("db error({$db->errno}). query:$query", '/error.php');
	unset($_SESSION['state']);
	err_redir('恭喜您成功找回密码', '/home.php');
} else {
	err_redir();
}

?>
