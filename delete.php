<?php

include("connect.php");

$mac=$_GET["mac"];
$ip=$_GET["ip"];

$query_delete = "DELETE FROM `dhcpd`.`ipv4` WHERE `ipv4`.`hw` = '$mac'";
mysql_query($query_delete);

shell_exec("./gen_dns_dhcp.rb");
shell_exec("./serviec_isc_restart");
header('Location:index.php');

mysql_close($con);
?>
