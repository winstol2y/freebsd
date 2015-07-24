<html>
<head>
<meta content="list/html; charset=utf-8" http-equiv="Content-Type" />
<title>Config Subnet</title>

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
	<form action="update_subnet.php" method="post" name="frm_data">
	<table width="700">
	<th>
	<caption><font size="5"><h3>Config Subnet</h3></font></caption>
	</th>
	<br><br>
	<tr>
		<td align="right"><font size="3"><div>Subnet :</div></font></td><td><input name="subnet" type="text" style="width: 200px;" /></td>
	</tr>
	<tr><div>
	<td align="right"><font size="3"><div>Netmask :</div></font></td><td><input name="netmask" type="text" style="width: 200px;" /></td>
	</tr>

	<tr>
	<td align="right"><font size="3"><div>range :</div></font></td><td><input name="range" type="text" style="width: 200px;" /></td>
	</tr>
	
	<tr>
	<th><td><input name="but_submit" type="submit" value="submit"></td></th>
	</tr>
	</form>
<br>
    <table width="500">
    	<table border="1">
      <caption>
      <h3>Display</h3>
<br>
<?php

include("connect.php");		

//------------------------------------------------------------------------------------------------------------------------------------


	function table($data){
		echo '<th><div>';
		echo "$data";
		echo '</th></div>';
	}
	echo '<tr>';	
	table("Subnet");
	table("Netmask");
	table("range");
	echo '</tr>';

	$query_all_data = "SELECT * FROM `config_subnet`";
	$my_result = mysql_query($query_all_data);

	while($my_row=mysql_fetch_array($my_result)){
		echo '<tr>';
		table($my_row["subnet"]);
		table($my_row["netmask"]);
		table($my_row["range"]);
		echo '</tr>';
	}
	

//---------------------------------------------------------------------------------------------------------------------------------------

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
