<?php

$d=fopen("macAddress_delete.txt", "w");
//$e=fopen("name_delete.txt", "w");
//$f=fopen("host_delete.txt", "w");

$mac=$_GET["mac"];
echo $mac;
//fwrite($d,$_POST["macAddress_delete"]);
fwrite($d,$mac);
//fwrite($e,$_POST["name_delete"]);

//fwrite($f,$_POST["host_delete"]);

fclose($d);
//fclose($e);
//fclose($f);

$cmd=shell_exec('./delete.sh');
echo "<pre>$cmd</pre>";

        
          echo '<tr>';
        echo '<td>';
          print "Mac Address";
          echo '</td>';
          echo '<td>';
          print "Host Name";
          echo '</td>';
          echo '<td>';
          print "Host";
            echo '</td>';
            echo '<td>';
            print "Function";
          echo '</td>';
          echo '</tr>';


         $text = file('/usr/local/www/dhcp/list.txt');
       foreach($text as $value)
       {  

        $myString = $value.'<br/>';
        $myArray = explode(',', $myString);
       
        echo '<tr>';
        echo '<td>';
          print $myArray[0];
          echo '</td>';
          echo '<td>';
          print $myArray[1];
          echo '</td>';
          echo '<td>';
          print $myArray[2];
          echo '</td>';
          echo '<td>';
          echo '<a href=delete.php?mac='.$myArray[0].'>delete</a>';
          echo '</td>';
          echo '</tr>';
       }

    header('Location:index.php');
    
    ?>


