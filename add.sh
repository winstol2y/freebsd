#!/bin/sh

macAddress=`cat /Applications/XAMPP/xamppfiles/htdocs/macAddress_add.txt`
name=`cat /Applications/XAMPP/xamppfiles/htdocs/name_add.txt`
host=`cat /Applications/XAMPP/xamppfiles/htdocs/host_add.txt`

remove='#'$macAddress
toFile=/usr/local/etc/dhcpd.conf 
                                                          
echo "    	  host $name {												$remove" >> $toFile
echo "    	     hardware ethernet $macAddress;					$remove" >> $toFile
echo "      	     fixed-address $host;							$remove" >> $toFile
echo "	}																$remove" >> $toFile
echo "$macAddress ,$name,$host" >> list.txt
