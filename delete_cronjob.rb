#!/usr/local/bin/ruby
require "mysql"
con = Mysql.new 'localhost', 'admin', 'qwerty', 'dhcpd'
con.query("DELETE FROM ipv4 WHERE `expire` < curdate()")
ff = File.open("/usr/local/www/dhcp/count.txt", "w")
	ff.puts('0')
ff.close
`/usr/local/www/dhcp/test.rb`
