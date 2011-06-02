<?php

define('QUERY_URI', 'http://photoncopy.com/upload/');



if(!isset($_GET['q'])) {
	header('Location: http://photoncopy.com/');
	die;
}
$fn = basename($_GET['q']);
if(!($handle = @fopen(QUERY_URI . $fn, 'r'))) {
	header('HTTP/1.0 400 Bad Request');
	die;
}
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . $fn . '"');
while(!feof($handle)) {
	echo fread($handle, 8192);
	flush();
}
@fclose($handle);

?>
