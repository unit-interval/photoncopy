<?php

define('QUERY_BASE', 'http://dev.photoncopy.com/upload/');

if(!isset($_GET['q'])) {
	header('Location: http://dev.photoncopy.com/');
	die;
}

$fn = basename($_GET['q']);
$url = QUERY_BASE . $fn;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERAGENT, 'libcurl/7.16.0 photoncopy.com/mirror/pkuair');
if(!($file = curl_exec($ch)))
	die('error occured. please report this issue to "tech AT huangtao DOT me", thanx.');
//	die(curl_error($ch));
$info = curl_getinfo($ch);
curl_close($ch);

if($info['http_code'] != 200)
	die('file doesn\'t exist. if u believe this is wrong, report this issue to "tech AT huangtao DOT me".');
header('Content-Type: ' . $info['content_type']);
header('Content-Disposition: attachment; filename="' . urldecode($fn) . '"');
header('Content-Length: ' . $info['download_content_length']);
echo $file;

?>
