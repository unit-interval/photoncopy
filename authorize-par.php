<?php

/** wrapper file for partner authorization
 * no output
 */

include './config.php';
include DIR_INC . 'database.php';
include DIR_INC . 'function.php';

session_name(SESSNAME_P);
session_start();

function handle_par_upload() {
//	TODO handle other upload errors.
	if($_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
		if(!move_uploaded_file($_FILES['avatar']['tmp_name'], DIR_UPLD_MEDIA . "partner/storeAvatar{$_SESSION['pid']}.jpg"))
			return false;
	} elseif($_FILES['avatar']['error'] === UPLOAD_ERR_NO_FILE) {
	} else
		return false;
	if($_FILES['photo']['error'] === UPLOAD_ERR_OK) {
		if(!move_uploaded_file($_FILES['photo']['tmp_name'], DIR_UPLD_MEDIA . "partner/storeView{$_SESSION['pid']}.jpg"))
			return false;
	} elseif($_FILES['photo']['error'] === UPLOAD_ERR_NO_FILE){
	} else
		return false;
	if($_FILES['map']['error'] === UPLOAD_ERR_OK) {
		if(!move_uploaded_file($_FILES['map']['tmp_name'], DIR_UPLD_MEDIA . "partner/storeMap{$_SESSION['pid']}.png"))
			return false;
	} elseif($_FILES['map']['error'] === UPLOAD_ERR_NO_FILE){
	} else
		return false;
	return true;
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
function verify_par_info_form() {
	$input = array();
	if($_POST['name'] != $_SESSION['name'])
		$input['name'] = strip_tags($_POST['name']);
	if($_POST['passphrase'] != '')
		$input['passphrase'] = strip_tags($_POST['passphrase']);
	return $input;
}
function verify_signup_form_par() {
//	TODO validate input client-side with js
	$input = array();
	$input['email'] = $_SESSION['email'];
	$input['location'] = intval($_POST['location']);
	$input['name'] = strip_tags($_POST['name']);
	$input['passwd'] = md5($_POST['passwd']);
	$input['passphrase'] = strip_tags($_POST['short']);
	$input['admin_email'] = strtolower($_POST['adminEmail']);
	$input['admin_passwd'] = md5($_POST['adminPasswd']);
	return $input;
}
function verify_update_password_form() {
//	TODO validate input client-side with js
	return md5($_POST['passwd']);
}

/**
 * possible requests:
 * 
 * if($_GET['c'] == 'signuppar' && isset($_GET['a']) && isset($_GET['v'])) {
 * } elseif($_GET['c'] == 'par_reset' && isset($_GET['a']) && isset($_GET['t']) && isset($_GET['v'])) {
 * } elseif($_GET['c'] == 'partnerlogin') {
 * } elseif($_GET['c'] == 'partnerlogout') {
 * } elseif ($_GET['c'] == 'update_par_memo') {
 * } elseif ($_GET['c'] == 'update_par_password') {
 * } elseif ($_GET['c'] == 'update_par_info') {
 * } elseif($_GET['c'] === 'activatepar') {
 * } elseif($_SESSION['state'] === 'par_resetpw') {
 * } else
 *
 */
if($_GET['c'] == 'signuppar' && isset($_GET['a']) && isset($_GET['v'])) {
	if(!verify_link_signup())
		err_redir('您访问的激活链接无效');
	$email = strtolower(base64_decode($_GET['a']));
	if(user_exists_par($email))
		err_redir("邮箱($email)已在光子复制注册，请直接登录", '/partner.php');
	$_SESSION['email'] = $email;
	$_SESSION['state'] = 'activate_par';
	err_redir('', '/partner.php');
} elseif($_GET['c'] == 'par_reset' && isset($_GET['a']) && isset($_GET['t']) && isset($_GET['v'])) {
	if(!verify_link_reset())
		err_redir('您的密码重置链接已失效');
	$par_email = strtolower(base64_decode($_GET['a']));
	if(($partner=user_exists_par($par_email))==false)
		err_redir("邮箱 $par_email 尚未注册", '/partner.php');
	$_SESSION['name'] = $partner['name'];
	$_SESSION['pid'] = $partner['id'];
	$_SESSION['email'] = $par_email;
	$_SESSION['location'] = $partner['location'];
	$_SESSION['state'] = 'par_resetpw';
	err_redir('', '/partner.php');
} elseif($_GET['c'] == 'partnerlogin') {
	if(!($input = verify_login_form()))
		err_redir('用户名或密码有误，请重新填写','/partner.php');
	$query = "select * from `partner`
		where `email` = '{$db->real_escape_string($input['email'])}'";
	if(($result = $db->query($query)) && ($result->num_rows > 0)) {
		$user = $result->fetch_assoc();
		$result->free();
		$logged_in = ($user['passwd'] == $input['passwd']);
	} else
		$logged_in = false;
	if(!$logged_in)
		err_redir('抱歉，登录失败','/partner.php');
	$_SESSION['partner'] = true;
	$_SESSION['pid'] = $user['id'];
	$_SESSION['passphrase'] = $user['passphrase'];
	$_SESSION['name'] = $user['name'];
	$_SESSION['location'] = $partner['location'];
	$_SESSION['memo'] = $user['memo'];
	$_SESSION['email'] = $input['email'];
	$expire = time()+3600*24*7;
	setcookie('email_p', $input['email'], $expire);
	setcookie('pid', $user['id'], $expire);
	setcookie('hash_p', md5(SALT_REG . $user['id']), $expire);
	err_redir('', '/partner.php');
} elseif($_GET['c'] == 'partnerlogout') {
	setcookie('hash_p', '', time()-3600);
	setcookie('pid', '', time()-3600);
	$_SESSION = array();
	session_destroy();
	err_redir();
} elseif ($_GET['c'] == 'update_par_memo') {
	session_name(SESSNAME_P);
	session_start();
	if($memo = (($_POST['memo'] == $_SESSION['memo']) ? false : $_POST['memo'])) {
		$memo = strip_tags($memo);
		$query = "update `partner` set `memo` = '" . $db->real_escape_string($memo) . "' where `id` = {$_SESSION['pid']}";
		if($db->query($query) !== TRUE)
			err_redir("db error({$db->errno}).", '/error.php');
		$_SESSION['memo'] = $memo;
	}
	err_redir('状态修改成功', '/partner.php');
} elseif ($_GET['c'] == 'update_par_password') {
	$input=verify_update_password_form();
	$query = "update `partner` set `passwd` = '" . $input . "' where `id` = {$_SESSION['pid']}";
	if($db->query($query) !== TRUE)
		err_redir("db error({$db->errno}).", '/error.php');
	err_redir('密码修改成功', '/partner.php?c=profile#1-2');
} elseif ($_GET['c'] == 'update_par_info') {
	if(count($input = verify_par_info_form()) > 0) {
		$query = "update `partner` set ";
		foreach($input as $k => $v) {
			$query .= "`$k` = '" . $db->real_escape_string($v) . "' , ";
			$_SESSION[$k] = $v;
		}
		$query = substr($query, 0, -2) . "where `id` = {$_SESSION['pid']}";
		if($db->query($query) !== TRUE)
			err_redir("db error({$db->errno}). >$query", '/error.php');
	}
	if(!handle_par_upload())
		err_redir('文件上传出错, 请重试.', '/partner.php?c=profile#1-1');
	err_redir('商铺基本设置修改成功', '/partner.php?c=profile#1-1');
} elseif($_GET['c'] === 'activatepar') {
	if(!($input = verify_signup_form_par()))
		err_redir('您提供的信息有误，请重新输入', '/partner.php');
	if($input['admin_email'] != '3.14159' || $input['admin_passwd'] != md5('95141.3'))
		err_redir('请在工作人员的陪同下完成账户激活.', '/partner.php');
	$query = "insert into `partner`
		(`email`, `location`, `passwd`, `passphrase`, `name`) values (
		'{$db->real_escape_string($input['email'])}',
		{$input['location']},
		'{$input['passwd']}',
		'{$db->real_escape_string($input['passphrase'])}',
		'{$db->real_escape_string($input['name'])}'
		)";
	if($db->query($query) !== TRUE)
		err_redir("db error({$db->errno}).", '/error.php');
	$pid = $db->insert_id;
	symlink("../../../media/images/storeAvatar-default.jpg", DIR_UPLD_MEDIA . "partner/storeAvatar{$pid}.jpg");
	symlink("../../../media/images/storeView-default.jpg", DIR_UPLD_MEDIA . "partner/storeView{$pid}.jpg");
	symlink("../../../media/images/storeView-default.jpg", DIR_UPLD_MEDIA . "partner/storeMap{$pid}.png");
	unset($_SESSION['state']);
	$_SESSION['partner'] = true;
	$_SESSION['pid'] = $pid;
	$_SESSION['passphrase'] = $input['passphrase'];
	$_SESSION['name'] = $input['name'];
	$_SESSION['location'] = $input['location'];
	$_SESSION['memo'] = '';
	$_SESSION['email'] = $input['email'];
	$expire = time()+3600*24*7;
	setcookie('email_p', $input['email'], $expire);
	setcookie('pid', $pid, $expire);
	setcookie('hash_p', md5(SALT_REG . $pid), $expire);
	err_redir('恭喜您已成功注册光子复制帐号', '/partner.php');
} elseif($_SESSION['state'] === 'par_resetpw') {
	$input=verify_update_password_form();
	$query = "update `partner` set `passwd` = '" . $input . "' where `id` = {$_SESSION['pid']}";
	if($db->query($query) !== TRUE)
		err_redir("db error({$db->errno}). query:$query", '/error.php');
	$query = "select * from `partner` where `id` = {$_SESSION['pid']}";
	if(!($result = $db->query($query)))
		err_redir("db error({$db->errno}). query:$query", '/error.php');
	$user = $result->fetch_assoc();
	$_SESSION['partner'] = true;
	$_SESSION['passphrase'] = $user['passphrase'];
	$_SESSION['location'] = $user['location'];
	$_SESSION['memo'] = $user['memo'];
	unset($_SESSION['state']);
	err_redir('恭喜您成功找回密码', '/partner.php');
} else {
	err_redir();
}

?>
