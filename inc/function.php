<?php

/** predefined error messages might be needed */
function err_redir($err = '', $tar = '/') {
	if($tar == '/error.php')
	$_SESSION['err'] = $err;
	else
	$_SESSION['msg'] = $err;
	header("Location: $tar");
	die;
}
function print_re($v) {
	echo "<pre>\n";
	var_dump($v);
	echo "</pre>";
	die;
}
function sanitize_email($m) {
//	TODO write the actual check later.
	$m = strtolower($m);
	return $m;
}
function text_defs($key, $all = false) {
	$t = array(
		'order_action' => array(
			0 => "订单处在队列中，您仍可以<a href='#'>撤销订单</a>",
			1 => '订单已成功撤销',
			2 => '文件正在打印中',
			3 => "由于担保积分不足或订单要求不明确等原因，您需要到打印店自助打印，或者<a href='#'>撤销订单</a>",
			4 => '文件已打印完成，请您前往打印店领取',
			5 => '订单已完成，可前往积分页面查看积分变动历史',
		),
		'order_back' => array(
			1 => '單面',
			2 => '雙面',
		),
		'order_color' => array(
			1 => '黑白',
			2 => '彩色',
		),
		'order_layout' => array(
			1 => '1x1版',
			2 => '2x1版',
			3 => '2x2版',
			4 => '2x3版',
			5 => '2x4版',
			6 => '3x3版',
			7 => '3x4版',
		),
		'order_misc' => array(
			1 => '无装订',
			2 => '简易装订',
			3 => '侧边装订',
			4 => '添加封面',
		),
		'order_page' => array(
			1 => '1-10页',
			2 => '10-50页',
			3 => '50-200页',
			4 => '200-500页',
			5 => '500-1000页',
			6 => '1000页以上',
		),
		'order_paper' => array(
			1 => 'A4',
			2 => 'B5',
		),
		'order_type' => array(
			0 => 'PDF文档',
			1 => 'WORD文档',
			2 => 'PPT幻灯片',
			3 => '其他文檔',
		),
		'order_status' => array(
			0 => '队列中',
			1 => '成功徹消',
			2 => '正在打印',
			3 => '自助打印',
			4 => '完成待取',
			5 => '任務完成',
			'open' => array(0, 2, 4),
		),
		'order_status_par' => array(
			0 => '新任務',
			1 => false, //已撤銷
			2 => '已接受',
			3 => false, //已拒絕
			4 => '等待領取',
			5 => false, //付款完成
		),
		'store_region' => array(
			0 => '北京大學',
		),
	);
	return $all ? $t : $t[$key];
}
function text_queue_action_par($st = -1, $id = 0) {
	$support = array(
		0 => array(0, 1),
		2 => array(2),
		4 => array(3),
	);
	if($id === 0)
		return ($st === -1) ? $support : $support[$st];
	$actions = array(
		0 => "接受",
		1 => "拒絕",
		2 => '完成任務',
		3 => '結帳付款',
	);
	$html = '';
	foreach($support[$st] as $a) {
		$html .= "<a>" . $actions[$a] . "</a><input type='hidden' name='act' value='$a' /> / ";
	}
	$html = substr($html, 0, -3);
	return $html;
}
function to_status_par($act = -1) {
	$to = array(
		0 => 2,
		1 => 3,
		2 => 4,
		3 => 5,
		4 => 7,
	);
	return ($act === -1) ? $to : $to[$act];
}
function verify_login_form() {
	/** validate input client-side with js */
	$input = array();
	$input['email'] = strtolower($_POST['email']);
	$input['passwd'] = md5($_POST['passwd']);
	$input['pub'] = (isset($_POST['pub']) ? true : false);
	return $input;
}

