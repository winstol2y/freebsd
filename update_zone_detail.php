<?php
include("connect.php");

			$query_add = "UPDATE `dhcpd`.`zone_detail` SET `refresh`='".$_POST["refresh"]."', `retry`='".$_POST["retry"]."', `expire`='".$_POST["expire"]."', `minimum`='".$_POST["minimum"]."'";

			mysql_query($query_add) or die(mysql_error());
			
			shell_exec("./test.rb");
			header('Location: config_zone_detail.php');
		
			shell_exec('./service_isc_restart.sh'); //run shell restart service
mysql_close($con);
?> 
