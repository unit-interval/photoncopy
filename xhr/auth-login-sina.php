<?php
/*
 * 本文件实现通过新浪微博帐号登陆的逻辑。 
 */

ini_set( "DISPLAY_ERRORS ",   "1 "); 
error_reporting(E_ALL); 

#include '../config.php';
#include DIR_INC . 'database.php';
#include DIR_INC . 'function.php';
require_once '../inc/oauth/connect-sina.php';
#session_name(SESSNAME);
session_start();

if($_GET['c']=='login' ) {
	$o = new WeiboOAuth( WB_AKEY , WB_SKEY  );
	$sinakeys = $o->getRequestToken();
	$_SESSION['sinakeys'] = $sinakeys;
	$aurl = $o->getAuthorizeURL( $sinakeys['oauth_token'] ,false , WB_CB );
	header("Location: $aurl");
}else{
	$o = new WeiboOAuth( WB_AKEY , WB_SKEY , $_SESSION['sinakeys']['oauth_token'] , $_SESSION['sinakeys']['oauth_token_secret']  );
	$sinatoken = $o->getAccessToken(  $_REQUEST['oauth_verifier'] ) ;	
	$_SESSION['sinatoken'] = $sinatoken;
	$c = new WeiboClient( WB_AKEY , WB_SKEY , $_SESSION['sinatoken']['oauth_token'] , $_SESSION['sinatoken']['oauth_token_secret']  );
	$me = $c->verify_credentials();
	
	$email="{$me['id']}@user.weibo.com";
	$sns_name="{$me['name']}"
	if(user_exists($email))
		err_redir("$sns_name，欢迎回来！");
	echo "email代用字符串：{$email}<br/>用户名代用字符串：{$sns_name}<br/>";
	$_SESSION['email'] = $email;
	$_SESSION['sns_name'] = $sns_name;
	$_SESSION['state'] = 'activate';
	echo "<a href='/profile.php'>验证成功－进入“初次设置”</a>";

}

?>
