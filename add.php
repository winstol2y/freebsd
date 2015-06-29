<?php

$a=fopen("macAddress_add.txt", "w");
$b=fopen("name_add.txt", "w");
$c=fopen("host_add.txt", "w");

fwrite($b,$_POST["name_add"]);

fwrite($a,$_POST["macAddress_add"]);

fwrite($c,$_POST["host_add"]);

fclose($a);
fclose($b);
fclose($c);
$cmd=shell_exec('./add.sh');
header('Location: index.php');
echo "<pre>$cmd</pre>";

$cmd1=shell_exec('sh service_isc_restart.sh');
echo "<pre>$cmd1</pre>";

?> 
