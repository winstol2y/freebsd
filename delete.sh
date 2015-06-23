#!/bin/sh

macAddress=`cat /usr/local/www/dhcp/macAddress_delete.txt`
#name=`cat /usr/local/www/dhcp/name_delete.txt`
#host=`cat /usr/local/www/dhcp/host_delete.txt`

macAddress_delete1=/#$macAddress/d
macAddress_delete2=/$macAddress/d

toFile=/usr/local/www/dhcp/1.txt
listFile=/usr/local/www/dhcp/index.txt

sed "$macAddress_delete1" $toFile > 11.txt
sed "$macAddress_delete2" $listFile > 12.txt
cat 11.txt > $toFile
cat 12.txt > $listFile
