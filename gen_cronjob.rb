#!/usr/local/bin/ruby

require 'mysql'


begin
	con = Mysql.new 'localhost', 'admin', 'qwerty', 'dhcpd'
	write = con.query("SELECT * FROM ipv4")
	count = con.query("SELECT * FROM ipv4 WHERE expire < curdate()")

	con.query("DELETE * FROM ipv4 WHERE expire < curdate()")		

	file = File.open('/usr/local/etc/dhcpd.conf', 'w') 
	file.puts('option domain-name "bkk.throughwave.com";') 
	file.puts('option domain-name-servers 192.168.178.10;')
	file.puts('lease-file-name "/var/db/dhcpd/dhcpd.leases";')
	file.puts('')
	file.puts('default-lease-time 36000;')
	file.puts('max-lease-time 43200;')
	file.puts('')
	file.puts('subnet 192.168.0.0 netmask 255.255.254.0 {')
	file.puts('	range 192.168.0.2 192.168.0.254;')
	file.puts('}')
	file.puts('')

	write.each_hash do |row|
		file.puts('host '+ row["name"] +' {')
		file.puts('hardware ethernet '+ row["hw"]+';')
		file.puts('fixed-address '+ row["hostname"]+';')
		file.puts('}')
		file.puts('')
	end      
	file.close
	

	file = File.open('/usr/local/etc/namedb/dynamic/throughwave1.com', 'w')
	file.puts('$ORIGIN .')
	file.puts('$TTL 3600       ; 1 hour')
	file.puts('throughwave1.com.     IN SOA  ns1.throughwave1.com. admin.throughwave1.com. (')
	file.puts('                             2006051518 ; serial')
	file.puts('                             10800      ; refresh (3 hours)')
	file.puts('                             3600       ; retry (1 hour)')
	file.puts('                             604800     ; expire (1 week)')
	file.puts('                             300        ; minimum (5 minutes)')
	file.puts('                             )')
	file.puts('                     NS      ns1.throughwave1.com.')
	file.puts('')
	file.puts('$ORIGIN throughwave1.com.')
	file.puts('admin                        A       192.168.0.1')
	file.puts('ns1                  A       192.168.0.1')
	file.puts('localhost                    A       127.0.0.1')
	
	rs.each_hash do |row|
	        file.puts(row["name"]+ '                        A       ' +row["ip"])
	end

	file.close

rescue Mysql::Error => e
    puts e.errno
    puts e.error
    
ensure
    con.close if con
end
