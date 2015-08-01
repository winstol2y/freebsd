<?php
include("connect.php");

date_default_timezone_set("Asia/Bangkok"); //set time zone
date_default_timezone_get();
$t1 = date('d-m-Y'); //time now
$t2 = $_POST["time_add"];

$date1=date_create("$t1");
$date2=date_create("$t2");
$diff=date_diff($date1,$date2);
$date11 = $diff->format("%R%a");
$date12 = (int)$date11;

if(empty($_POST["macAddress_add"])){
	echo "กรุณากรอก Mac Address";
}
elseif(empty($_POST["name_add"])){
        echo "กรุณากรอก Name";
}
elseif(empty($_POST["ip_add"])){
        echo "กรุณากรอก Ip Address";
}
elseif(empty($_POST["time_add"])){
	echo "กรุณากรอก Expire";
}
elseif($date12 < 0){
	echo "กรุณาใส่วันที่มากกว่านี้";
}
else{
	$a=fopen("macAddress_add.txt", "w");
	fwrite($a,$_POST["macAddress_add"]);
	fclose($a);
	
	$result = shell_exec("sed -e 's/[[:punct:]]//g' -e 's/[[:space:]]//g' /usr/local/www/dhcp/macAddress_add.txt");
	$result1 = trim($result);
	$numCharecter=strlen($result1);

	$b=fopen("macAddress_add1.txt", "w");
	fwrite($b,$result);
	fclose($b);
 	
	$a = '\'s/[[:xdigit:]]\{2\}/&:/g\'';
	$b = '\'$s/.$//\'';
	$result_mac = shell_exec("sed -e $a -e $b /usr/local/www/dhcp/macAddress_add1.txt");

	$c=fopen("macAddress_add2.txt", "w");
	fwrite($c,$result_mac);
	fclose($c);

	if($numCharecter>12){
		echo "Mac Address เกิน";
	}
	elseif($numCharecter<12){
		echo "Mac Address ไม่ครบ";
	}
	elseif($numCharecter=12){
		
		$result_mac = trim($result_mac);
		$mac_query = "SELECT * FROM `ipv4` WHERE `hw` = '".$result_mac."'";
		$checkMac = mysql_query("$mac_query");

		$result_zone = trim($_POST["zone_add"]);
		$zone_query = "SELECT * FROM `ipv4` WHERE `hostname` = '".$result_zone."'";
		$checkZone = mysql_query("$zone_query");
		
		$result_name = trim($_POST["name_add"]);
		$name_query = "SELECT * FROM `ipv4` WHERE `name` = '".$result_name."'";
		$checkName = mysql_query("$name_query");
		
		$result_ip = trim($_POST["ip_add"]);
		$ip_query = "SELECT * FROM `ipv4` WHERE `ip` = '".$result_ip."'";
		$checkIP = mysql_query("$ip_query");

		if(mysql_num_rows($checkMac) > 0){
 			echo "Mac Address exists already.";
		}
		elseif(mysql_num_rows($checkZone) > 0){
			echo "Host Name exists already.";
		}
		elseif(mysql_num_rows($checkName) > 0){
			echo "Name exists already.";
		}
		elseif(mysql_num_rows($checkIP) > 0){
			echo "IP address exists already.";
		}
		else{
			if(preg_match("/^[a-zA-Z0-9]+$/", $_POST['name_add']) == 0){
				echo "Change name";
			}
			else{
				$query_add = "INSERT INTO `dhcpd`.`ipv4` (`hw`, `zone`, `name`, `ip`, `expire`) VALUES ('".$result_mac."','".$_POST["zone_add"]."', '".$_POST["name_add"]."','".$_POST["ip_add"]."','".$_POST["time_add"]."')";

				mysql_query($query_add) or die(mysql_error());
				header('Location: index.php');
				
				shell_exec("./test.rb");

				shell_exec('./service_isc_restart.sh'); //run shell restart service
			}
		}
	}
}
mysql_close($con);
?> 
