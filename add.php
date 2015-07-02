<?php

if(empty($_POST["macAddress_add"])){
	echo "กรุณากรอก Mac Address";
}
elseif(empty($_POST["host_add"])){
	echo "กรุณากรอก Host Name";
}
elseif(empty($_POST["name_add"])){
        echo "กรุณากรอก Name";
}
elseif(empty($_POST["ip_add"])){
        echo "กรุณากรอก Ip Address";
}
else{
	$numCharecter=strlen($_POST["macAddress_add"]);
	if($numCharecter>17){
		echo "Mac Address เกิน";
	}
	elseif($numCharecter<17){
		echo "Mac Address ไม่ครบ";
	}
	elseif($numCharecter=17){
		$mac_for_check=$_POST["macAddress_add"];
		$host_for_check=$_POST["host_add"];
		$name_for_check=$_POST["name_add"];
		$ip_for_check=$_POST["ip_add"];
		
		$pattern_mac = "/\b($mac_for_check)\b/i";
		$pattern_host = "/\b($host_for_check)\b/i";
		$pattern_name = "/\b($name_for_check)\b/i";
		$pattern_ip = "/\b($ip_for_check)\b/i";

		$result_mac = preg_grep($pattern_mac,file('/usr/local/www/dhcp/list.txt'));
		$result_host = preg_grep($pattern_host,file('/usr/local/www/dhcp/list.txt'));
		$result_name = preg_grep($pattern_name,file('/usr/local/www/dhcp/list.txt'));
		$result_ip = preg_grep($pattern_ip,file('/usr/local/www/dhcp/list.txt'));

		//echo sizeof($result);
		//$checkMac=shell_exec("grep -cim1 $_POST[macAddress_add] /usr/local/www/dhcp/list.txt");
		//$check = "<pre>$checkMac</pre>" ;
		//$check1 = trim((string) $check);
		if(sizeof($result_mac) > 0){
			echo "Mac Address ซ้ำ";
		}
		elseif(sizeof($result_host) > 0){
			echo "Host Name ซ้ำ";
		}
		elseif(sizeof($result_name) > 0){
			echo "Name ซ้ำ";
		}
		elseif(sizeof($result_ip) > 0){
			echo "IP Address ซ้ำ";
		}
		else{
			$a=fopen("macAddress_add.txt", "w");
			$b=fopen("name_add.txt", "w");
			$c=fopen("host_add.txt", "w");
			$d=fopen("ip_add.txt", "w");
		
			fwrite($b,$_POST["name_add"]);
		
			fwrite($a,$_POST["macAddress_add"]);
		
			fwrite($c,$_POST["host_add"]);
		
			fwrite($d,$_POST["ip_add"]);
		
		
			fclose($a);
			fclose($b);
			fclose($c);
			fclose($d);
		
			$cmd=shell_exec('./add.sh');
			header('Location: index.php');
			echo "<pre>$cmd</pre>";
		
			$cmd1=shell_exec('sh service_isc_restart.sh');
			echo "<pre>$cmd1</pre>";
		}	
	}
}
?> 
