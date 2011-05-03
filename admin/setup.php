<?php

require '../config.php';

session_name(SESSNAME);
session_start();

if($_SESSION['admin'] != true)
        die('"Hey, Look! We found a witch! May we burn her?"');

$tables = array(
	'user' => array(
		'col' => 'id mediumint not null auto_increment primary key,
			email varchar(64) not null,
			passwd varchar(32) not null,
			name varchar(32) not null,
			stamp timestamp not null default current_timestamp,
			unique( email )',
		'row' => array(
			"default, 'user1@example.com', '".md5('user1')."', 'User1', default",
			"default, 'user2@example.com', '".md5('user2')."', 'User2', default",
		),
	),
	//'store' => array(
	//'order' => array(
);


function listCommands() {
}
function resetTable($table) {
	global $tables;
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	if ($mysqli->connect_error) {
	    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
	}
	echo 'mysql server connected: ' . $mysqli->host_info . "<br />";
	if (!$mysqli->set_charset("utf8"))
		err_redir("database error: $mysqli->error.", '/error.php');
	echo "<p>resetting table $table <br />";
	if($mysqli->query("drop table if exists `$table`") === TRUE)
		echo 'table successfully dropped.<br />';
	else
		die("error dropping table: $mysqli->error <br />");
	$query = "create table `$table` ( {$tables[$table]['col']} )";
	echo "query: $query <br />";
	if($mysqli->query($query) === TRUE)
		echo 'table successfully created.<br />';
	else
		echo "error creating table: $mysqli->error <br />";
	if(!isset($tables[$table]['row'])) {
		echo '</p>';
		return;
	}
	foreach($tables[$table]['row'] as $v) {
		$query = "insert into `$table` values ( $v )";
		echo "query: $query; ... ";
		if($mysqli->query($query) === TRUE)
			echo 'done.<br />';
		else
			echo "error: $mysqli->error <br />";
	}
	$mysqli->close();
	echo '</p>';
}

echo '<html><body>';

if(!isset($_GET['c'])) {
	foreach($tables as $k => $v)
		echo "<a href='{$_SERVER['SCRIPT_NAME']}?c=$k'>reset the <strong>$k</strong> table.</a><br />";
	echo '<pre>';
	print_r($tables);
	echo '</pre>';
} else {
	$table = $_GET['c'];
	if(!isset($tables[$table]))
		die("table $table doesn't exist.");
	resetTable($table);
}

echo '</body></html>';

?>
