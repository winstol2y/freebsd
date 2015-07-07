<?php

$e=fopen("macAddress_delete.txt", "w");
$f=fopen("ip_delete.txt", "w");
//$e=fopen("name_delete.txt", "w");
//$f=fopen("host_delete.txt", "w");

$mac=$_GET["mac"];
$ip=$_GET["ip"];
//fwrite($d,$_POST["macAddress_delete"]);

fwrite($e,$mac);
fwrite($f,$ip);
//fwrite($e,$_POST["name_delete"]);
//fwrite($f,$_POST["host_delete"]);

fclose($e);
fclose($f);
//fclose($e);
//fclose($f);
$cmd=shell_exec('./delete.sh');
header('Location:index.php');
echo "<pre>$cmd</pre>";

$cmd1=shell_exec('sh service_isc_restart.sh');
echo "<pre>$cmd1</pre>";

function table($data){
	echo '<td>';
	echo "$data";
	echo '</td>';
}        
echo '<tr>';
	table("Mac Address");
	table("IP Address"); 
	table("Name");	
	table("Host Name");
	table("Expire");
	table("Function");
echo '</tr>';

 $text = file('/usr/local/www/dhcp/list.txt');
 foreach($text as $value)
 {	

 	$myString = $value;
 	$myArray = explode(',', $myString);
 
	echo '<tr>';
	 	table("$myArray[0]");
		table("$myArray[3]");
	 	table("$myArray[1]");
	 	table("$myArray[2]");
	 	table('<a href=delete.php?ip='.trim($myArray[3]).'&mac='.$myArray[0].'>delete</a>');
	echo '</tr>';
	 }
  ?>
