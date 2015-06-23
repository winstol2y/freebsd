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
    <td align="right"> Hostname :</td><td><input name="host_add" type="text" /></td>
   </tr>

<tr>
    <td align="right">Name :</td><td><input name="name_add" type="text" /></td>
   </tr>

   <tr>
    </td><td><td><input name="but_submit" type="submit" value="ส่งค่า" /></td>
   </tr>
   </form>
   
    <table width="500">
    	<table border="1">
      <br>
      <br>
      <caption>
      <h3>แสดงค่า</h3>
      <br>
      <?php
        
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
	  ?>
      <br>

   </table>
</caption>
</body>
</html>