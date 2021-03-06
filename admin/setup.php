<?php

include '../config.php';
include '../inc/database.php';

session_name(SESSNAME);
session_start();

if($_SESSION['admin'] != true)
die('"At this time, I think you should purchase me an alcoholic beverage and engage in diminutive conversation with me in hopes of establishing a rapport."');

function listCommands() {
}
function resetTable($table) {
	global $db, $tables;
	echo 'mysql server connected: ' . $db->host_info . "<br />";
	echo "<p>resetting table $table <br />";
	if($db->query("drop table if exists `$table`") === TRUE)
	echo 'table successfully dropped.<br />';
	else
	die("error dropping table: $db->error <br />");
	$query = "create table `$table` ( {$tables[$table]['col']} )";
	echo "query: $query <br />";
	if($db->query($query) === TRUE)
	echo 'table successfully created.<br />';
	else
	echo "error creating table: $db->error <br />";
	if(isset($tables[$table]['index'])) {
		$query = $tables[$table]['index'];
		echo "adding indexes:<br />$query<br />";
		if($db->query($query) === TRUE)
		echo '... succeeded.<br />';
		else
		echo "... error: $db->error <br />";
	}
	if(!isset($tables[$table]['row'])) {
		echo '</p>';
		return;
	}
	$query = "insert into `$table` values ";
	foreach($tables[$table]['row'] as $v)
	$query .= "( $v ), ";
	$query = substr($query, 0, -2);
	echo "query: $query; ... ";
	if($db->query($query) === TRUE)
	echo 'done.<br />';
	else
	echo "error: $db->error <br />";
	echo '</p>';
}

$tables = array(
	'badge' => array(
		'col' => '`id` smallint unsigned not null auto_increment primary key,
			`type` tinyint unsigned not null,
			`hidden` bool not null,
			`count` smallint unsigned not null,
			`name` varchar(32) not null,
			`desc` varchar(1024) not null,
			`hint` varchar(1024) not null',
		'row' => array(
			"default, 3, false, 0, '新手上路', '第一次成功提交订单。', '前往<a href=\'/home.php\'>示波器</a>提交订单。'",
			"default, 1, false, 0, '献计献策', '对光子复制提出宝贵意见，并被采纳。', '前往<a href=\'/blog/discussion/\'>讨论专区</a>留言。'",
		),
	),
	'badge-won' => array(
		'col' => '`uid` mediumint unsigned not null,
			`bid` smallint unsigned not null,
			`won` timestamp not null default current_timestamp,
			unique `id` (`uid`, `bid`)',
		'row' => array(
			'1, 1, default',
			'1, 2, default',
			'2, 1, default',
		),
	),
	'credit' => array(
		'col' => '`uid` MEDIUMINT UNSIGNED NOT NULL ,
			`pid` MEDIUMINT UNSIGNED NOT NULL ,
			`credit` mediumint NOT NULL ,
			unique `id` (`pid`, `uid`), index (`uid`), index (`pid`)',
//		'index' => "ALTER TABLE `devel_pq`.`credit` ADD UNIQUE `id-pid` ( `id` , `pid` )",
		'row' => array(
			"1, 0, 50",
			"1, 2, 90",
			"2, 0, 50",
			"2, 1, 20",
			"3, 0, 10",
			"4, 0, 10",
		),
	),
	'order' => array(
		'col' => ' `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ,
			`uid` MEDIUMINT UNSIGNED NOT NULL ,
			`pid` MEDIUMINT UNSIGNED NOT NULL ,
			`status` TINYINT UNSIGNED NOT NULL ,
			`paper` tinyint unsigned not null,
			`color` tinyint unsigned not null,
			`back` tinyint unsigned not null,
			`layout` tinyint unsigned not null,
			`page` smallint unsigned not null,
			`copy` smallint unsigned not null,
			`misc` tinyint unsigned not null,
			`cost` mediumint UNSIGNED NULL ,
			`paid` mediumint unsigned null,
			`fname` varchar(64) not null,
			`flink` varchar(128) not null,
			`created` timestamp not null default current_timestamp,
			`accepted` timestamp null,
			`finished` timestamp null,
			`closed` timestamp null,
			`note` varchar(512) null,
			INDEX ( `uid` ), index (`pid`), index (`status`) ',
		'row' => array(
			"default, 1, 1, 5, 2, 1, 1, 2, 5, 5, 2, 27, 30, 'abc.pdf', '-', default, default, default, default, 'test2'",
			"default, 1, 1, 4, 1, 2, 1, 3, 3, 3, 3, default, default, 'abc.pdf', '-', default, default, default, default, 'test3'",
			"default, 1, 1, 3, 1, 1, 2, 1, 7, 7, 1, default, default, 'abc.pdf', '-', default, default, default, default, 'test1'",
			"default, 1, 1, 2, 1, 1, 2, 1, 7, 7, 1, default, default, 'abc.pdf', '-', default, default, default, default, 'test1'",
			"default, 1, 1, 1, 2, 1, 1, 2, 5, 5, 2, default, default, 'abc.pdf', '-', default, default, default, default, 'test2'",
			"default, 1, 1, 0, 1, 2, 1, 3, 3, 3, 3, default, default, 'abc.pdf', '-', default, default, default, default, 'test3'",
			"default, 1, 2, 5, 2, 1, 1, 2, 5, 5, 2, 27, 30, 'abc.pdf', '-', default, default, default, default, 'test2'",
			"default, 1, 2, 4, 1, 2, 1, 3, 3, 3, 3, default, default, 'abc.pdf', '-', default, default, default, default, 'test3'",
			"default, 1, 2, 3, 1, 1, 2, 1, 7, 7, 1, default, default, 'abc.pdf', '-', default, default, default, default, 'test1'",
			"default, 1, 2, 2, 1, 1, 2, 1, 7, 7, 1, default, default, 'abc.pdf', '-', default, default, default, default, 'test1'",
			"default, 1, 2, 1, 2, 1, 1, 2, 5, 5, 2, default, default, 'abc.pdf', '-', default, default, default, default, 'test2'",
			"default, 1, 2, 0, 1, 2, 1, 3, 3, 3, 3, default, default, 'abc.pdf', '-', default, default, default, default, 'test3'",
			"default, 2, 2, 5, 2, 2, 1, 1, 5, 5, 1, 25, 30, 'abc.pdf', '-', default, default, default, default, 'test4'",
			"default, 2, 1, 2, 1, 1, 2, 4, 5, 5, 4, default, default, 'abc.pdf', '-', default, default, default, default, 'test5'",
			"default, 3, 1, 1, 1, 2, 2, 1, 3, 3, 1, default, default, 'abc.pdf', '-', default, default, default, default, 'test6'",
			"default, 2, 2, 5, 1, 1, 2, 4, 5, 5, 4, 17, 20, 'abc.pdf', '-', default, default, default, default, 'test5'",
			"default, 1, 1, 1, 2, 1, 1, 2, 5, 5, 2, default, default, 'abc.pdf', '-', default, default, default, default, 'test2'",
			"default, 1, 2, 0, 1, 2, 1, 3, 3, 3, 3, default, default, 'abc.pdf', '-', default, default, default, default, 'test3'",
			"default, 2, 2, 0, 2, 2, 1, 1, 5, 5, 1, default, default, 'abc.pdf', '-', default, default, default, default, 'test4'",
			"default, 2, 2, 2, 1, 1, 2, 4, 5, 5, 4, default, default, 'abc.pdf', '-', default, default, default, default, 'test5'",
			"default, 1, 1, 3, 2, 1, 1, 2, 5, 5, 2, default, default, 'abc.pdf', '-', default, default, default, default, 'test2'",
			"default, 1, 1, 0, 2, 1, 1, 2, 5, 5, 2, default, default, 'abc.pdf', '-', default, default, default, default, 'test2'",
			"default, 1, 1, 5, 2, 1, 1, 2, 5, 5, 2, 10, 10, 'abc.pdf', '-', default, default, default, default, 'test2'",
			"default, 1, 1, 3, 2, 1, 1, 2, 5, 5, 2, default, default, 'abc.pdf', '-', default, default, default, default, 'test2'",
			"default, 1, 1, 2, 2, 1, 1, 2, 5, 5, 2, default, default, 'abc.pdf', '-', default, default, default, default, 'test2'",
			"default, 1, 1, 1, 2, 1, 1, 2, 5, 5, 2, default, default, 'abc.pdf', '-', default, default, default, default, 'test2'",
			"default, 1, 1, 0, 2, 1, 1, 2, 5, 5, 2, default, default, 'abc.pdf', '-', default, default, default, default, 'test2'",
		),
	),
	'partner' => array(
		'col' => ' `id` MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ,
			`email` VARCHAR( 64 ) NOT NULL ,
			`passwd` CHAR( 32 ) NOT NULL ,
			`passphrase` CHAR( 32 ) NOT NULL ,
			`name` VARCHAR( 32 ) NOT NULL ,
			`region` TINYINT UNSIGNED NOT NULL ,
			`memo` VARCHAR( 256 ) NOT NULL ,
			UNIQUE (`email`)',
		'row' => array(
			"default, 'p1@abc.com', '".md5('p223223')."', '223', '36楼甲打印店', 0, '位置: 北京大学36楼223<br />这是内测阶段的虚拟打印店'",
			"default, 'p2@abc.com', '".md5('p219219')."', '219', '36楼乙打印店', 0, '位置: 北京大学36楼219<br />这是内测阶段的虚拟打印店'",
			"default, 'p3@abc.com', '".md5('p123123')."', '123', '35楼打印店', 0, '位置: 北京大学35楼北侧 | 营业时间: 8AM-8PM <br /> 单面打印: 1角/张 | 双面打印: 7分/面'",
		),
	),
//	TODO add last_visit ?
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
			"default, 'user3@example.com', '".md5('user3')."', 'User3', default",
			"default, 'user4@example.com', '".md5('user4')."', 'User4', default",
			"default, 'user5@example.com', '".md5('user5')."', 'User5', default",
			"default, 'user6@example.com', '".md5('user6')."', 'User6', default",
			"default, 'user7@example.com', '".md5('user7')."', 'User7', default",
			"default, 'user8@example.com', '".md5('user8')."', 'User8', default",
			"default, 'user9@example.com', '".md5('user9')."', 'User9', default",
			"default, 'usera@example.com', '".md5('usera')."', 'Usera', default",
			"default, 'userb@example.com', '".md5('userb')."', 'Userb', default",
			"default, 'userc@example.com', '".md5('userc')."', 'Userc', default",
		),
	),
);

echo '<html><body><br />';

if(!isset($_GET['c'])) {
	foreach(glob('db-migrate*.php') as $fn)
		echo "<a href='$fn'>$fn</a><br />";
	echo '<hr /><br />';
	foreach($tables as $k => $v)
		echo "<a href='{$_SERVER['SCRIPT_NAME']}?c=$k'>reset the <strong>$k</strong> table.</a><br />";
	echo '<pre>';
	var_dump($tables);
	echo '</pre>';
} else {
	$table = $_GET['c'];
	if(!isset($tables[$table]))
	die("table $table doesn't exist.");
	echo 'dont modify tables this way.';
//	resetTable($table);
}

echo '</body></html>';

?>
