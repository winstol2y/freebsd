<html>
<head>
<meta content="list/html; charset=utf-8" http-equiv="Content-Type" />
<title>Config DNS and DHCP</title>
</head>
<body>
<center>
<style>
form {
  text-align: center;
}
h3 {
    color: blue;
    text-align: center;
}
table td, th, tr{
  color: #333;
  font-family: sans-serif;
  font-size: .9em;
  font-weight: 300;
  text-align: center;
  line-height: 25px;
  border: 0px solid navy;
  width: 800px;
  margin: auto;
}
th {
  height: 30px;
  border: 1px solid navy;
}
input {
        margin-bottom: 1em;
        background-color: azure;
}
div {
    font-weight:bold;
}
</style>
<table>
<tr>
<td>
	<form action="add.php" method="post" name="frm_data">
	<table width="700">
	<th>
	<caption><font size="5"><h3>config dns - dhcp</h3></font></caption>
	</th>
	<br><br>
	<tr>
		<td align="right"><font size="3"><div>Mac Address :</div></font></td><td><input name="macAddress_add" type="text" style="width: 200px;" /></td>
	</tr>
	<tr><div>
	<td align="right"><font size="3"><div>Zone :</div></font></td><td><input name="zone_add" type="text" style="width: 200px;" /></td>
	</tr>

	<tr>
	<td align="right"><font size="3"><div>Name :</div></font></td><td><input name="name_add" type="text" style="width: 200px;" /></td>
	</tr>
	
	<tr>
	<td align="right"><font size="3"><div>IP Address :</div></font></td><td><input name="ip_add" type="text" style="width: 200px;" /></td><td align="left">Example : 192.168.111.111 </td>
	</tr>
	
	<tr>
	<td align="right"><font size="3"><div>Expire :</div></font></td><td><input name="time_add" type="text" style="width: 200px;" /></td><td align="left">Example : yyyy-mm-dd  </td>
	</tr>
	
	<tr>
	<th><td><input name="but_submit" type="submit" value="submit"></td></th>
	</tr>
	</form>
	<table width="450">
	<form action="upload.php" method="post" enctype="multipart/form-data">
	<tr><td>
		Import CSV file :
    		<input type="file" name="fileCSV" id="fileCSV">
    		<input type="submit" value="Import" name="submit">
	</td></tr>
	</form>
<br>
    <table width="500">
    	<table border="1">
      <caption>
      <h3>Display</h3>
<br>
<?php

include("connect.php");		

//---------------------------------------------------------------------------------------------------------------------------------------------------


	function table($data){
		echo '<th><div>';
		echo "$data";
		echo '</th></div>';
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
</font>
</table>
</caption>
</td>
<td>
</td>
</tr>
</table>
</center>
</body>
</html>
