<?php
/*
 * 本文件实现通过新浪微博帐号登陆的逻辑。 
 */
require_once 'connect-sina.php';
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
	echo "email代用字符串：{$me['id']}@user.weibo.com<br/>用户名代用字符串：{$me['name']}<br/>";
}

?>
