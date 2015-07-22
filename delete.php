<?php

include("connect.php");

$mac=$_GET["mac"];
$ip=$_GET["ip"];

$query_delete = "DELETE FROM `dhcpd`.`ipv4` WHERE `ipv4`.`hw` = '$mac'";
mysql_query($query_delete);

//shell_exec("rm -f /usr/local/etc/namedb/dynamic/*");
shell_exec("./test.rb");
shell_exec("./service_isc_restart.sh");
header('Location:index.php');

mysql_close($con);
?>
