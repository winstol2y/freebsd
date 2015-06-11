#!/bin/sh

macAddress=`cat /Applications/XAMPP/xamppfiles/htdocs/macAddress_delete.txt`
name=`cat /Applications/XAMPP/xamppfiles/htdocs/name_delete.txt`
host=`cat /Applications/XAMPP/xamppfiles/htdocs/host_delete.txt`

toFile=/Applications/XAMPP/xamppfiles/htdocs/1.txt 

grep -v '
" "
" "
"	group {"  
"	   use-host-decl-name on;" 
" " 
"	  host $name;" 
"	     hardward ethernet $macAddress;" 
"	     fixed-address $host;"
"	   }"  
"	}" 
"    is equivalent to" 
"    	  host $name {"
"    	     hardware ethernet $macAddress;" 
"      	     fixed-address $host;" 
"   	     option host-name  "'"'"$name"'";'
'"'"$name"'";' 
"	}" 
" " 
" " 
" " 
' 1.txt

