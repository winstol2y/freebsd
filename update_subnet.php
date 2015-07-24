<?php
include("connect.php");

			$query_add = "UPDATE `dhcpd`.`config_subnet` SET `subnet`='".$_POST["subnet"]."', `netmask`='".$_POST["netmask"]."', `range`='".$_POST["range"]."'";

			mysql_query($query_add) or die(mysql_error());
			
			shell_exec("./test.rb");
			header('Location: config_subnet.php');
		
			shell_exec('./service_isc_restart.sh'); //run shell restart service
mysql_close($con);
?> 
