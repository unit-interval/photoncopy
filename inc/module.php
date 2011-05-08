<?php

function mod_login($a = '/authorize') {
	$pubCheck = "<input class='checkbox' type='checkbox' name='pub' value='yes' />
							<h3> 正在使用公共电脑登录</h3>";
	$pubCheck = (($a === '/authorize') ? $pubCheck : '');
	return "
				<div id='login' class='panel'>
					<h2>登录</h2>
					<form action='{$a}.php?c=login' method='post'>
						<fieldset>
							<div class='field'>
								<label>邮箱</label>
								<input type='text' name='email' value='"
								. (($a === '/authorize') ? $_COOKIE['email'] : $_COOKIE['email_p']) .
								"' title='请输入邮箱地址' class='uiText autoHint' />
							</div>
							<div class='field'>
								<label>密码</label>
								<input type='password' name='passwd' class='uiText' />
							</div>
						</fieldset>
						<fieldset class='submit'>
							$pubCheck
							<input class='uiBtn submit' type='submit' value='登录' />
						</fieldset>
					</form>
				</div>
	";
}
function mod_login_forget($a = '/authorize') {
	return "
				<div id='forget' class='panel'>
					<h2>取回密码</h2>
					<form action='{$a}.php?c=forget' method='post'>
						<fieldset>
							<div class='field'>
								<label>邮箱</label>
								<input type='text' name='email' value='"
								. (($a === '/authorize') ? $_COOKIE['email'] : $_COOKIE['email_p']) .
								"' title='请输入邮箱地址' class='uiText autoHint' />
							</div>
						</fieldset>
						<fieldset class='submit'>
							<input class='uiBtn submit' type='submit' value='取回密码' />
						</fieldset>
					</form>
				</div>
	";
}
function mod_login_signup ($a = '/authorize') {
	return "
				<div id='signup' class='panel'>
					<h2>注册</h2>
					<form action='{$a}.php?c=reg' method='post'>
						<fieldset>
							<div class='field'>
								<label>邮箱</label>
								<input type='text' name='email' title='请输入邮箱地址' class='uiText autoHint' />
							</div>
						</fieldset>
						<fieldset class='submit'>
							<input class='uiBtn submit' type='submit' value='注册' />
						</fieldset>
					</form>
				</div>
	";
}
function mod_map() {
	return "<iframe width='100%' height='480' frameborder='0' scrolling='no' marginheight='0' marginwidth='0' src='http://maps.google.com/?ie=UTF8&amp;hq=&amp;ll=39.864289,116.378515&amp;spn=0.005765,0.00912&amp;z=16&amp;output=embed'></iframe>";
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
function mod_nav_account() {
	if($_SESSION['logged_in'])
	return '
				<li><a href="/home.php">首页</a></li>
				<li class="sep">
					<a href="/profile.php">' . $_SESSION['name'] . '</a>
				</li>
				<li class="sep">
					<a href="/authorize.php?c=logout">退出</a>
				</li>
		';
	elseif ($_SESSION['partner'])
	return '
				<li><a href="/partner.php">操作面板</a></li>
				<li class="sep">
					<a href="/partner.php?c=profile">賬戶信息</a>
				</li>
				<li class="sep">
					<a href="/partner.php?c=logout">退出</a>
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
function mod_order_queue_proc($orders) {
	$th = "
						<tr>
							<th width='50px'>编号</th>
							<th width='50px'>类型</th>
							<th width='200px'>要求</th>
							<th>留言</th>
							<th width='50px'>下载</th>
							<th width='50px'>状态</th>
							<th width='50px'>操作</th>
						</tr>";
	$html = "
					<thead>$th
					</thead><tfoot>$th
					</tfoot><tbody id='order_list'>";
	foreach ($orders as $o)
		$html .= unit_order_par($o);
	$html .= "</tbody>";
	return $html;
}
function mod_store_sel($stores) {
	$t1 = text_defs('store_region');
	$i = 0;
	$html_l = '';
	$html_r = '';
	foreach($stores as $s) {
		$credit = ($_SESSION['credit'][$s['id']] ? $_SESSION['credit'][$s['id']] : 0);
		$html = "
								<div class='storeItem'>
									<input type='hidden' name='pId' value='{$s['id']}' />
									<div class='storeItemAvatar'>
										<img height='100%' width='100%' src='../images/store/storeAvatar1.jpg' /> 
									</div>
									<div class='storeItemInfo'>
										<a href='store.php?id={$s['id']}'><input type='button' class='uiBtn1' value='查看详情' /></a>
										<h2>{$t1[$s['region']]}{$s['name']}</h2>
										<p>{$s['memo']}</p>
										<p>余额: $credit 元</p>
									</div>
								</div>";
		if($i%2 === 0)
			$html_l .= $html;
		else
			$html_r .= $html;
		$i++;
	}
	$html = "
							<div class='storeListL'>"
	  					 	. $html_l . "
							</div><div class='storeListR'>"
							. $html_r . "
							</div>";
	return $html;
}
function mod_stores($stores) {
	$t1 = text_defs('store_region');
	$html = '';
	foreach($stores as $s) {
		$credit = ($_SESSION['credit'][$s['id']] ? $_SESSION['credit'][$s['id']] : 0);
		$html .= "
					<div class='storeItem'>
						<div class='storeItemAvatar'>
							<img height='100%' width='100%' src='/media/images/store/storeAvatar1.jpg' /> 
						</div>
						<div class='storeItemInfo'>
							<a href='store.php?id={$s['id']}'><input type='button' class='uiBtn1' value='去这里打印' /></a>
							<h2>{$t1[$s['region']]}{$s['name']}</h2>
							<p>{$s['memo']}</p>
							<p>余额: $credit 元</p>
						</div>
					</div>
		";
	}
	return $html;
}
function mod_taskqueue($tasks, $stores) {
	$html = '
						<tr>
							<th>编号</th>
							<th>店铺</th>
							<th>状态</th>
							<th>费用估计</th>
							<th>操作</th>
						</tr>';
	foreach($tasks as $t)
		$html .= unit_order($t, $stores[$t['pid']]);
	return $html;
}
function mod_tasks($tasks, $stores) {
	$t1 = text_defs('order_type');
	$t2 = text_defs('order_status');
	$html = '';
	foreach($tasks as $t)
	$html .= "
			<div class='taskItem'>
				编号: {$t['id']}<br />
				类型: {$t1[$t['type']]}<br />
				状态: {$t2[$t['status']]}<br />
				店铺: {$stores[$t['pid']]['name']}<br />
				金額: {$t['cost']}<br />
			</div>
		";
	return $html;
}
/** TODO store storename in order as a order attr. */
function unit_order($order, $store) {
	$t1 = text_defs('order_type');
	$t2 = text_defs('order_status');
	$open = " class='order_open'";
	if(in_array($order['status'], $t2['open'])) {
		$cl = $open;
		$st = "<a>{$t2[$order['status']]}</a>";
	} else {
		$cl = '';
		$st = "{$t2[$order['status']]}";
	}
	$html = "
					<tr$cl>
						<td>{$order['id']}</td>
						<td>{$store['name']}</td>
						<td>{$t1[$order['type']]}</td>
						<td>$st</td>
						<td>".text_queue_action($order['status'],$order['id'])."</td>
						<input type='hidden' name='status' value='{$order['status']}' />
					</tr>";
	return $html;
}
function unit_order_par($order) {
	$t1 = text_defs('order_type');
	$t2 = text_defs('order_paper');
	$t3 = text_defs('order_double');
	$t4 = text_defs('order_status_par');
	if(!$t4[$order['status']])
		return '';
	if($order['fname'] == '-')
	$link = '過期';
	else
	$link = "<a target='_blank' href='/upload/" . rawurlencode($order['fname']) . "'>{$order['copy']}份</a>";
	$html = "
					<tr><td>{$order['id']}</td>
						<td>{$order['pid']}/{$t1[$order['type']]}</td>
						<td>{$t2[$order['paper']]} {$t3[$order['double']]} {$order['page']}頁</td>
						<td>{$order['note']}</td>
						<td>$link</td>
						<td>{$t4[$order['status']]}</td>
						<td>".text_queue_action_par($order['status'],$order['id'])."</td>
					</tr>
	";
	return $html;
}

