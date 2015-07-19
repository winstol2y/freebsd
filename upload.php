<html>
<head>
<title>ThaiCreate.Com PHP & CSV To MySQL</title>
</head>
<body>
<?php
move_uploaded_file($_FILES["fileCSV"]["tmp_name"],$_FILES["fileCSV"]["name"]); // Copy/Upload CSV

$objConnect = mysql_connect("localhost","admin","qwerty") or die("Error Connect to Database"); // Conect to MySQL
$objDB = mysql_select_db("dhcpd");

$objCSV = fopen($_FILES["fileCSV"]["name"], "r");
while (($objArr = fgetcsv($objCSV, 1000, ",")) !== FALSE) {
	$strSQL = "INSERT INTO ipv4 ";
	$strSQL .="(hw,zone,name,ip,expire)";
	$strSQL .="VALUES ";
	$strSQL .="('$objArr[0]','$objArr[1]','$objArr[2]','$objArr[3]','$objArr[4]') ";
	$objQuery = mysql_query($strSQL);
}
fclose($objCSV);

shell_exec("./gen_dns_dhcp.rb");
shell_exec("./service_isc_restart.sh");
header('Location: index.php');

?>
</table>
</body>
</html>
