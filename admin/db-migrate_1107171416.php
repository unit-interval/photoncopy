<?php

include '../config.php';
include '../inc/database.php';

session_name(SESSNAME);
session_start();

if($_SESSION['admin'] != true)
die('"At this time, I think you should purchase me an alcoholic beverage and engage in diminutive conversation with me in hopes of establishing a rapport."');

$table_name = 'location';
$columns = '`id` smallint unsigned not null auto_increment primary key,
	`name` varchar(32) not null';
$rows = array(
	"default, '北京大學'",
);

global $db;
echo 'mysql server connected: ' . $db->host_info . "<br />";

echo 'adding new table: "location".';
$query = "create table `$table_name` ( $columns )";
echo "query: $query <br />";
if($db->query($query) === TRUE)
	echo 'table successfully created.<br />';
else {
	echo "error creating table: $db->error <br />";
	die;
}

echo 'adding seed rows.';
$query = "insert into `$table_name` values ";
foreach($rows as $v)
	$query .= "( $v ), ";
$query = substr($query, 0, -2);
echo "query: $query; ... ";
if($db->query($query) === TRUE)
	echo 'done.<br />';
else
	echo "error: $db->error <br />";


