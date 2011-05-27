<?php

/** predefined error messages might be needed */
function err_redir($err = '', $tar = '/') {
	if($tar == '/error.php')
		$_SESSION['err'] = $err;
	elseif($err != '')
		$_SESSION['msg'][] = $err;
	header("Location: $tar");
	die;
}
function json_encode_mb($ob, $options = 0) {
	return preg_replace("#\\\u([0-9a-f]+)#ie", "iconv('UCS-2', 'UTF-8', pack('H4', '\\1'))", json_encode($ob, $options));
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
function text_defs($key = '') {
	$t = array(
		'order_action' => array(
			0 => "订单处在队列中，您仍可以<a class='cancel-order'>撤销订单</a>",
			1 => '订单已成功撤销',
			2 => '文件正在打印中',
			3 => "由于担保积分不足或订单要求不明确等原因，您需要到打印店自助打印，或者<a class='cancel-order'>撤销订单</a>",
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
			1 => '1x1',
			2 => '2x1',
			3 => '2x2',
			4 => '2x3',
			5 => '2x4',
			6 => '3x3',
			7 => '3x4',
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
			1 => '已撤銷',
			2 => '已接受',
			3 => '自助打印',
			4 => '等待領取',
			5 => '已完成',
		),
		'store_region' => array(
			0 => '北京大學',
		),
	);
	return ($key === '') ? $t : $t[$key];
}
function text_queue_action_par($st = 0) {
	$support = array(
		0 => array(2, 3),
		2 => array(4),
		3 => array(5),
		4 => array(5),
	);
	if($st === 0)
		return $support;
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
function user_exists($m) {
	global $db;
	$query = "select `id` from `user`
		where `email` = '{$db->real_escape_string($m)}'";
	if(!($result = $db->query($query)))
		err_redir("db error({$db->errno}). query:$query", '/error.php');
	return ($result->num_rows > 0);
}

