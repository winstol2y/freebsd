<html>
<head>
<title>upload csv</title>
</head>
<body>

<?php
move_uploaded_file($_FILES["fileCSV"]["tmp_name"],$_FILES["fileCSV"]["name"]); // Copy/Upload CSV

$objConnect = mysql_connect("localhost","admin","qwerty") or die("Error Connect to Database"); // Conect to MySQL
$objDB = mysql_select_db("dhcpd");

$objCSV = fopen($_FILES["fileCSV"]["name"], "r");
while (($objArr = fgetcsv($objCSV, 1000, ",")) !== FALSE) {
	$t1 = date('d-m-Y'); //time now
	$t2 = $objArr[4];
	$date1=date_create("$t1");
	$date2=date_create("$t2");
	$diff=date_diff($date1,$date2);
	$date11 = $diff->format("%R%a");
	$date12 = (int)$date11;
	
	$result_mac = trim($objArr[0]);
	$mac_query = "SELECT * FROM `ipv4` WHERE `hw` = '".$result_mac."'";
	$checkMac = mysql_query("$mac_query");
	
	$result_name = trim($objArr[2]);
	$name_query = "SELECT * FROM `ipv4` WHERE `name` = '".$result_name."'";
	$checkName = mysql_query("$name_query");
	
	$result_ip = trim($objArr[3]);
	$ip_query = "SELECT * FROM `ipv4` WHERE `ip` = '".$result_ip."'";
	$checkIP = mysql_query("$ip_query");

	if($date12 < 0){
		echo "$objArr[0],$objArr[1],$objArr[2],$objArr[3],$objArr[4] : date<br/><br/>";
	}
	elseif(mysql_num_rows($checkMac) > 0){
		echo "$objArr[0],$objArr[1],$objArr[2],$objArr[3],$objArr[4] : Mac Address exists already.<br/><br/>";
	}
	elseif(mysql_num_rows($checkName) > 0){
		echo "$objArr[0],$objArr[1],$objArr[2],$objArr[3],$objArr[4] : Name exists already.<br/><br/>";
	}
	elseif(mysql_num_rows($checkIP) > 0){
		echo "$objArr[0],$objArr[1],$objArr[2],$objArr[3],$objArr[4] : IP address exists already.<br/><br/>";
	}
	else{	
		$strSQL = "INSERT INTO ipv4 ";
		$strSQL .="(hw,zone,name,ip,expire)";
		$strSQL .="VALUES ";
		$strSQL .="('$objArr[0]','$objArr[1]','$objArr[2]','$objArr[3]','$objArr[4]') ";
		$objQuery = mysql_query($strSQL);
	}
}
fclose($objCSV);

shell_exec("./test.rb");
shell_exec("./service_isc_restart.sh");
//header('Location: index.php');
?>
<button onclick="window.location.href='http://localhost:1080/dhcp/index.php'">BACK</button>
</table>
</body>
</html>
