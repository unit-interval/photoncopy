<?php

require '../config.php';

session_name(SESSNAME);
session_start();

if($_SESSION['admin'] != true)
        die('"At this time, I think you should purchase me an alcoholic beverage and engage in diminutive conversation with me in hopes of establishing a rapport."');

?>
<pre>

status:
	0. 未處理; 1. 正在打印; 2.打印完成;

type:
	0. pdf; 1. doc; 2. ppt; 3. 其他;


</pre>

