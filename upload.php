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
	$strSQL .="(hw,hostname,name,ip,expire)";
	$strSQL .="VALUES ";
	$strSQL .="('$objArr[0]','$objArr[1]','$objArr[2]','$objArr[3]','$objArr[4]') ";
	$objQuery = mysql_query($strSQL);
}
fclose($objCSV);
header('Location: index.php');
echo "Upload & Import Done.";
?>
</table>
</body>
</html>
