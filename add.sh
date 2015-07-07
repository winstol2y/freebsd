#!/bin/sh

macAddress=`cat /usr/local/www/dhcp/macAddress_add.txt`
name=`cat /usr/local/www/dhcp/name_add.txt`
host=`cat /usr/local/www/dhcp/host_add.txt`
ip=`cat /usr/local/www/dhcp/ip_add.txt`
time=`cat /usr/local/www/dhcp/time_add.txt`

remove='#'$macAddress
toFile=/usr/local/etc/dhcpd.conf
                                                          
echo "host $name {									$remove" >> $toFile
echo "    hardware ethernet $macAddress;					$remove" >> $toFile
echo "    fixed-address $host;							$remove" >> $toFile
echo "}										$remove" >> $toFile
echo "$macAddress ,$name,$host,$ip,$time" >> list.txt
echo "$name 		IN	A	$ip" >> /usr/local/etc/namedb/dynamic/throughwave1.com
