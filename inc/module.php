<?php
function mod_badge_rest($badges, $badges_won) {
	foreach($badges_won as $b)
		unset($badges[$b['bid']]);
	if(count($badges) == 0)
		return "您已获得网站测试阶段的所有徽章，正式上线后将开启隐藏成就，敬请期待。";
	$html = '';
	foreach($badges as $b)
		$html .= "
			<tr><th><div class='badge'><span class='badge{$b['type']}'></span>{$b['name']}</div> × {$b['count']}</th>
			<td>{$b['desc']}{$b['hint']}</td></tr>";
	return $html;
}
function mod_badge_summary($badges, $badges_won) {
	if(!$badges_won)
		return "您得到的徽章将显示在此。";
	$html = '';
	foreach($badges_won as $b)
		$html .= "<div class='badge'><span class='badge{$badges[$b['bid']]['type']}'></span>{$badges[$b['bid']]['name']}</div>";
	return $html;
}
function mod_badge_won($badges, $badges_won) {
	if(!$badges_won)
		return "您得到的徽章将显示在此。";
	$html = '';
	foreach($badges_won as $b)
		$html .= "
			<tr><th><div class='badge'><span class='badge{$badges[$b['bid']]['type']}'></span>{$badges[$b['bid']]['name']}</div> × {$badges[$b['bid']]['count']}</th>
			<td>{$badges[$b['bid']]['desc']}</td></tr>";
	return $html;
}
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
function mod_nav_account($body_id) {
	if($body_id != 'partner' && $_SESSION['logged_in'])
	return "
			<ul class='account'>
				<li>
					<a href='/profile.php'>" . $_SESSION['name'] . "的帐户</a>
				</li>
				<li class='sep'>
					<a href='/authorize.php?c=logout'>退出</a>
				</li>
			</ul>
			<ul class='navBar'>
				<li>
					<a href='/home.php'>示波器</a>
				</li>
				<li class='sep'>
					<a href='http://photoncopy.com/blog/'>黑板报</a>
				</li>
			</ul>
		";
	elseif ($body_id == 'partner' && $_SESSION['partner'])
	return "
			<ul class='account'>
				<li>
					<a href='/partner.php?c=profile'>" . $_SESSION['name'] . "的帐户</a>
				</li>
				<li class='sep'>
					<a href='/authorize-par.php?c=partnerlogout'>退出</a>
				</li>
			</ul>
			<ul class='navBar'>
				<li>
					<a href='/partner.php'>工作台</a>
				</li>
			</ul>
		";
	else
	return "
			<ul class='account'>
				<li id='loginBtn'>
					登录
				</li>
			</ul>
			<ul class='navBar'>
				<li>
					<a href='http://photoncopy.com/blog/'>黑板报</a>
				</li>
			</ul>
		";
}
function mod_notif() {
	$m = count($_SESSION['msg']);
	$n = count($_SESSION['notif']);
	$html = "
		<div id='dummyNotification'></div>
		<div id='notificationWrapper'>
			<div id='notification'>
				<span id='notificationCount'>". ($n + $m) ."</span>";
	while($m > 0) {
		$html .= "
				<div class='notificationContent' data-id='0'>"
				. array_shift($_SESSION['msg']) ."</div>";
		$m--;
	}
	if($n > 0)
		foreach($_SESSION['notif'] as $id => $msg)
			$html .= "
				<div class='notificationContent' data-id='$id'>$msg</div>";
	$html .= "
				<span id='notificationClose'>×</span>
			</div>
		</div>";
	return $html;
}
function mod_order_queue($orders) {
	$html = '';
	foreach($orders as $o) {
		$html .= unit_order($o, $s);
	}
	return $html;
}
function mod_order_queue_par($orders, $users) {
	$html = "";
	foreach ($orders as $o) {
		$u = $users[$o['uid']];
		$html .= unit_order_par($o, $u);
	}
	return $html;
}
function mod_pocket_list($stores) {
	if(count($_SESSION['credit']) == 1)
		return "<p>这里将显示您打印过文档的打印店内存储的零钱，目前您尚未在任何打印店打印过文档。</p>";
	$html = '';
	foreach($_SESSION['credit'] as $k => $v) {
		if($k == 0) continue;
		$v = $v / 10;
		$html .= "
			<div class='coin'>
				<div>
					<img src='/media/images/store/storeAvatar$k.jpg' alt='Store Avatar' />
				</div>
				<dl>
					<dt> {$stores[$k]['name']} </dt>
					<dd> {$v} 元</dd>
				</dl>
			</div>";
	}
	return $html;
}
function mod_stat_credit($num_orders, $stores) {
	if(!$num_orders)
		return '<p>这里将显示您在各个打印店的消费概要，目前您尚未在任何打印店打印过文档。</p>';
	$html =	"		<table class='statTable'>
						<tbody>
							<tr><th>商户</th><th>余额</th><th>订单</th></tr>";
	foreach($num_orders as $k => $v)
		$html .= "
			<tr><td> {$stores[$k]['name']} </td><td>" . ($_SESSION['credit'][$k] / 10) . " 元</td><td>$v 笔</td></tr>";
	$html .= "			</tbody>
					</table>";
	return $html;
}
function mod_stat_par($users) {
	$i = 0;
	$sum_credit = 0;
	$sum_orders = 0;
	$html = '';
	foreach($users as $u) {
		$credit = $_SESSION['credit'][$u['uid']] / 10;
		$sum_credit += $credit;
		$sum_orders += $u['num_orders'];
		$html .= "
								<tr>
									<td>" . ++ $i . "</td><td>{$u['name']}</td><td>" . $credit . " 元</td><td>{$u['num_orders']} 笔</td>
								</tr>";
	}
	$html = "
					<div class='profileHeader'>储蓄概要</div>
					<div class='profileContent'>
						<table class='statTable'>
							<tbody>
								<tr>
									<th>编号</th><th>用户名</th><th>储蓄</th><th>订单</th>
								</tr>
								<tr>
									<th>汇总</th><th>共 $i 位用户</th><th>$sum_credit 元</th><th>$sum_orders 笔</th>
								</tr>
								$html
							</tbody>
						</table>
					</div>";
	return $html;
}
function mod_store_sel($stores) {
	$t1 = text_defs('store_region');
	$i = 0;
	$html_l = '';
	$html_r = '';
	$needle = array("\r\n", "\n", "\r");
	foreach($stores as $s) {
		$credit = ($_SESSION['credit'][$s['id']] ? $_SESSION['credit'][$s['id']] / 10 : 0);
		$html = "
						<div class='w2item'> 
							<div class='storeItemAvatar'> 
								<img height='100%' width='100%' src='/media/images/store/storeAvatar{$s['id']}.jpg' /> 
							</div> 
							<div class='storeItemInfo'> 
								<input type='button' class='uiBtn1' value='查看详情' />
								<div class='storeId'>{$s['id']}</div>
								<h2>{$t1[$s['region']]}{$s['name']}</h2>
								<p>" . nl2br($s['memo']) . "</p>
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
					<div class='storeL'>"
	  			 	. $html_l . "
					</div><div class='storeR'>"
					. $html_r . "
					</div>
					<div class='clear'></div>";
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
function submod_order_action($st) {
	$action = array(
		0 => "<input type='button' class='uiBtn3' data-form='0' data-to='2' value='接受訂單' /> / <input type='button' class='uiBtn3' data-form='0' data-to='3' value='轉爲自助打印' /> 请下载文件并核对打印要求.",
		1 => "订单已被用户撤销，撤销的订单将保留一天.",
		2 => "<input type='button' class='uiBtn3' data-form='0' data-to='4' value='完成訂單' /> 並通知用戶前來領取.",
		3 => "<input type='button' class='uiBtn3' data-form='1' data-to='5' value='确认付款' />",
		4 => "<input type='button' class='uiBtn3' data-form='1' data-to='5' value='确认付款' />",
		5 => "订单已完成，完成的订单将保留一天.",
	);
	if($st == 4 || $st ==3)
		$form = "
			    					<tr><th>应收金额</th><td><input type='text' class='uiText2' placeholder='请输入应收金额' name='cost' /> 元</td></tr>
			    					<tr><th>实收金额</th><td><input type='text' class='uiText2' placeholder='请输入实收金额' name='paid' /> 元</td></tr>";
	$html = $form . "
			    					<tr><th>订单操作</th><td>{$action[$st]}</td></tr>";
	return $html;
}
function submod_order_action_par($st, $flink) {
	switch ($st) {
		case 1: case 5: return '';
		case 4: case 3: 
					$form = "
			    					<tr><th>应收金额</th><td><input type='text' class='uiText2' placeholder='请输入应收金额' name='cost' /> 元</td></tr>
			    					<tr><th>实收金额</th><td><input type='text' class='uiText2' placeholder='请输入实收金额' name='paid' /> 元</td></tr>";
	}
	$action = array(
		0 => "<input type='button' class='uiBtn3' data-form='0' data-to='2' value='接受订单' /><input type='button' class='uiBtn3' data-form='0' data-to='3' value='自助打印' />",
		2 => "<input type='button' class='uiBtn3' data-form='0' data-to='4' value='通知领取' />",
		3 => "<input type='button' class='uiBtn3' data-form='1' data-to='5' value='确认付款' />",
		4 => "<input type='button' class='uiBtn3' data-form='1' data-to='5' value='确认付款' />",
	);
	$html = $form . "
			    					<tr><th>订单操作</th><td>{$flink}{$action[$st]}</td></tr>";
	return $html;
}
function unit_order($order) {
	$t = text_defs();
	$open = " order_open";
	$class = (in_array($order['status'], $t['order_status']['open'])) ? $open : '';
	$fname = (mb_strlen($order['fname']) < 30) ? $order['fname'] : (mb_substr($order['fname'], 0, 29) . '...');
	$flink = ($order['flink'] === '-') ? "$fname（文件已过期）" : "<a href='/upload/" . rawurlencode($order['flink']) ."' target='_blank'>$fname</a>";
	$cost = ($order['cost'] == null) ? '' : " | 应付金额 : " . ($order['cost'] / 10) . " 元";
	$paid = ($order['paid'] == null) ? '' : " | 实付金额 : " . ($order['paid'] / 10) . " 元";
	$html = "
						<div class='taskItem$class'>
							<h3 class='newly_added'>订单 {$order['id']} $fname 在 <span class='newly_added' data-name='name'></span><span class='taskStatus taskStatus{$order['status']}'>{$t['order_status'][$order['status']]}</span></h3>
							<div class='taskDetail' data-id='{$order['id']}' data-pid='{$order['pid']}' data-status='{$order['status']}' data-paper='{$order['paper']}' data-color='{$order['color']}' data-back='{$order['back']}' data-layout='{$order['layout']}' data-copy='{$order['copy']}' data-misc='{$order['misc']}' data-fname='$fname'>
		    					<table>
		    						<tr><th>打印文件</th><td>$flink</tr>
		    						<tr><th>打印店</th><td><span class='showStoreInLightbox'><span class='newly_added' data-name='region'></span><span class='newly_added' data-name='name'></span></span></td></tr>
		    						<tr><th>订单要求</th><td>{$t['order_paper'][$order['paper']]}－{$t['order_color'][$order['color']]}－{$t['order_back'][$order['back']]}－{$t['order_layout'][$order['layout']]}－{$order['copy']}份－{$t['order_misc'][$order['misc']]}</td></tr>
		    						<tr><th>客户留言</th><td>{$order['note']}</td></tr>
		    						<tr><th>订单操作</th><td>{$t['order_action'][$order['status']]}" . $cost . $paid . "</td></tr>
		    					</table>
								<input type='hidden' name='id' value='{$order['id']}' />
								<input type='hidden' name='pid' value='{$order['pid']}' />
								<input type='hidden' name='status' value='{$order['status']}' />
								<input type='hidden' name='paper' value='{$order['paper']}' />
								<input type='hidden' name='color' value='{$order['color']}' />
								<input type='hidden' name='back' value='{$order['back']}' />
								<input type='hidden' name='layout' value='{$order['layout']}' />
								<input type='hidden' name='copy' value='{$order['copy']}' />
								<input type='hidden' name='misc' value='{$order['misc']}' />
								<input type='hidden' name='fname' value='{$order['fname']}' />
		    				</div>
	    				</div>";
	return $html;
}
function unit_order_par($order, $user) {
	$t1 = text_defs('order_action');
	$t2 = text_defs('order_back');
	$t3 = text_defs('order_color');
	$t4 = text_defs('order_layout');
	$t5 = text_defs('order_misc');
	$t6 = text_defs('order_paper');
	$t7 = text_defs('order_status_par');
	$fname = (mb_strlen($order['fname']) < 30) ? $order['fname'] : (mb_substr($order['fname'], 0, 29) . '...');
	$flink = ($order['flink'] === '-') ? "" : "<a href='" MIRROR_PKUAIR . urlencode($order['flink']) ."' target='_blank'><input type='button' class='uiBtn3' value='电信/网通线路'></a><a href='/upload/" . rawurlencode($order['flink']) ."' target='_blank'><input type='button' class='uiBtn3' value='教育网线路'></a>";
	$credit = ($_SESSION['credit'][$user['id']] ? ($_SESSION['credit'][$user['id']] / 10) : 0);
	$html = "
							<div class='taskItem newly_added' data-id='{$order['id']}'>
								<h3>订单 {$order['id']} $fname 来自 用户 {$order['uid']} {$user['name']}<span class='taskStatus taskStatus{$order['status']}'>{$t7[$order['status']]}</span></h3>
								<div class='taskDetail' data-id='{$order['id']}'>
			    				<table>
			    					<tr><th>订单要求</th><td>{$t6[$order['paper']]}－{$t3[$order['color']]}－{$t2[$order['back']]}－{$t4[$order['layout']]}－{$order['copy']}份－{$t5[$order['misc']]}</td></tr>
			    					<tr><th>客户信息</th><td>余额 $credit 元，信用 {$user['credit']}</td></tr>";
	if ($order['note'] != '') $html .= "
									<tr><th>客户留言</th><td>{$order['note']}</td></tr>";
	$html .= 
									submod_order_action_par($order['status'], $flink) . "
			    				</tbody></table>
			    				</div>
		    				</div>";
	return $html;
}

