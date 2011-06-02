<?php

function badge_criteria($class) {
	$cr = array(
		'num_submit' => array(
			1 => 1,
		),
	);
	return $cr[$class];
}
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
	return json_encode($ob, $options);
// TODO following code not working
//	return preg_replace("#\\\u([0-9a-f]+)#ie", "iconv('UCS-2', 'UTF-8', pack('H4', '\\1'))", json_encode($ob, $options));
}
function order_status_map($st = '') {
	$support = array(
		0 => array(2, 3),
		2 => array(4),
		3 => array(5),
		4 => array(5),
		'require_form' => array(3, 4),
	);
	return (($st === '') ? $support : $support[$st]);
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
			0 => "订单处在队列中，您仍可以 <a class='cancel-order'>撤销订单</a>",
			1 => '订单已成功撤销',
			2 => '订单正在打印中',
			3 => "由于信用不足或订单要求不明确等原因，您需要到打印店自助打印，您仍可以 <a class='cancel-order'>撤销订单</a>",
			4 => '订单已打印完成，请您前往打印店领取',
			5 => '订单已完成',
		),
		'order_back' => array(
			1 => '单面',
			2 => '双面',
		),
		'order_color' => array(
			1 => '黑白',
			2 => '彩色',
		),
		'order_layout' => array(
			1 => '1版',
			2 => '2版',
			3 => '4版',
			4 => '6版',
			5 => '8版',
			6 => '9版',
			7 => '12版',
		),
		'order_misc' => array(
			1 => '无装订',
			2 => '简易装订',
			3 => '侧边装订',
			4 => '添加封面',
		),
		'order_paper' => array(
			1 => 'B5纸',
			2 => 'A4纸',
		),
		'order_type' => array(
			0 => 'PDF文档',
			1 => 'WORD文档',
			2 => 'PPT幻灯片',
			3 => '其他文档',
		),
		'order_status' => array(
			0 => '队列中',
			1 => '成功撤消',
			2 => '正在打印',
			3 => '自助打印',
			4 => '完成待取',
			5 => '任务完成',
			'open' => array(0, 2, 4),
		),
		'order_status_par' => array(
			0 => '新任务',
			1 => '已撤消',
			2 => '已接受',
			3 => '自助打印',
			4 => '等待領取',
			5 => '已完成',
		),
		'store_region' => array(
			0 => '北京大学',
		),
	);
	return ($key === '') ? $t : $t[$key];
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
	$query = "select `id`, `name` from `user`
		where `email` = '{$db->real_escape_string($m)}'";
	if(!($result = $db->query($query)))
		err_redir("db error({$db->errno}). query:$query", '/error.php');
	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();
		return $row;
	}
	return false;
}
function user_exists_par($m) {
	global $db;
	$query = "select `id`, `name` from `partner`
		where `email` = '{$db->real_escape_string($m)}'";
	if(!($result = $db->query($query)))
		err_redir("db error({$db->errno}). query:$query", '/error.php');
	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();
		return $row;
	}
	return false;
}