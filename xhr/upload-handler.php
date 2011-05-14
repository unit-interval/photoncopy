<?php

include '../config.php';
include DIR_INC . 'function.php';
include DIR_INC . 'database.php';

session_name(SESSNAME);
session_start();

if($_SESSION['logged_in'] != true)
	die("<p id='result'>not logged in.</p>");

if ($_FILES["file"]["error"] > 0) {
	echo "<p id='result'>fail</p>";
//	echo "Error: " . $_FILES["file"]["error"] . "<br />";
}
else
{
	echo "<p id='result'>success</p>";
  echo "Upload: " . $_FILES["file"]["name"] . "<br />";
  echo "Type: " . $_FILES["file"]["type"] . "<br />";
  echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
  echo "Stored in: " . $_FILES["file"]["tmp_name"];
  }
//var_dump($_FILES);
?>

