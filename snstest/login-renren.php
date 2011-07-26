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
	echo "email代用字符串：{$user['uid']}@user.renren.com<br/>用户名代用字符串：{$user['name']}<br/>";
}
?>
