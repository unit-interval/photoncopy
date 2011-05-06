<?

function cookie_auth() {
	global $db;
	if(!cookie_verify_hash()) {
		$_SESSION['logged_in'] = false;
		return;
	}
	$uid = $_COOKIE['uid'];
	$query = "select `stamp`+0, `email`, `name` from `user`
		where `id` = $uid";
	if($result = $db->query($query)) {
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
	if($result = $db->query($query)) {
		$credit = array();
		while($row = $result->fetch_assoc())
		$credit[$row['pocket']] = $row['amount'];
		$result->free();
	}
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
	$date->modify('-1 month');
	$salt2 = $date->format('Y-M-');
	if (($_COOKIE['hash'] == md5($salt1 . $_COOKIE['uid'] . $_COOKIE['stamp'])) ||
	($_COOKIE['hash'] == md5($salt2 . $_COOKIE['uid'] . $_COOKIE['stamp'])))
	return true;
	else {
		setcookie('hash', '', time()-3600);
		return false;
	}
}
function cookie_verify_hash_par() {
	if(!isset($_COOKIE['hash_p']) || !isset($_COOKIE['pid_p']))
	return false;
	if($_COOKIE['hash_p'] == md5(SALT_REG . $_COOKIE['pid_p']))
	return true;
	else {
		setcookie('hash_p', '', time()-3600);
		return false;
	}
}

/** may query database for other info about the user and set them in session variables */

