<?php
include("connect.php");

			$query_add = "INSERT INTO `dhcpd`.`config_subnet` (`subnet`,`netmask`,`range`) VALUES ('".$_POST["subnet"]."','".$_POST["netmask"]."','".$_POST["range"]."')";

			mysql_query($query_add) or die(mysql_error());
			
			shell_exec("./test.rb");
			header('Location: config_subnet.php');
		
			shell_exec('./service_isc_restart.sh'); //run shell restart service
mysql_close($con);
?> 
