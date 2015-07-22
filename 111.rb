#!/usr/local/bin/ruby

require "mysql"
con = Mysql.new 'localhost', 'admin', 'qwerty', 'dhcpd'
data_dhcp = con.query("SELECT * FROM zone_detail")
data_dhcp.each_hash do |row|
	puts row['refresh'] + " " + row['retry']
end   
