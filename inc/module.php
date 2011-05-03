<?php

function mod_login() {
	if($_SESSION['logged_in'])
		return '
				<li><a href="home.php">Home</a></li>
				<li class="sep">
					<a href="profile.php">' . $_SESSION['name'] . '</a>

				</li>
				<li class="sep">
					<a href="authorize.php?c=logout">退出</a>
				</li>
		';
	else
		return '
				<li id="loginBtn">
					<span class="navBtn">登录</span>

				</li>
				<li id="signupBtn" class="sep navBtn">
					<span class="navBtn">注册</span>
				</li>
				<li id="forgetBtn" class="sep navBtn">
					<span class="navBtn">取回密码</span>
				</li>
		';
}
function mod_msg() {
	if($_SESSION['msg'] . 'x' != 'x') {
		$msg = "
			<div id=msgbox>{$_SESSION['msg']}</div>
			";
		unset($_SESSION['msg']);
		return $msg;
	}
}

