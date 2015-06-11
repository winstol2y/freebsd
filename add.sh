#!/bin/sh

macAddress=`cat /Applications/XAMPP/xamppfiles/htdocs/macAddress_add.txt`
name=`cat /Applications/XAMPP/xamppfiles/htdocs/name_add.txt`
host=`cat /Applications/XAMPP/xamppfiles/htdocs/host_add.txt`

toFile=/Applications/XAMPP/xamppfiles/htdocs/1.txt 

echo " " >> $toFile
echo " " >> $toFile
echo "	group {" >> $toFile 
echo "	   use-host-decl-name on;" >> $toFile
echo " " >> $toFile
echo "	  host $name;" >> $toFile
echo "	     hardward ethernet $macAddress;" >> $toFile
echo "	     fixed-address $host;" >> $toFile
echo "	   }" >> $toFile
echo "	}" >> $toFile
echo "    is equivalent to" >> $toFile
echo "    	  host $name {" >> $toFile
echo "    	     hardware ethernet $macAddress;" >> $toFile
echo "      	     fixed-address $host;" >> $toFile
echo "   	     option host-name  "'"'"$name"'";' >> $toFile
#echo '"'"$name"'";' >> $toFile
echo "	}" >> $toFile
echo " " >> $toFile
echo " " >> $toFile
echo " " >> $toFile

