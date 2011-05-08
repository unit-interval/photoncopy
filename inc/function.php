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
function text_queue_action($st = -1, $id = 0) {
	$support = array(
		0 => array(0),
		1 => array(1),
		2 => array(1),
		3 => array(1),
		4 => array(1),
		5 => array(1),
	);
	if($id === 0)
		return ($st === -1) ? $support : $support[$st];
	$actions = array(
		0 => "撤銷任務",
		1 => '複製到新訂單',
	);
	$a = $support[$st][0];
	$html = "<a href='/submit.php?oid=$id&act=$a'>{$actions[$a]}</a>";
	return $html;
	
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
	$h1 = "<a href='/process.php?oid=$id&act=";
	foreach($support[$st] as $a) {
		$html .= $h1 . $a . "'>" . $actions[$a] . "</a>";
	}
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

