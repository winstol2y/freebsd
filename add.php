<?php

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
elseif(empty($_POST["host_add"])){
	echo "กรุณากรอก Host Name";
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
elseif($date12 <= 0){
	echo "กรุรณาใส่วันที่มากกว่านี้";
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
	
		function check($data){
			$data_for_check=$_POST["$data"];
			$result_name = shell_exec("grep -cw $data_for_check /usr/local/www/dhcp/list.txt");
			return $result_name;
		}
		

		//$pattern_ip = "/\b($ip_for_check)\b/i";
		//$result_ip = preg_grep($pattern_ip,file('/usr/local/www/dhcp/list.txt'));
		//$checkMac=shell_exec("grep -cim1 $_POST[macAddress_add] /usr/local/www/dhcp/list.txt");
		//$check = "<pre>$checkMac</pre>";

		if(check("macAddress_add") > 0){ //check mac repeat
			echo "Mac Address ซ้ำ";
		}
		elseif(check("host_add") > 0){ //check host repeat
			echo "Host Name ซ้ำ";
		}
		elseif(check("name_add") > 0){ //check name repeat
			echo "Name ซ้ำ";
		}
		elseif(check("ip_add") > 0){ //check ip repeat
			echo "IP Address ซ้ำ";
		}
		else{
			$a=fopen("macAddress_add.txt", "w"); // open file
			$b=fopen("name_add.txt", "w");
			$c=fopen("host_add.txt", "w");
			$d=fopen("ip_add.txt", "w");
			$e=fopen("time_add.txt", "w");
		
			fwrite($b,$_POST["name_add"]); //write text to file
		
			fwrite($a,$_POST["macAddress_add"]);
		
			fwrite($c,$_POST["host_add"]);
		
			fwrite($d,$_POST["ip_add"]);
				
			fwrite($e,$_POST["time_add"]);
		
			fclose($a); // close file
			fclose($b);
			fclose($c);
			fclose($d);
			fclose($e);

			$cmd=shell_exec('./add.sh'); // run shell add
			header('Location: index.php');
			echo "<pre>$cmd</pre>";
		
			$cmd1=shell_exec('sh service_isc_restart.sh'); //run shell restart service
			echo "<pre>$cmd1</pre>";
		}	
	}
}
?> 
