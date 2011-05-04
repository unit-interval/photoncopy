<?php

require '../config.php';

session_name(SESSNAME);
session_start();

if($_SESSION['admin'] != true)
die('"At this time, I think you should purchase me an alcoholic beverage and engage in diminutive conversation with me in hopes of establishing a rapport."');

$tables = array(
	'credit' => array(
		'col' => '`id` MEDIUMINT UNSIGNED NOT NULL ,
			`pocket` MEDIUMINT UNSIGNED NOT NULL ,
			`amount` float(8.2) NOT NULL ',
		'index' => "ALTER TABLE `devel_pq`.`credit` ADD UNIQUE `id-pocket` ( `id` , `pocket` )",
		'row' => array(
			"1, 0, 0.5",
			"1, 2, 3.9",
			"2, 0, 2.5",
			"2, 1, 3.2",
),
),
	'order' => array(
		'col' => ' `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ,
			`uid` MEDIUMINT UNSIGNED NOT NULL ,
			`pid` MEDIUMINT UNSIGNED NOT NULL ,
			`status` TINYINT UNSIGNED NOT NULL ,
			`type` TINYINT UNSIGNED NOT NULL ,
			`cost` FLOAT( 5, 2 ) UNSIGNED NOT NULL ,
			INDEX ( `uid` , `pid` , `status` ) ',
		'row' => array(
			"default, 1, 1, 2, 0, 0.3",
			"default, 1, 1, 1, 2, 1.2",
			"default, 1, 2, 0, 1, 0.5",
			"default, 2, 2, 0, 3, 0.6",
			"default, 2, 3, 2, 0, 2.7",
			"default, 2, 1, 1, 1, 0.9",
),
),
	'partner' => array(
		'col' => ' `id` MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ,
			`email` VARCHAR( 64 ) NOT NULL ,
			`passwd` CHAR( 32 ) NOT NULL ,
			`name` VARCHAR( 32 ) NOT NULL ,
			UNIQUE (`email`)',
		'row' => array(
			"default, 'p1@abc.com', '".md5('p1')."', '25楼打印店'",
			"default, 'p2@abc.com', '".md5('p2')."', '博實打印店'",
			"default, 'p3@abc.com', '".md5('p3')."', '學五打印店'",
),
),
	'user' => array(
		'col' => 'id mediumint unsigned not null auto_increment primary key,
			email varchar(64) not null,
			passwd char(32) not null,
			name varchar(32) not null,
			stamp timestamp not null default current_timestamp,
			unique( `email` )',
		'row' => array(
			"default, 'user1@example.com', '".md5('user1')."', 'User1', default",
			"default, 'user2@example.com', '".md5('user2')."', 'User2', default",
),
),
);


function listCommands() {
}
function resetTable($table) {
	global $tables;
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	if ($mysqli->connect_error)
	err_redir("database connect error: $mysqli->error.", '/error.php');
	if (!$mysqli->set_charset("utf8"))
	err_redir("database error: $mysqli->error.", '/error.php');
	echo 'mysql server connected: ' . $mysqli->host_info . "<br />";
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
	if(isset($tables[$table]['index'])) {
		$query = $tables[$table]['index'];
		echo "adding indexes:<br />$query<br />";
		if($mysqli->query($query) === TRUE)
		echo '... succeeded.<br />';
		else
		echo "... error: $mysqli->error <br />";
	}
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
