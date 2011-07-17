<?php

include '../config.php';
include '../inc/database.php';

session_name(SESSNAME);
session_start();

if($_SESSION['admin'] != true)
die('"At this time, I think you should purchase me an alcoholic beverage and engage in diminutive conversation with me in hopes of establishing a rapport."');

echo '<h1>Add column "location" into tables: "user" and "partner"</h1>';

global $db;
echo 'mysql server connected: ' . $db->host_info . "<br />";

$query = "alter table `user`
	add column `location` smallint unsigned not null default 1 after `id`,
	add index (`id)";
echo "query: $query <br />";
if($db->query($query) === TRUE)
	echo 'column successfully added.<br />';
else
	die("error modifying table: $db->error <br />");

$query = "alter table `partner`
	add column `location` smallint unsigned not null default 1 after `id`,
	add index (`id)";
echo "query: $query <br />";
if($db->query($query) === TRUE)
	echo 'column successfully added.<br />';
else
	die("error modifying table: $db->error <br />");
