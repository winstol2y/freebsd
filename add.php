<?php

$a=fopen("macAddress_add.txt", "w");
$b=fopen("name_add.txt", "w");
$c=fopen("host_add.txt", "w");

fwrite($b,$_POST["name"]);

fwrite($a,$_POST["macAddress"]);

fwrite($c,$_POST["host"]);

fclose($a);
fclose($b);
fclose($c);
$cmd=shell_exec('./add.sh');
echo "<pre>$cmd</pre>";

?> 

<html>
   <head>
       <meta content="add/html; charset=utf-8" http-equiv="Content-Type" />
       <title>ทดสอบรับค่า</title>
   </head>
   <body>
  <form action="add.html" method="post" name="frm_data">

  	<center>
		<caption><h3>Succeed</h3></caption>
		<button onClick = “history.go(-1)”> BACK </button>

	</center>

   </form>
</body>
</html>

