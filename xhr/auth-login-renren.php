<?php
/*
 * 本文件实现通过人人帐号登陆的逻辑。 
 */


require_once 'connect-renren.php';

$oauth = new RenRenOauth();
$token = $oauth->getAccessToken($_GET['code']);
$key = $oauth->getSessionKey($token['access_token']);

$client = new RenRenClient();
$client->setSessionKey($key['renren_token']['session_key']);

$users=$client->POST('users.getInfo','uid,name');
foreach($users as $user) {
	$email="{$user['uid']}@user.renren.com";
	$sns_name="{$user['name']}"
}
	if(user_exists($email))
		err_redir("$sns_name，欢迎回来！");
	echo "email代用字符串：{$email}<br/>用户名代用字符串：{$sns_name}<br/>";
	$_SESSION['email'] = $email;
	$_SESSION['sns_name'] = $sns_name;
	$_SESSION['state'] = 'activate';
	echo "<a href='/profile.php'>验证成功－进入“初次设置”</a>";
?>
