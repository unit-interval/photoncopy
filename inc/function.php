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
function text_defs($key, $all = false) {
	$t = array(
		'order_double' => array(
			1 => '單面',
			2 => '雙面',
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
			3 => '訂單退回',
			4 => '完成待取',
			5 => '任務完成',
			6 => '自助任務已提交',
			7 => '自助任務已提交',
		),
		'order_status_par' => array(
			0 => '新任務',
			1 => false, //已撤銷
			2 => '已接受',
			3 => false, //已拒絕
			4 => '等待領取',
			5 => false, //付款完成
			6 => '自助任務',
			7 => '等待自助打印',
		),
		'queue_action' => array(
			0 => '撤銷任務',
			1 => '複製到新任務',
			2 => '前往打印店',
			3 => '重新提交',
			4 => '追加份數',
			5 => '複製到新訂單',
			6 => '撤銷任務',
			7 => '撤銷任務',
		),
		'store_region' => array(
			0 => '北京大學',
		),
	);
	return $all ? $t : $t[$key];
}
function text_queue_action($id) {
	
}
function text_queue_action_par($id, $st) {
	$support = array(
		0 => array(0, 1),
		2 => array(2),
		4 => array(3),
		6 => array(4),
		7 => array(3),
	);
	$actions = array(
		0 => "接受",
		1 => "拒絕",
		2 => '完成任務',
		3 => '結帳付款',
		4 => '已下載',
	);
	$html = '';
	$h1 = "<a href='/process.php?oid=$id&act=";
	foreach($support[$st] as $a) {
		$html .= $h1 . $a . "'>" . $actions[$a] . "</a>";
	}
	return $html;
}
function verify_login_form() {
	/** validate input client-side with js */
	$input = array();
	$input['email'] = strtolower($_POST['email']);
	$input['passwd'] = md5($_POST['passwd']);
	$input['pub'] = (isset($_POST['pub']) ? true : false);
	return $input;
}

