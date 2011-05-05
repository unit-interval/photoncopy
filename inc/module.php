<?php

function mod_login() {
	if($_SESSION['logged_in'])
	return '
				<li><a href="home.php">首页</a></li>
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
function mod_stores($stores) {
	$html = '';
	foreach($stores as $s) {
		$html .= "
			<a href='/store.php?id={$s['id']}'>
				<div class='storeItem'>
				{$s['name']}<br />
					零錢罐: {$_SESSION['credit'][$s['id']]}
				</div>
			</a>
		";
	}
	return $html;
}
function mod_tasks($tasks, $stores) {
	include_once './inc/text-defs.php';
	$i = 0;
	$html = '';
	foreach($tasks as $t)
	$html .= "
			<li><div class='taskItem' id='task". $i++ ."'>
				编号: {$t['id']}<br />
				类型: {$text_order_type[$t['type']]}<br />
				状态: {$text_order_status[$t['status']]}<br />
				店铺: {$stores[$t['pid']]['name']}<br />
				金額: {$t['cost']}<br />
			</div></li>
		";
	while($i < 2)
	$html .= "
			<li><div class='taskItem' id='task". $i++ ."'>
				编号: <br />
				类型: <br />
				状态: <br />
				店铺: <br />
				金額: <br />
			</div></li>
		";
	return $html;
}

