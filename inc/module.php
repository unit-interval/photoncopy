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
					<a href='/home.php'>首页</a>
				</li>
				<li class='sep'>
					<a href='http://blog.photoncopy.com/'>黑板报</a>
				</li>
			</ul>
		";
	elseif ($_SESSION['partner'])
	return "
			<ul class='account'>
				<li>
					<a href='/partner/profile.php'>" . $_SESSION['name'] . "的帐户</a>
				</li>
				<li class='sep'>
					<a href='/partner.php?c=logout'>退出</a>
				</li>
			</ul>
			<ul class='navBar'>
				<li>
					<a href='/partner.php'>首页</a>
				</li>
				<li class='sep'>
					<a href='http://blog.photoncopy.com/'>黑板报</a>
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
					<a href='http://blog.photoncopy.com/'>黑板报</a>
				</li>
			</ul>
		";
}
function mod_order_queue($orders) {
	$html = '';
	foreach($orders as $o)
		$html .= unit_order($o);
	return $html;
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
		$credit = ($_SESSION['credit'][$s['id']] ? $_SESSION['credit'][$s['id']]/100 : 0);
		$html = "
						<div class='w2item'> 
							<div class='storeItemAvatar'> 
								<img height='100%' width='100%' src='/media/images/store/storeAvatar{$s['id']}.jpg' /> 
							</div> 
							<div class='storeItemInfo'> 
								<input type='button' class='uiBtn1' value='查看详情' />
								<div class='storeId'>{$s['id']}</div>
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
function unit_order($order) {
	$t = text_defs('', true);
	$open = " order_open";
	$class = (in_array($order['status'], $t['order_status']['open'])) ? $open : '';
	$flink = ($order['flink'] === '-') ? $order['fname'] : "<a href='/upload/{$order['flink']}' target='_blank'>{$order['fname']}</a>";
	$html = "
						<div class='taskItem $class'>
							<h3 class='newly_added'>{$order['fname']} @ {$order['ptext']}<span class='taskStatus taskStatus{$order['status']}'>{$t['order_status'][$order['status']]}</span></h3>
							<div class='taskDetail'>
		    					<table>
		    						<tr><th>订单编号</th><td>{$order['id']}</td></tr>
		    						<tr><th>打印文件</th><td>$flink</a></tr>
		    						<tr><th>打印店</th><td><a href='#'>{$order['ptext']}</a></td></tr>
		    						<tr><th>订单要求</th><td>{$t['order_paper'][$order['paper']]} {$t['order_color'][$order['color']]} {$t['order_back'][$order['back']]} {$t['order_layout'][$order['layout']]} {$t['order_page'][$order['page']]} {$order['copy']} {$t['order_misc'][$order['misc']]}</td></tr>
		    						<tr><th>客户留言</th><td>{$order['note']}</td></tr>
		    						<tr><th>订单操作</th><td>{$t['order_action'][$order['status']]}</td></tr>
		    					</table>
								<input type='hidden' name='id' value='{$order['id']}' />
								<input type='hidden' name='pid' value='{$order['pid']}' />
								<input type='hidden' name='status' value='{$order['status']}' />
								<input type='hidden' name='paper' value='{$order['paper']}' />
								<input type='hidden' name='color' value='{$order['color']}' />
								<input type='hidden' name='back' value='{$order['back']}' />
								<input type='hidden' name='layout' value='{$order['layout']}' />
								<input type='hidden' name='page' value='{$order['page']}' />
								<input type='hidden' name='copy' value='{$order['copy']}' />
								<input type='hidden' name='misc' value='{$order['misc']}' />
								<input type='hidden' name='fname' value='{$order['fname']}' />
								<input type='hidden' name='ptext' value='{$order['ptext']}' />
		    				</div>
	    				</div>";
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
					<tr class='newly_added'>
						<td>{$order['id']}</td>
						<td>{$order['pid']}/{$t1[$order['type']]}</td>
						<td>{$t2[$order['paper']]} {$t3[$order['double']]} {$order['page']}頁</td>
						<td>{$order['note']}</td>
						<td>$link</td>
						<td>{$t4[$order['status']]}</td>
						<td>".text_queue_action_par($order['status'],$order['id'])."</td>
						<input type='hidden' name='oid' value={$order['id']} />
					</tr>
	";
	return $html;
}

