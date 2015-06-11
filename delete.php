<?php

$a=fopen("macAddress_delete.txt", "w");
$b=fopen("name_delete.txt", "w");
$c=fopen("host_delete.txt", "w");

fwrite($b,$_POST["name_delete"]);

fwrite($a,$_POST["macAddress_delete"]);

fwrite($c,$_POST["host_delete"]);

fclose($a);
fclose($b);
fclose($c);

$cmd=shell_exec('./delete.sh');
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

