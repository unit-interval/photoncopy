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
function text_defs($k,$all = false) {
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
			1 => '正在打印',
			2 => '完成待取',
			3 => '成功徹消',
			4 => '已關閉',
			5 => '強制撤銷',
		),
		'order_status_proc' => array(
			0 => '新任務',
			1 => '已接受',
			2 => '等待領取',
		),
		'store_region' => array(
			0 => '北京大學',
		),
	);
	return $all ? $t : $t[$k];
}
function verify_login_form() {
	/** validate input client-side with js */
	$input = array();
	$input['email'] = strtolower($_POST['email']);
	$input['passwd'] = md5($_POST['passwd']);
	$input['pub'] = (isset($_POST['pub']) ? true : false);
	return $input;
}

