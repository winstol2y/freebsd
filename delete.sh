#!/bin/sh

macAddress=`cat /Applications/XAMPP/xamppfiles/htdocs/macAddress_delete.txt`
#name=`cat /Applications/XAMPP/xamppfiles/htdocs/name_delete.txt`
#host=`cat /Applications/XAMPP/xamppfiles/htdocs/host_delete.txt`

macAddress_delete1=/#$macAddress/d
macAddress_delete2=/$macAddress/d

toFile=/Applications/XAMPP/xamppfiles/htdocs/1.txt
listFile=/Applications/XAMPP/xamppfiles/htdocs/list.txt

sed "$macAddress_delete1" $toFile > 11.txt
sed "$macAddress_delete2" $listFile > 12.txt
cat 11.txt > $toFile
cat 12.txt > $listFile