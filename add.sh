#!/bin/sh

macAddress=`cat /Applications/XAMPP/xamppfiles/htdocs/macAddress_add.txt`
name=`cat /Applications/XAMPP/xamppfiles/htdocs/name_add.txt`
host=`cat /Applications/XAMPP/xamppfiles/htdocs/host_add.txt`

remove='#'$macAddress
toFile=/Applications/XAMPP/xamppfiles/htdocs/1.txt 
                                                          
echo "	group {															$remove" >> $toFile 
echo "	   use-host-decl-name on;										$remove" >> $toFile
echo "																	$remove" >> $toFile
echo "	  host $name;														$remove" >> $toFile
echo "	     hardward ethernet $macAddress;						$remove" >> $toFile
echo "	     fixed-address $host;								$remove" >> $toFile
echo "	   }															$remove" >> $toFile
echo "	}																$remove" >> $toFile
echo "    is equivalent to												$remove" >> $toFile
echo "    	  host $name {												$remove" >> $toFile
echo "    	     hardware ethernet $macAddress;					$remove" >> $toFile
echo "      	     fixed-address $host;							$remove" >> $toFile
echo "   	     option host-name  "'"'"$name"'";'"									$remove" >> $toFile
echo "	}																$remove" >> $toFile
echo "																	$remove" >> $toFile
echo "																	$remove" >> $toFile
echo "																	       " >> $toFile
echo "																		   " >> $toFile
echo "$macAddress ,$name,$host" >> list.txt