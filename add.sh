#!/bin/sh

macAddress=`cat /usr/local/www/dhcp/macAddress_add.txt`
name=`cat /usr/local/www/dhcp/name_add.txt`
host=`cat /usr/local/www/dhcp/host_add.txt`

remove='#'$macAddress
toFile=/usr/local/www/dhcp/1.txt 
                                                          
echo "host $name {									$remove" >> $toFile
echo "    hardware ethernet $macAddress;					$remove" >> $toFile
echo "    fixed-address $host;							$remove" >> $toFile
echo "}										$remove" >> $toFile
echo "$macAddress ,$name,$host" >> list.txt
