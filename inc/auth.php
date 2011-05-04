<?

function cookie_auth() {
	if(!cookie_verify_hash()) {
		$_SESSION['logged_in'] = false;
		return;
	}
	$uid = $_COOKIE['uid'];
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	if ($mysqli->connect_error)
	err_redir("mysql connect error({$mysqli->connect_errno}).",'/error.php');
	if (!$mysqli->set_charset("utf8"))
	err_redir("db error({$mysqli->errno}).", '/error.php');
	$query = "select `stamp`+0, `email`, `name` from `user`
		where `id` = $uid";
	if($result = $mysqli->query($query)) {
		if($result->num_rows === 0) {
			$_SESSION['logged_in'] = false;
			setcookie('hash', '', time()-3600);
			return;
		}
		$user = $result->fetch_assoc();
		$result->free();
	}
	if($_COOKIE['stamp'] <= $user['`stamp`+0']) {
		$_SESSION['logged_in'] = false;
		setcookie('hash', '', time()-3600);
		return;
	}
	$query = "select `pocket`, `amount` from `credit`
		where `id` = $uid";
	if($result = $mysqli->query($query)) {
		$credit = array();
		while($row = $result->fetch_assoc())
		$credit[$row['pocket']] = $row['amount'];
		$result->free();
	}
	$mysqli->close();
	$_SESSION['logged_in'] = true;
	$_SESSION['uid'] = $uid;
	$_SESSION['name'] = $user['name'];
	$_SESSION['email'] = $user['email'];
	$_SESSION['credit'] = $credit;
	cookie_refresh();
}
function cookie_auth_par() {
	if(!cookie_verify_hash_par())
	return;
	$_SESSION['partner'] = true;
	$_SESSION['pid'] = $_COOKIE['pid'];
	cookie_refresh();
}
function cookie_refresh() {
	$expire = time()+3600*24*30;
	foreach($_COOKIE as $key => $value)
	setcookie($key, $value, $expire);
}
function cookie_verify_hash() {
	if(!isset($_COOKIE['hash']) || !isset($_COOKIE['uid']) || !isset($_COOKIE['stamp']))
	return false;
	$date = date_create();
	$salt1 = $date->format('Y-M-');
	$salt2 = $date->modify('-1 month')->format('Y-M-');
	if (($_COOKIE['hash'] == md5($salt1 . $_COOKIE['uid'] . $_COOKIE['stamp'])) ||
	($_COOKIE['hash'] == md5($salt2 . $_COOKIE['uid'] . $_COOKIE['stamp'])))
	return true;
	else {
		setcookie('hash', '', time()-3600);
		return false;
	}
}
function cookie_verify_hash_par() {
	if(!isset($_COOKIE['hash']) || !isset($_COOKIE['pid']))
	return false;
	if($_COOKIE['hash'] == md5(SALT_REG . $_COOKIE['pid']))
	return true;
	else {
		setcookie('hash', '', time()-3600);
		return false;
	}
}

/** may query database for other info about the user and set them in session variables */

