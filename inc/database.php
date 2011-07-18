<?php

$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($db->connect_error)
err_redir("mysql connect error({$db->connect_errno}).",'/error.php');
if (!$db->set_charset("utf8"))
err_redir("db error({$db->errno}).", '/error.php');

