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
	<td align="right">Mac Address :</td><td><input name="macAddress_add" type="text" /></td>
	</tr>
	<tr>
	<td align="right">Zone :</td><td><input name="zone_add" type="text" /></td>
	</tr>

	<tr>
	<td align="right">Name :</td><td><input name="name_add" type="text" /></td>
	</tr>
	
	<tr>
	<td align="right">IP Address :</td><td><input name="ip_add" type="text" /></td><td align="left">Example : 192.168.111.111 </td>
	</tr>
	
	<tr>
	<td align="right">Expire :</td><td><input name="time_add" type="text" /></td><td align="left">Example : yyyy-mm-dd  </td>
	</tr>
	
	<tr>
	</td><td><td><input name="but_submit" type="submit" value="ส่งค่า" /></td>
	</tr>
	</form>
	<table width="500">

	<form action="upload.php" method="post" enctype="multipart/form-data">
	
	<br><br><br>
    		Import CSV file :
    		<input type="file" name="fileCSV" id="fileCSV">
    		<input type="submit" value="Import" name="submit">
	</form>


    <table width="500">
    	<table border="1">
      <br>
      <br>
      <caption>
      <h3>แสดงค่า</h3>
      <br>

<?php

include("connect.php");		

//---------------------------------------------------------------------------------------------------------------------------------------------------


	function table($data){
		echo '<td>';
		echo "$data";
		echo '</td>';
	}
	echo '<tr>';	
		table("  #  ");
		table("Mac Address");
		table("IP Address");
		table("Name");
		table("Zone");
		table("Expire");
		table("Function");
	echo '</tr>';

	$query_all_data = "SELECT * FROM `ipv4`";
	$my_result = mysql_query($query_all_data);
	$i = 1;

	while($my_row=mysql_fetch_array($my_result)){
		echo '<tr>';
		table(" $i ");
		table($my_row["hw"]);
		table($my_row["ip"]);
		table($my_row["name"]);
		table($my_row["zone"]);
		table($my_row["expire"]);
		table('<a href=delete.php?ip='.trim($my_row["ip"]).'&mac='.trim($my_row["hw"]).'>delete</a>');
		$i++;
		echo '</tr>';
	}

mysql_close($con);		
?>

<br>

</table>
</caption>
</body>
</html>
