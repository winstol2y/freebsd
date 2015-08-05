<html lang="en">
<head>
        <meta content="list/html; charset=utf-8" http-equiv="Content-Type" />
         <title>Config DNS and DHCP</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
<center>
<style>
        form{
          text-align: center;
        }
 
        li a{
                font-size:16px;
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
/*      input {
           margin-bottom: 1em;
           background-color: azure;
        }*/
        div {
            font-weight:bold;
        }
</style>
 
        <nav class="navbar navbar-inverse">
          <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <a class="navbar-brand" href="#"></a>
            </div>
 
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav">
                <li><a href="#">Menu</a></li>
                <li><a href="http://localhost:1080/dhcp/index.php">DHCP and DNS</a></li>
                <li><a href="http://localhost:1080/dhcp/config_subnet.php">Subnet</a></li>
                <li><a href="http://localhost:1080/dhcp/config_zone_detail.php">Config Zone Detail</a></li>
              </ul>
             
              <ul class="nav navbar-nav navbar-right">
                    <form class="navbar-form navbar-left" role="search">
                        <div class="form-group">
                          <input type="text" class="form-control" placeholder="Search">
                        </div>
                        <button type="submit" class="btn btn-default">Submit</button>
                     </form>
              </ul>
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>

<table>
<form action="update_zone_detail.php" method="post" name="frm_data">
	<table width="700">
	<th>
	<caption><font size="5"><h3>Config Zone Detail</h3></font></caption>
	</th>
	
	<tr>
	<td align="right"><font size="3"><div>refresh :</div></font></td>
	<td><input name="refresh" type="text" style="width: 200px;" /></td>
	</tr>

	<tr>
	<td align="right"><font size="3"><div>retry :</div></font></td>
	<td><input name="retry" type="text" style="width: 200px;" /></td>
	</tr>
	
	<tr>
	<td align="right"><font size="3"><div>expire :</div></font></td>
	<td><input name="expire" type="text" style="width: 200px;" /></td>
	</tr>
	
	<tr>
	<td align="right"><font size="3"><div>minimum :</div></font></td>
	<td><input name="minimum" type="text" style="width: 200px;" /></td>
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
table("refresh");
table("retry");
table("expire");
table("minimum");
echo '</tr>';

$query_all_data = "SELECT * FROM `zone_detail`";
$my_result = mysql_query($query_all_data);

while($my_row=mysql_fetch_array($my_result)){
        echo '<tr>';
        table($my_row["refresh"]);
        table($my_row["retry"]);
        table($my_row["expire"]);
        table($my_row["minimum"]);
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
