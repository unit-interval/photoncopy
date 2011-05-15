<?php

/** URL BASE and etc.*/
define('SERVER_HOST', 'pq.planetb612.info');
define('URL_BASE', 'http://' . SERVER_HOST . '/');
define('CODE_NAME', '光子复制');

/** PATH */
define('DIR_ROOT', $_SERVER['DOCUMENT_ROOT']);
define('DIR_INC', DIR_ROOT . '/inc/');
define('DIR_UPLD', DIR_ROOT . '/upload/');
define('DIR_UPLD_TMP', DIR_UPLD . 'tmp/');

/** session name */
define('SESSNAME', 'photonsess');
define('SESSNAME_P', 'photonpartsess');

/** array that contains page meta info */
$link = array(
	'css' => array(),
	'js' => array(),
);

/** read in local settings */
include DIR_INC . 'config.local.php';

?>
