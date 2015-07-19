#!/usr/local/bin/ruby

con = Mysql.new 'localhost', 'admin', 'qwerty', 'dhcpd'
write = con.query("SELECT * FROM ipv4")

write.each_hash do |row|
	file_config = "/usr/local/www/dhcp/"
	
	count = File.open{"file_config","w"}
	count.puts
	
	count.close
end
