<?php

function page_close() {
	echo '</body></html>';
}
function page_footer() {
	echo '
		<div class="footerWrapper">
			<div class="footer">
				<ul class="fd">
					<li>
						<a href="/static/">static</a>
					</li>
|
					<li>
						<a href="/partner.php">partner</a>						
					</li>
				</ul>			
			</div>
		</div>
	';
}
function page_home($tasks, $stores) {
	echo "<div class='contentWrapper'>
			<div class='panel profile'>
				<dl class='profileItem'>
					<dt>PDF文档</dt>
					<dd><span class='value'>0</span> RMB</dd>
				</dl>
				<dl class='profileItem'>
					<dt>WORD文档</dt>
					<dd><span class='value'>0</span> RMB</dd>
				</dl>
				<dl class='profileItem'>
					<dt>PPT幻灯片</dt>
					<dd><span class='value'>0</span> RMB</dd>
				</dl>
				<dl class='profileItem' id='green'>
					<dt>双面打印</dt>
					<dd><span class='value'>0</span> RMB</dd>
				</dl>
				<a href='credit/index.php'>
					<dl class='profileItem rtCorner rbCorner' id='creditPlus'>
						<dd><span class='value'>+</span></dd>
					</dl>
				</a>
				<dl class='profileItem' id='credit'>
					<dt>信用额度</dt>
					<dd><span class='value'>{$_SESSION['credit'][0]}</span> RMB</dd>
				</dl>
			</div>
			<div class='panel task'>
				<h2>任务</h2>
				<div class='lbCorner' id='leftBtn'>&lt</div>
				<ul class='itemWrapper'>"
	. mod_tasks($tasks, $stores) .
				"
				</ul>
				<div id='rightBtn' class='rbCorner'>&gt</div>
				<div class='clear'></div>
			</div>
			<div class='panel store'>
				<h2>请选择打印店</h2>
				<p>网络: 北京大学 | <a>查看地圖</a></p>
				<div id='storeList'>"
				. mod_stores($stores) .
				"
					<div class='clear'></div>
				</div>
			</div>
		</div>		
		";
}
function page_index() {
	echo '
		<div class="contentWrapper">
			<div class="funct">
				<div id="login" class="panel">
					<h2>登录</h2>
					<form action="/authorize.php?c=login" method="post">
						<fieldset>
							<div class="field">
								<label>邮箱</label>
								<input type="text" name="email" value="'
								. $_COOKIE['email'] .
								'" title="请输入邮箱地址" class="autoHint" />
							</div>
							<div class="field">
								<label>密码</label>
								<input type="password" name="passwd" />
							</div>
						</fieldset>
						<fieldset class="submit">
							<input class="checkbox" type="checkbox" name="pub" value="yes" />
							<h3> 正在使用公共电脑登录</h3>
							<input class="submit" type="submit" value="登录" />
						</fieldset>
					</form>
				</div>
				<div id="signup" class="panel">
					<h2>注册</h2>
					<form action="/authorize.php?c=reg" method="post">
						<fieldset>
							<div class="field">
								<label>邮箱</label>
								<input type="text" name="email" title="请输入邮箱地址" class="autoHint" />
							</div>
						</fieldset>
						<fieldset class="submit">
							<input class="submit" type="submit" value="注册" />
						</fieldset>
					</form>
				</div>
				<div id="forget" class="panel">
					<h2>取回密码</h2>
					<form action="/authorize.php?c=forget" method="post">
						<fieldset>
							<div class="field">
								<label>邮箱</label>
								<input type="text" name="email" value="'
								. $_COOKIE['email'] .
								'" title="请输入邮箱地址" class="autoHint" />
							</div>
						</fieldset>
						<fieldset class="submit">
							<input class="submit" type="submit" value="取回密码" />
						</fieldset>
					</form>
				</div>
			</div>
			<div class="content">
				<div id="instruct">
					<p>Step 1: blablabla</p>
					<p>Step 2: blablabla</p>
				</div>
				<div id="stat">
					<p>*** users have signed up.</p>
					<p>*** orders have been made.</p>
				</div>
			</div>
		</div>
	';
}
function page_meta() {
	global $link;
	echo '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="zh" xml:lang="zh">
<head>
	<meta name="description" content="xxx" />
	<meta name="keywords" content="print" />
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<meta http-equiv="content-language" content="zh-CN" />
	<title>' . CODE_NAME . '</title>
	';
	foreach($link['css'] as $v)
	echo "\t<link rel='stylesheet' type='text/css' href='./media/css/$v.css' />\n";
	foreach($link['js'] as $v)
	echo "\t<script type='text/javascript' src='./media/js/$v.js'></script>\n";
	echo <<<EOT
</head>
<body>
EOT;
}
function page_nav() {
	// and error msg
	echo '
		<div class="nav">
			<div id="logo">
				<a href="/">光子复制</a>
			</div>
			<ul class="account">
	' . mod_login() . '
			</ul>
		</div>
	' . mod_msg();
}
function page_profile() {
	echo "<div class='contentWrapper'><div class='content'>
		<p>displays user profile.</p>
		<form><fieldset><div class='field'>
			<label>邮箱</label>
			<input type='text' name='email' disabled='disabled' value='{$_SESSION['email']}' />
			<input type='hidden' name='email-' value='{$_SESSION['email']}' />
			<label>用戶名</label>
			<input type='text' name='name' value='{$_SESSION['name']}'/>
			<input type='hidden' name='name-' value='{$_SESSION['name']}'/>
			<label>密码</label>
			<input type='password' name='passwd' />
			<label>密码確認</label>
			<input type='password' name='passwd-confirm' />
		</div></fieldset><fieldset class='submit'>
			<input class='submit' type='reset' value='重置' />
			<input class='submit' type='submit' value='提交' />
		</fieldset></form>
		</div></div>";
}
function page_reg($m) {
	echo "<div class='contentWrapper'><div class='content'>
		<p>displays reg form.</p>
		<form action='/profile.php' method='post'>
			<fieldset><div class='field'>
				<label>邮箱</label>
				<input type='text' name='email' readonly='readonly' value='$m' />
				<label>用戶名</label>
				<input type='text' name='name' />
				<label>密码</label>
				<input type='password' name='passwd' />
				<label>密码確認</label>
				<input type='password' name='passwd-confirm' />
			</div></fieldset><fieldset class='submit'>
				<input class='submit' type='submit' value='提交' />
			</fieldset></form>
		</div></div>";
}
?>
