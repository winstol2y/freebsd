<?php

$servername = "localhost";
$username = "admin";
$password = "qwerty";
$dbname = "dhcpd";

$con = mysql_connect($servername,$username,$password) or die (mysql_error("Error connect"));
	mysql_select_db($dbname) or die (mysql_error("Error database"));

?>
