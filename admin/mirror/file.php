<?php

define('QUERY_BASE', 'http://photoncopy.com/upload/');



if(!isset($_GET['q'])) {
	header('Location: http://photoncopy.com/');
	die;
}
$fn = basename($_GET['q']);
//$url = QUERY_BASE . urlencode($fn);
$url = QUERY_BASE . $fn;
if(!($handle = @fopen($url, 'r'))) {
	header('HTTP/1.0 400 Bad Request');
	die('文件不存在: ' . $url);
}
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . urldecode($fn) . '"');
while(!feof($handle)) {
	echo fread($handle, 8192);
	flush();
}
@fclose($handle);

?>
