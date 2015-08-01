<html>
<head>
<link href="css/bootstrap.min.css" rel="stylesheet">
<meta content="list/html; charset=utf-8" http-equiv="Content-Type" />
<title>Config DNS and DHCP</title>
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

<form action="add.php" method="post" name="frm_data">
	<table width="700">
	<th>
	<caption><font size="5"><h3>config dns - dhcp</h3></font></caption>
	</th>
	
	<tr>
	<td align="right"><font size="3"><div>Mac Address :</div></font></td>
	<td><input name="macAddress_add" type="text" style="width: 200px;" /></td>
	</tr>

	<tr>
	<td align="right"><font size="3"><div>Zone :</div></font></td>
	<td><input name="zone_add" type="text" style="width: 200px;" /></td>
	</tr>
	
	<tr>
	<td align="right"><font size="3"><div>Name :</div></font></td>
	<td><input name="name_add" type="text" style="width: 200px;" /></td>
	<td align="left">Only a-z, A-Z, 0-9 </td>
	</tr>
	
	<tr>
	<td align="right"><font size="3"><div>IP Address :</div></font></td>
	<td><input name="ip_add" type="text" style="width: 200px;" /></td>
	<td align="left">Example : 192.168.111.111 </td>
	</tr>
	
	<tr>
	<td align="right"><font size="3"><div>Expire :</div></font></td>
	<td><input name="time_add" type="text" style="width: 200px;" /></td>
	<td align="left">Example : yyyy-mm-dd  </td>
	</tr>

	<tr>
	<th><td><input name="but_submit" type="submit" value="submit"></td></th>
	</tr>

</table>
</form>

<table width="800">
<form action="upload.php" method="post" enctype="multipart/form-data">
<br><br>
	<tr>
	<td align="right" style="width:100px">Import CSV file :</td>
	<td style="width:10px"><input type="file" name="fileCSV" id="fileCSV" size="100"></td>
	<td style="width:10px"><input type="submit" value="Import" name="submit" size="100"></td>
	<td style="width:300px"><div>  Format : MacAddress (xx:xx:xx:xx:xx:xx) , Zone , Hostname , ip , expire (yyyy-mm-dd)</td>
	</tr>
</form>
</table>
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

$strSort = $_GET["sort"];
if($strSort == ""){
        $strSort = "zone";
}
function table($data){
        echo '<th><div>';
        echo "$data";
        echo '</th></div>';
}

echo '<tr>';
        table("  #  ");
        table('<a href=index.php?sort=hw>Mac Address</a>');
        table('<a href=index.php?sort=ip>IP Address</a>');
        table('<a href=index.php?sort=name>Name</a>');
        table('<a href=index.php?sort=zone>Zone</a>');
        table('<a href=index.php?sort=expire>Expire</a>');
        table("Function");
echo '</tr>';

$query_all_data = 'SELECT * FROM `ipv4` ORDER BY `'.$strSort.'` ASC';
$my_result = mysql_query($query_all_data);
$i = 1;

while($my_row1=mysql_fetch_array($my_result)){
        echo '<tr>';
        table("$i");
        table($my_row1["hw"]);
        table($my_row1["ip"]);
        table($my_row1["name"]);
        table($my_row1["zone"]);
        table($my_row1["expire"]);
        table('<a href=delete.php?ip='.trim($my_row1["ip"]).'&mac='.trim($my_row1["hw"]).' onclick=myFunction()>Delete</a>');
        $i++;
        echo '</tr>';
}

mysql_close($con);
?>
</thead>
</table>
</caption>
</center>
</body>
</html>
