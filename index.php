<html>
<head>
<meta content="list/html; charset=utf-8" http-equiv="Content-Type" />
<title>แสดงค่า</title>
</head>
<body>
	<form action="add.php" method="post" name="frm_data">
	<table width="500">
	<br>
	<br>
	<br>
	<caption><h3>รับ-ส่งค่า</h3></caption>
	<tr>
	<td align="right">Mac Address :</td><td><input name="macAddress_add" type="text" /></td><td align="left">   Example : xx:xx:xx:xx:xx:xx </td>
	</tr>
	<tr>
	<td align="right"> Hostname :</td><td><input name="host_add" type="text" /></td>
	</tr>

	<tr>
	<td align="right">Name :</td><td><input name="name_add" type="text" /></td>
	</tr>
	
	<tr>
	<td align="right">IP Address :</td><td><input name="ip_add" type="text" /></td><td align="left">Example : 192.168.111.111 </td>
	</tr>
	
	<tr>
	<td align="right">Expire :</td><td><input name="time_add" type="text" /></td><td align="left">Example : xx-xx-xx </td>
	</tr>
	
	<tr>
	</td><td><td><input name="but_submit" type="submit" value="ส่งค่า" /></td>
	</tr>

	</form>
   
    <table width="500">
    	<table border="1">
      <br>
      <br>
      <caption>
      <h3>แสดงค่า</h3>
      <br>

<?php
		
//---------------------------------------------------------------------------------------------------------------------------------------------------
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

	
	date_default_timezone_set("Asia/Bangkok");
	date_default_timezone_get();
	$t1 = date('d-m-Y');
	$text = file('/usr/local/www/dhcp/list.txt');
	foreach($text as $value)
	{	

		$myString = $value;
		$myArray = explode(',', $myString);
	 
		$date1=date_create("$t1");
		$date2=date_create("$myArray[4]");
		$diff=date_diff($date1,$date2);
		$date11 = $diff->format("%R%a");
		$date12 = (int)$date11;
		//echo $date11;
		//echo gettype($date11);
		//echo $date12;
		//echo gettype($date12);
		if($date12 <= 0){
			
			$ip = $myArray[3]; //ip
			$mac = $myArray[0]; //mac

			$d1 = fopen("macAddress_delete.txt", "w");
			$d2 = fopen("ip_delete.txt", "w");

			fwrite($d1,$mac);
			fwrite($d2,$ip);

			fclose($d1);
			fclose($d2);
			
			shell_exec('./delete.sh');
			//echo "<pre>$cmd</pre>";
			
			shell_exec('sh service_isc_restart.sh');
			//echo "<pre>$cmd1</pre>";
		}
		elseif($date12 >= 1){
			echo '<tr>';
				table("$myArray[0]");
				table("$myArray[3]");
				table("$myArray[1]");
				table("$myArray[2]");
				table("$myArray[4]");
				table('<a href=delete.php?ip='.trim($myArray[3]).'&mac='.$myArray[0].'>delete</a>');
			echo '</tr>';
		}
	 }
	
?>

<br>

</table>
</caption>
</body>
</html>
