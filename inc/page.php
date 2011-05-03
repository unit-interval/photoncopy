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
						d
					</li>

					<li>
						f						
					</li>
				</ul>			
			</div>
		</div>
	';
}
function page_home() {
	echo '<div class="contentWrapper"><div class="content">
		<p>i\'d love to see how this part is arranged.</p>
		</div></div>';
}
function page_index() {
	echo '
		<div class="contentWrapper">
			<div class="funct">
				<div id="login">
					<form action="/authorize.php?c=login" method="post">
						<fieldset>
							<div class="field">
								<label>邮箱</label>
								<input type="text" name="email" value="' . $_COOKIE['email'] . '" />
							</div>
							<div class="field">
								<label>密码</label>
								<input type="password" name="passwd" />
							</div>
						</fieldset>
						<fieldset class="submit">
							<input class="checkbox" type="checkbox" name="pub" value="yes" /><h3> 正在使用公共电脑登录</h3>
							<input class="submit" type="submit" value="登录" />
						</fieldset>
					</form>
				</div>
				<div id="signup">
					<form action="/authorize.php?c=reg" method="post">
						<fieldset>
							<div class="field">
								<label>邮箱</label>
								<input type="text" name="email" />
							</div>
						</fieldset>
						<fieldset class="submit">
							<input class="submit" type="submit" value="注册" />
						</fieldset>
					</form>
				</div>
				<div id="forget">
					<form action="/authorize.php?c=forget" method="post">
						<fieldset>
							<div class="field">
								<label>邮箱</label>
								<input type="text" name="email" value="' . $_COOKIE['email'] . '" />
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
	foreach($link['script'] as $v)
		echo "\t<script type='text/javascript'>{$v}\t</script>\n";
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
