<?php

$link = mysql_connect("localhost","root","", true);
mysql_select_db ("test",$link) or die ("Could not select database");
mysql_query("SET NAMES 'utf8'",$link);
mysql_query("SET CHARSET utf8;", $link) or die("Cannot use utf8 CHARSET\n");

?>