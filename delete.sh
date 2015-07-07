#!/bin/sh

macAddress=`cat /usr/local/www/dhcp/macAddress_delete.txt`
ip=`cat /usr/local/www/dhcp/ip_delete.txt`

macAddress_delete1=/#$macAddress/d
macAddress_delete2=/$macAddress/d
ip_delete=/$ip/d
toFile=/usr/local/etc/dhcpd.conf
listFile=/usr/local/www/dhcp/list.txt
delete_ip=/usr/local/etc/namedb/dynamic/throughwave1.com

sed "$macAddress_delete1" $toFile > 11.txt
sed "$macAddress_delete2" $listFile > 12.txt
sed "$ip_delete" $delete_ip > 13.txt
cat 11.txt > $toFile
cat 12.txt > $listFile
cat 13.txt > $delete_ip
