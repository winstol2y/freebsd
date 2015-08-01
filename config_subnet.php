<html>
<head>
<link href="css/bootstrap.min.css" rel="stylesheet">
<meta content="list/html; charset=utf-8" http-equiv="Content-Type" />
<title>Config Subnet</title>
</head>
<body>
<center>
<style>
form{
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
  height: 50px;
  border: 0px solid navy;
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

<nav class="navbar navbar navbar-inverse">
<div class="container">
<p class="navbar-text navbar-left"><font size="3">MENU</font></p>
<p class="navbar-text navbar-left"><a href="http://localhost:1080/dhcp/index.php" class="navbar-link"><font size="3">DHCP and DNS</font></a></p>
<p class="navbar-text navbar-left"><a href="http://localhost:1080/dhcp/config_subnet.php" class="navbar-link"><font size="3">Subnet</font></a></p>
<p class="navbar-text navbar-left"><a href="http://localhost:1080/dhcp/config_zone_detail.php" class="navbar-link"><font size="3">Config Zone Detail</font></a></p>

</div>
</nav>
<tr>

<form action="update_subnet.php" method="post" name="frm_data">
	<table width="800">
	<th>
	<caption><font size="5"><h3>Config Subnet</h3></font></caption>
	</th>
	
	<tr>
	<td align="right"><font size="3"><div>Subnet :</div></font></td>
	<td><input name="subnet" type="text" style="width: 200px;" /></td>
	</tr>

	<tr>
	<td align="right"><font size="3"><div>Netmask :</div></font></td>
	<td><input name="netmask" type="text" style="width: 200px;" /></td>
	</tr>
	
	<tr>
	<td align="right"><font size="3"><div>range</div></font></td>
	<td><input name="range" type="text" style="width: 200px;" /></td>
	<td align="left">Example : 192.168.0.1 192.168.0.254</td>
	</tr>
	
	<tr>
	<th><td><input name="but_submit" type="submit" value="submit"></td></th>
	</tr>

</table>
</form>

<br><br>

<table width="800">
	<h3>Display</h3>
<br><br>
</table>

<script>
function myFunction() {
    var ok = confirm("Are you sure!");
	if(ok && chk_data() == 0){
		document.getElementByld("form_new_qus").submit();
	};
}
</script>


<div class="container">
	<table class="table table-striped">
	<thead>

<?php

include("connect.php");

function table($data){
        echo '<th><div>';
        echo "$data";
        echo '</th></div>';
}
echo '<tr>';
table("#");
table("Subnet");
table("Netmask");
table("Range");
table("Function");
echo '</tr>';

$query_all_data = "SELECT * FROM `config_subnet`";
$my_result = mysql_query($query_all_data);
$i = 1;

while($my_row=mysql_fetch_array($my_result)){
        echo '<tr>';
	table("$i");
	table($my_row["subnet"]);
        table($my_row["netmask"]);
        table($my_row["range"]);
	table('<a href=delete_subnet.php?subnet='.trim($my_row["subnet"]).' onclick=myFunction()>Delete</a>');
	echo '</tr>';
	$i++;
}

mysql_close($con);
?>
</thead>
</table>
</caption>
</center>
</body>
</html>
